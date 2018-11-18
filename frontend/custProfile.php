<!-- Customer profile: This is the page where customer may view their profiles and edit their data -->

<!-- Page title -->
<?php
session_start();

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug");

$custid = $_POST['customerid'];
?>

<title>Hotel Ski Resort</title>

<center>
  <!-- Personal  Info-->
  <p> Welcome customer id: <?php echo $custid;?> </p>

  <div style="background-color:lightGrey; width: 50%; padding-top: 10px; padding-bottom: 10px">
    <h4> Personal Information </h4>
      <?php
        $result = executePlainSQL("select * customer where c_id=$custid");
        echo "<table>";

        echo "<tr><th>Id:</th><th>Name:</th><th>E-mail:</th><th>Credit Card Number:</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>";
        }
        echo "</table>";
      ?>
  </div>

  <div style="height: 10px;"></div>

  <!-- Membership Info-->
  <div style="background-color:lightGrey; width: 50%; padding-top: 10px; padding-bottom: 10px">
    <h4> Membership Information </h4>
    <!-- TODO: this table printing set up needs to be completed -->
<!--       <?php
        //$result = executePlainSQL("select * customers where c_id=3");
        //echo "<table>";
        //echo "<tr><th>Id:</th><th>Name:</th><th>E-mail:</th><th>Credit Card Number:</th></tr>";
        //while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          //echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>";
        //}
        //echo "</table>";
      ?> -->
  </div>
</center>

  <div style="height: 30px;"></div>

<!--- Forms to add & update data --->
<center>
  <!-- Update personal info -->
  <div>
    <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
      <center>Update Personal Information: </center>
      <form method="POST" action="custProfile.php"> <!-- TODO: Add any SQL processing necessary-->
          <!--<p align="left">Id: <br> <input type="number" name="c_id" size="6"> </p>-->
          <input type="hidden" name="customerid" value="<?php echo $custid; ?>">
          <p align="left">Name: <br> <input type="text" name="editName" size="20"> </p>
          <p align="left">E-mail: <br> <input type="text" name="editEmail" size="40"> </p>
          <p align="left">Credit Card Number: <br> <input type="number" name="editCCnum" size="16"> </p>

        <center>
          <input type="submit" value="Update" name="updateCust">
        </center>
      </form>
    </div>
  </div>

  <div style="height: 10px;"></div>

  <!-- Become a member -->
  <!-- TODO: make sure this only is clickable if the membership doens't already exist -->
  <div>
    <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
      <form method="POST" action="custProfile.php"> <!-- TODO: Add any SQL processing necessary-->
        <center>

          <input type="submit" value="Become a member" name="newMember">
          <!-- Check if person is a member already, if so: do nothing?. If not then add them to the membership table and then refresh this page so the membership info can appear in the table above-->
        </center>
      </form>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
//Setup
function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
  //echo "<br>running ".$cmdstr."<br>";
  global $db_conn, $success;
  $statement = OCIParse($db_conn, $cmdstr); //There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work

  if (!$statement) {
    echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
    $e = OCI_Error($db_conn); // For OCIParse errors pass the
    // connection handle
    echo htmlentities($e['message']);
    $success = False;
  }

  $r = OCIExecute($statement, OCI_DEFAULT);
  if (!$r) {
    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
    $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
    echo htmlentities($e['message']);
    $success = False;
  } else {

  }
  return $statement;

}

function executeBoundSQL($cmdstr, $list) {
  /* Sometimes the same statement will be executed for several times ... only
   the value of variables need to be changed.
   In this case, you don't need to create the statement several times;
   using bind variables can make the statement be shared and just parsed once.
   This is also very useful in protecting against SQL injection.
      See the sample code below for how this functions is used */

  global $db_conn, $success;
  $statement = OCIParse($db_conn, $cmdstr);

  if (!$statement) {
    echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
    $e = OCI_Error($db_conn);
    echo htmlentities($e['message']);
    $success = False;
  }

  foreach ($list as $tuple) {
    foreach ($tuple as $bind => $val) {
      //echo $val;
      //echo "<br>".$bind."<br>";
      OCIBindByName($statement, $bind, $val);
      unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype

    }
    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
      echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
      $e = OCI_Error($statement); // For OCIExecute errors pass the statement handle
      echo htmlentities($e['message']);
      echo "<br>";
      $success = False;
    }
  }
  return $statement;

}

function printResult($result) { //prints results from a select statement
  echo "result from SQL:";
  echo "<table>";
  while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
  echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
  }
  echo "</table>\n";
}

if ($db_conn) {

    if (array_key_exists('updateCust', $_POST)) {
      $tuple = array (
        ":bind1" => $_POST['customerid'],
        ":bind2" => $_POST['editName'],
        ":bind3" => $_POST['editEmail'],
        ":bind4" => $_POST['editCCnum'],
      );
      $alltuples = array (
        $tuple
      );
      $result = executeBoundSQL("select * from customer where c_id=:bind1", $alltuples);

      if($row = OCI_Fetch_Array($result, OCI_BOTH)){
        //update room
        executeBoundSQL("update customer set c_name=:bind2, e_mail=:bind3, creditcard_num=:bind4 where c_id=:bind1", $alltuples);
      }

      OCICommit($db_conn);

      if ($_POST && $success) {
        header("location: custProfile.php");
      }

    } else
    if (array_key_exists('newMember', $_POST)) {
      $tuple = array (
       ":bind1" => $_POST['customerid']  //TODO: check if this works JOYCE
      );
      $alltuples = array (
        $tuple
      );
      $result = executeBoundSQL("insert into member values (:bind1, 12.50, 0, '20181121')", $alltuples);

      printResult($result);
      $row = OCI_Fetch_Array($result, OCI_BOTH);

      OCICommit($db_conn);

      if ($_POST && $success) {
        header("location: custProfile.php");
      }
    }

  //Commit to save changes...
  OCILogoff($db_conn);
} else {
  echo "cannot connect";
  $e = OCI_Error(); // For OCILogon errors pass no handle
  echo htmlentities($e['message']);
}

?>
