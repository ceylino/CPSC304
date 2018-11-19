<!-- Staff profile: This is the page where staff may view their profiles and edit their data -->

<?php
session_start();
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug");

$staff_id = $_POST['staffid'];
setcookie("staffid", $staff_id);
$staffidcookie = $_COOKIE["staffid"];
?>
<!-- Page title -->
<title>Hotel Ski Resort</title>

<!-- Directory -->
  <div style="float: right;">
    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <center>
        <form method="POST" action="staffDir.php">
        <input type="hidden" name="staffid" value="<?php echo $staffidcookie; ?>">
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>
  </div>

<center>
  <!-- Personal  Info-->
  <p> Welcome staff id: <?php echo $staffidcookie; ?> </p> <!-- TODO: echo the staff id. -->
  <div style="background-color:lightGrey; width: 30%; padding-top: 10px; padding-bottom: 10px">
    <h4> Personal Information </h4>
    <?php
      echo "<table>";
      echo "<tr><th>Name:</th><th>Phone:</th></tr>";
      $result = executePlainSQL("select s_name, phone from hotelStaff where staff_id=$staffidcookie union select s_name, phone from skiStaff where staff_id=$staffidcookie");
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["S_NAME"] . "</td><td>" . $row["PHONE"] . "</td></tr>";
        }
        echo "</table>";
    ?>

  </div>

  <div style="height: 10px;"></div>
</center>

  <div style="height: 30px;"></div>

<!-- Form: -->
<center>
<!-- Update personal info -->
  <div>
    <div style="width: 200px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
      <center>Update Personal Information:
        <form method="POST" action="staffProfile.php"> <!-- TODO: Add any SQL processing necessary-->
          <input type="hidden" name="staffid" value="<?php echo $staffidcookie; ?>">
          <p align="left">Name: <br> <input type="text" name="editName" size="20"> </p>
          <p align="left">Phone Number: <br> <input type="number" name="editPhone" size="10"> </p>
          <input type="submit" value="Update" name="updateStaff">
        </form>
      </center>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
function executePlainSQL($cmdstr) {
  //takes a plain (no bound variables) SQL command and executes it
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
  if (array_key_exists('updateStaff', $_POST)) {
    $tuple = array (
      ":bind1" => $staffidcookie, //TODO
      ":bind2" => $_POST['editName'],
      ":bind3" => $_POST['editPhone'],
      );
    $alltuples = array ($tuple);
    $result = executeBoundSQL("select * from hotelStaff where staff_id=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      executeBoundSQL("update hotelStaff set s_name=:bind2, phone=:bind3 where staff_id=:bind1", $alltuples);
    } else {
      $result = executeBoundSQL("select * from skiStaff where staff_id=:bind1", $alltuples);
      if($row = OCI_Fetch_Array($result, OCI_BOTH)){
          executeBoundSQL("update skiStaff set s_name=:bind2, phone=:bind3 where staff_id=:bind1", $alltuples);
      }
    }

  OCICommit($db_conn);
  if ($_POST && $success){
    header("location: staffProfile.php");
  }
  }

  OCILogoff($db_conn);

  } else {echo "cannot connect";
  $e = OCI_Error(); // For OCILogon errors pass no handle
  echo htmlentities($e['message']);
}
?>
