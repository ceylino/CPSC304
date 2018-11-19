
<?php
session_start();
if (isset($_POST["staffid"])) {
  $staffidcookie = $_POST['staffid'];
}else{
  $staffidcookie = $_COOKIE["staffid"];
}
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored
?>

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id:<?php echo $staffidcookie;?> </p>


<div style="display: flex;
            width: 100%;
            justify-content: space-around;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Customers </h3>
    <?php
        $result = executePlainSQL("select * from customer");
        echo "<table>";
        echo "<tr><th>ID</th><th></th><th>Name</th><th>E-mail</th><th>Creditcard Number</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["C_ID"] . "</td><td></td><td>" . $row["C_NAME"] . "</td><td>" . $row["E_MAIL"] . "</td><td>" . $row["CREDITCARD_NUM"] . "</td></tr>";
        }
        echo "</table>";
      ?>
      </div>

    <div style="justify-content: flex-start;">
      <h3> Members </h3>
        <?php
          $result1 = executePlainSQL("select c.c_id, c.c_name, m.fee, m.points, m.join_date from customer c, member m where c.c_id = m.c_id");
          echo "<table>";
          echo "<tr><th>ID</th></td><td><th></th><th>Name</th><th>Member Fee</th></td><td><th>Member Points</th></td><td><th>Membership Date</th></tr>";
          while ($row = OCI_Fetch_Array($result1, OCI_BOTH)) {
            echo "<tr><td>" . $row["C_ID"] . "</td><td></td><td></td><td>" . $row["C_NAME"] . "</td><td>" . $row["FEE"] . "</td><td></td><td>" . $row["POINTS"] . "</td><td></td><td>" . $row["JOIN_DATE"] . "</td></tr>";
          }
          echo "</table>";
        ?>

      <h3> Leading Reservations </h3>
        <?php
          $result1 = executePlainSQL("select c.c_id, c.c_name, count(r.c_id) as count from reservations r, customer c where r.c_id=c.c_id group by c.c_id, c.c_name order by count(r.c_id) desc");

          echo "<table>";
          echo "<tr><th>ID</th></td><td><th>Customer Name</th></td><td><th>Reservation Count</th></tr>";
          while ($row = OCI_Fetch_Array($result1, OCI_BOTH)) {
            echo "<tr><td>" . $row["C_ID"] . "</td><td></td><td>" . $row["C_NAME"] . "</td><td></td><td>" . $row["COUNT"] . "</td></tr>";
          }
          echo "</table>";
        ?>
    </div>

 <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey;width: 200px;padding-top: 20px;padding-bottom: 1px">
      <center>
        <form method="POST" action="staffDir.php">
        <input type="hidden" name="staffid" value="<?php echo $staffidcookie; ?>">
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>

    <div style="height: 10px;"></div>

  </div>
  </div>

</div>

<div style="height: 30px;"></div>

<!-- Forms to add & update data -->
<center>
  <div style="display: flex;width: 100%;justify-content: space-around;">
    <div> <!-- Members -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add New/Update Customer: </center>
        <form method="POST" action="staffCustomerView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
          <p align="left">ID:<br> <input type="number" name="newC_id" size="6"> </p>
        	<p align="left">Name:<br> <input type="text" name="newC_name" size="20"> </p>
        	<p align="left">E-mail:<br> <input type="text" name="newC_email" size="40"> </p>
        	<p align="left">Credit Card Number:(max: 16 digits) <br> <input type="number" name="newC_CCnum" size="16"> </p>
          <center>
            <input type="submit" value="Add/Update" name="addUpdateCust">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a customer -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
            <center>Delete Customer: <br><br>
              Are you sure you want to delete this room? This action cannot be undone. Deletion will cause cascading through other functionalities.<br><br>
            </center>

            <form method="POST" action="staffCustomerView.php">
            <p align="left"> ID: <br> <input type="number" name="deleteC_id" size="6"> </p>
            <input type="submit" value="Delete customer" name="deleteCust">
            </form>
        </div>
      </div>
    </div>


      <div style="height: 10px;"></div>

      <!-- Delete a room -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffCustomerView.php">
              <center>Add Membership: <br>
            </center>
            <p align="left">ID: <br> <input type="number" name="addIDMember" size="6"> </p>
            <center><input type="submit" value="add member" name="addMember"></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php

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

    if (array_key_exists('addUpdateCust', $_POST)) {
      $tuple = array (
        ":bind1" => $_POST['newC_id'],
        ":bind2" => $_POST['newC_name'],
        ":bind3" => $_POST['newC_email'],
        ":bind4" => $_POST['newC_CCnum']
      );
      $alltuples = array (
        $tuple
      );
      $result = executeBoundSQL("select * from customer where c_id=:bind1", $alltuples);

      if($row = OCI_Fetch_Array($result, OCI_BOTH)){
        //update customer

        executeBoundSQL("update customer set c_name=:bind2, e_mail=:bind3, creditcard_num=:bind4 where c_id=:bind1", $alltuples);
      } else {
        executeBoundSQL("insert into customer values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
      }

      OCICommit($db_conn);

      if ($_POST && $success) {
        setcookie("staffid", $staffidcookie);
        echo "<meta http-equiv='refresh' content='0'>";
      }

    } else if (array_key_exists('deleteCust', $_POST)) {
        $tuple = array (
         //get c_id
          ":bind1" => $_POST['deleteC_id'],
        );
        $alltuples = array (
          $tuple
        );

        //if customer id exists, then delete it
        $result = executeBoundSQL("select * from customer where c_id=:bind1", $alltuples);
        if($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          $result = executeBoundSQL("delete from customer where c_id=:bind1", $alltuples);
        }

        OCICommit($db_conn);

        if ($_POST && $success && $row) {
          setcookie("staffid", $staffidcookie);
          echo "<meta http-equiv='refresh' content='0'>";
        }

      } else if (array_key_exists('addMember', $_POST)){
         $tuple = array (
            ":bind1" => $_POST['addIDMember'],
            ":bind2" => 12.50,
            ":bind3" => 0,
            ":bind4" => date("Ymd"),
          );
          $alltuples = array (
            $tuple
          );

          //check if customer is already a member
          $result = executeBoundSQL("select * from member where c_id=:bind1", $alltuples);
          if($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "Already a member";
          } else {

            $result = executeBoundSQL("select * from customer where c_id=:bind1", $alltuples);
            if($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                  $result = executeBoundSQL("insert into member values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
                  echo "Membership created";

            } else {
              echo "customer with that that ID does not exist!";
            }
          }
          OCICommit($db_conn);

          if ($_POST && $success) {
            setcookie("staffid", $staffidcookie);
            echo "<meta http-equiv='refresh' content='0'>";
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
