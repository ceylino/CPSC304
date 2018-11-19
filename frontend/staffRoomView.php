<?php
//Setup
session_start();
if (isset($_POST["staffid"])) {
  $staffidcookie = $_POST['staffid'];   
}else{  
  $staffidcookie = $_COOKIE["staffid"];
}

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_e6b2b", "a43992254", "dbhost.ugrad.cs.ubc.ca:1522/ug");
?>

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id:<?php echo $staffidcookie; ?> </p> 
<div style="display: flex; width: 100%; justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Room Reservations: </h3>
      <?php
        $result = executePlainSQL("select r.room_num, r.start_date, r.end_date, c.c_id, c.c_name, c.e_mail from roomReservation r, customer c where r.c_id = c.c_id order by r.room_num");
        echo "<table>";
        echo "<tr><th>Room Number</th><th>Start Date</th><th>End Date</th><th>CID</th><th>Customer Name</th><th>Customer E-mail</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["ROOM_NUM"] . "</td><td>" . $row["START_DATE"] . "</td><td>" . $row["END_DATE"] . "</td><td>" . $row["C_ID"] . "</td><td>" . $row["C_NAME"] . "</td><td>" . $row["E_MAIL"] . "</td></tr>";
        }
        echo "</table>";
      ?>
  </div>

  <div style="justify-content: flex-start;">
    <h3> Rooms: </h3>
    <?php
      $result1 = executePlainSQL("select * from room order by room_num");
      echo "<table>";
      echo "<tr><th>Number</th><th>Type</th><th>Rate</th></tr>";
      while ($row = OCI_Fetch_Array($result1, OCI_BOTH)) {
        echo "<tr><td>" . $row["ROOM_NUM"] . "</td><td>" . $row["ROOM_TYPE"] . "</td><td>" . $row["ROOM_RATE"] . "</td></tr>";
      }
      echo "</table>";
    ?>
  </div>

  <div style="justify-content: flex-start;">
    <h3> Room Rates: </h3>
    <?php
      $result1 = executePlainSQL("select * from roomRate");
      echo "<table>";
      echo "<tr><th>Type</th><th>Rate</th></tr>";
      while ($row = OCI_Fetch_Array($result1, OCI_BOTH)) {
        echo "<tr><td>" . $row["ROOM_TYPE"] . "</td><td>" . $row["ROOM_RATE"] . "</td></tr>";
      }
      echo "</table>";
    ?>

    <h3> Customers </h3> 
    <?php
        $result = executePlainSQL("select c_id, c_name from customer");
        echo "<table>";
        echo "<tr><th>ID</th><th></th><th>Name</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["C_ID"] . "</td></td><td><td>" . $row["C_NAME"] . "</td></tr>";
        }
        echo "</table>";
  ?>
  </div>
      <!-- Directory -->
      <div style="justify-content: flex-end;">
        <!-- Edit Profile-->
        <div style="background-color:lightGrey; width: 200px; padding-top: 20px;padding-bottom: 1px">
          <center>
            <form method ="POST" action="staffDir.php">
            <input type="hidden" name="staffid" value="<?php echo $staffidcookie; ?>">
              <input type="submit" value="Back to Main Staff Page" name="staffDir">
            </form>
          </center>
        </div>

    <div style="height: 10px;"></div>
  </div>
</div>

<div style="height: 30px;"></div>

<!-- Forms to add & update data-->
<center>
  <div style="display: flex; width: 100%; justify-content: space-around;">
    <div> <!-- Rooms -->
       <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new room: </center>
        <form method="POST" action="staffRoomView.php">
        
            <p align="left">Room number: <br> <input type="number" name="addRoomNum" size="6"> </p>
            <p align="left">Room Type: <br> <input type="text" name="addType" size="20"> </p>
            <p align="left">Room Rate: <br> <input type="number" name="addRate" size="6"> </p>
          <center>
            <input type="submit" value="Add" name="addRoom">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update existing room: </center>
        <form method="POST" action="staffRoomView.php">
            <p align="left">Old Room number: <br> <input type="number" name="oldRoomNum" size="6"> </p>
            <br>
            <p align="left">New Room number: <br> <input type="number" name="editRoomNum" size="6"> </p>
            <p align="left">New Room Type: <br> <input type="text" name="editType" size="20"> </p>
            <p align="left">New Room Rate: <br> <input type="number" name="editRate" size="6"> </p>
          <center>
            <input type="submit" value="Update" name="editRoom">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a room -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffRoomView.php">
          
            <center>Delete a Room: <br>
              Are you sure you want to delete this room? This action cannot be undone. Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Room number: <br> <input type="number" name="deleteRoomNum"></p>
            <center><input type="submit" value="Delete room" name="deleteRoom"></center>
          </form>
        </div>
      </div>
    </div>

    <div> <!-- Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add a new reservation: </center>
        <form method="POST" action="staffRoomView.php">
             <p align="left">Room number: <br> <input type="number" name="addRoomNum" size="6"> </p>
            <p align="left">Customer Id: <br> <input type="number" name="addCid" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="addSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="addEDate" size="8"> </p>
          <center>
            <input type="submit" value="Add" name="addRoomReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update existing room reservation: </center>
        <form method="POST" action="staffRoomView.php">
           <p align="left">Old Room number: <br> <input type="number" name="oldRoomNum" size="6"> </p>
            <p align="left">Old Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="oldSDate" size="8"> </p>
            <p align="left">Old End Date: (numbers only - yyyymmdd) <br> <input type="text" name="oldEDate" size="8"> </p>
            <br>
            <p align="left">New Room number: <br> <input type="number" name="updateRoomNum" size="6"> </p>
            <p align="left">New Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="updateSDate" size="8"> </p>
            <p align="left">New End Date: (numbers only - yyyymmdd) <br> <input type="text" name="updateEDate" size="8"> </p>
          <center>
            <input type="submit" value="Update" name="updateRoomReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a room reservation -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffRoomView.php">
            <center>Delete a Room Reservation: <br>
              Are you sure you want to delete this room reservation? This action can't be undone.
              Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Room Number: <br> <input type="number" name="deleteRoomNum"></p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="deleteSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="deleteEDate" size="8"> </p>
            <center><input type="submit" value="Delete reservation" name="deleteRoomReservation"></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
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

