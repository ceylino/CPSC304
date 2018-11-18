<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug");
?>

<!-- Page title -->
<title>Hotel Ski Resort</title>

<p> Welcome staff id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the staff id. -->

<div style="display: flex;
            width: 100%;
            justify-content: space-around;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Hotel Staff: </h3>
    <?php

        $result1 = executePlainSQL("select * from hotelStaff");
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Phone</th></tr>";
        while ($row = OCI_Fetch_Array($result1, OCI_BOTH)) {
          echo "<tr><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td><td>" . $row["PHONE"] . "</td></tr>";
        }
        echo "</table>";
      ?>
      </div>

<div style="justify-content: flex-start;">
    <h3> Ski Staff: </h3>
    <?php

        $result1 = executePlainSQL("select * from skiStaff");
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Phone</th></tr>";
        while ($row = OCI_Fetch_Array($result1, OCI_BOTH)) {
          echo "<tr><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td><td>" . $row["PHONE"] . "</td></tr>";
        }
        echo "</table>";
      ?>
      </div>

  <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <center>
        <form action=""> <!-- TODO: Add rerouting to other staff pages -->
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>
  </div>

</div>

<div style="height: 10px;"></div>


<!-- Forms to add & update data -->
<center>
  <div style="display: flex;
              width: 100%;
              justify-content: space-around;">
     <!-- Hotel Staff -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update a hotel staff: </center>
        <form method="POST" action="staffStaffView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Staff id: <br> <input type="number" name="editHSid" size="6"> </p>
            <p align="left">Staff name: <br> <input type="text" name="editHSname" size="20"> </p>
            <p align="left">Phone: <br> <input type="text" name="editHSphone" size="20"> </p>
            <!-- Note: remember to update the roomRate table if needed -BEFORE- making any changes to the room table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editHStaff">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>


       <!-- Ski Staff -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update a ski staff: </center>
        <form method="POST" action="staffStaffView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Staff id: <br> <input type="number" name="editSSid" size="6"> </p>
            <p align="left">Staff name: <br> <input type="text" name="editSSname" size="20"> </p>
            <p align="left">Phone: <br> <input type="text" name="editSSphone" size="20"> </p>
            <!-- Note: remember to update the roomRate table if needed -BEFORE- making any changes to the room table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editSStaff">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>
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
  if (array_key_exists('newHS', $_POST)) {
    $tuple = array (
      ":bind1" => $_POST['newHSid'],
      ":bind2" => $_POST['newHSname'],
      ":bind3" => $_POST['newHSnum']
      );
    $alltuples = array ($tuple);
    $result = executeBoundSQL("select * from hotelStaff where staff_id=:bind1", $alltuples);

    //check if id exists in hotel staff
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
        //do nothing!
    } else {

      $result2 = executeBoundSQL("select * from skiStaff where staff_id=:bind1", $alltuples);
      //check if id exists in ski staff
      if($row = OCI_Fetch_Array($result2, OCI_BOTH)){
          //do nothing!
      }else {
        executeBoundSQL("insert into hotelStaff values (:bind1, :bind2, :bind3)", $alltuples);
      }

    }

    OCICommit($db_conn);
    if ($_POST && $success){
      header("location: staffStaffView.php");
    }
  echo "<meta http-equiv='refresh' content='0'>";

  } else if (array_key_exists('newSS', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['newSSid'],
      ":bind2" => $_POST['newSSname'],
      ":bind3" => $_POST['newSSnum']
      );
    $alltuples = array ($tuple);
    $result = executeBoundSQL("select * from skiStaff where staff_id=:bind1", $alltuples);

    //check if id exists in ski staff
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
        //do nothing!
    } else {

      $result2 = executeBoundSQL("select * from hotelStaff where staff_id=:bind1", $alltuples);
      //check if id exists in ski staff
      if($row = OCI_Fetch_Array($result2, OCI_BOTH)){
          //do nothing!
      }else {
        executeBoundSQL("insert into skiStaff values (:bind1, :bind2, :bind3)", $alltuples);
      }
      echo "<meta http-equiv='refresh' content='0'>";
    }

    OCICommit($db_conn);
    if ($_POST && $success){
      header("location: staffStaffView.php");
  }
  echo "<meta http-equiv='refresh' content='0'>";
  }

  OCILogoff($db_conn);

  } else {echo "cannot connect";
  $e = OCI_Error(); // For OCILogon errors pass no handle
  echo htmlentities($e['message']);
}
?>