// Connect to Oracle DB
if ($db_conn) {

  if (array_key_exists('addRoom', $_POST)) {
   $tuple = array (
      ":bind1" => $_POST['addRoomNum'],
      ":bind2" => $_POST['addType'],
      ":bind3" => $_POST['addRate']
    );
    $alltuples = array (
      $tuple
    );
    //add reservation
    $result = executeBoundSQL("insert into room values (:bind1, :bind2, :bind3)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }
   

  } else
  if (array_key_exists('editRoom', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['oldRoomNum'],
      ":bind2" => $_POST['editRoomNum'],
      ":bind3" => $_POST['editType'],
      ":bind4" => $_POST['editRate']
    );
    $alltuples = array (
      $tuple
    );
    $result1 = executeBoundSQL("select * from room where room_num=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result1, OCI_BOTH)){
      //update room
      executeBoundSQL("update room set room_num=:bind2, room_type=:bind3, room_rate=:bind4 where room_num=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    

  } else
  if(array_key_exists('deleteRoom', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteRoomNum']
    );
    $alltuples = array (
      $tuple
    );
    $result2 = executeBoundSQL("select * from room where room_num=:bind1", $alltuples);
    if($row2 = OCI_Fetch_Array($result2, OCI_BOTH)){
      executeBoundSQL("delete from room where room_num=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    

  } else
  if (array_key_exists('updateRoomReservation', $_POST)) {
    $tuple = array (
      ":bind1" => $_POST['oldRoomNum'],
      ":bind2" => $_POST['oldSDate'],
      ":bind3" => $_POST['oldEDate'],

      ":bind4" => $_POST['updateRoomNum'],
      ":bind6" => $_POST['updateSDate'],
      ":bind7" => $_POST['updateEDate']
    );
    $alltuples = array (
      $tuple
    );

    $result4 = executeBoundSQL("select * from roomReservation where room_num=:bind1 and start_date=:bind2 and end_date=:bind3 ", $alltuples);
    if($row = OCI_Fetch_Array($result4, OCI_BOTH)){
      //update equip reservation
      executeBoundSQL("update roomReservation set room_num=:bind4, start_date=:bind6, end_date=:bind7 where room_num=:bind1 and start_date=:bind2 and end_date=:bind3 ", $alltuples);
      OCICommit($db_conn);
    }

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    

  } else
  if (array_key_exists('addRoomReservation', $_POST)) {
    $tuple = array (
      ":bind1" => $_POST['addRoomNum'],
      ":bind2" => $_POST['addCid'],
      ":bind3" => $_POST['addSDate'],
      ":bind4" => $_POST['addEDate']
    );
    $alltuples = array (
      $tuple
    );
    $result5 = executeBoundSQL("insert into roomReservation values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    

  } else
  if(array_key_exists('deleteRoomReservation', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteRoomNum'],
      ":bind2" => $_POST['deleteSDate'],
      ":bind3" => $_POST['deleteEDate']
    );
    $alltuples = array (
      $tuple
    );
    $result6 = executeBoundSQL("select * from roomReservation where room_num=:bind1 and start_date=:bind2 and end_date=:bind3", $alltuples);
    if($row3 = OCI_Fetch_Array($result6, OCI_BOTH)){
      $resultTemp = executeBoundSQL("delete from roomReservation where room_num=:bind1 and start_date=:bind2 and end_date=:bind3", $alltuples);
      OCICommit($db_conn);
    }
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
