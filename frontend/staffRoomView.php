<!-- Staff's Room Page -->

<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored
?>

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the staff id. -->

<div style="display: flex;
            width: 100%;
            justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Room Reservations: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
      //TODO : this part needs tobe changed
        $result = executePlainSQL("select * roomReservation where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Rooms: </h3>
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

    <div style="height: 10px;"></div>

    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <!-- Options -->
      <center>
        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="View room status" name="roomStatus">
        </form>
      </center>
    </div>
  </div>
</div>

<div style="height: 30px;"></div>

<!-- Forms to add & update data -->
<!-- IMPORTANT: before adding any SQL check to see what needs to be done by looking at the createTables file and checking for functional dependencies! Or else THINGS WILL BREAK!!-->
<center>
  <div style="display: flex;
              width: 100%;
              justify-content: space-around;">
    <div> <!-- Rooms -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing room: </center>
        <form method="POST" action="staffRoomView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"> </p>
            <p align="left">Room Type: <br> <input type="text" name="editType" size="20"> </p>
            <p align="left">Room Rate: <br> <input type="number" name="editRate" size="6"> </p>
            <!-- Note: remember to update the roomRate table if needed -BEFORE- making any changes to the room table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editRoom">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a room -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete a Room: <br>
              Are you sure you want to delete this room? This action cannot be undone. Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Room number: <br> <input type="number" name="deleteRoomNum"></p>
            <center><input type="submit" value="Delete room" name="deleteRoom"></center>
            <!-- check if room exists, if so, delete. refresh page.-->

          </form>
        </div>
      </div>
    </div>

    <div> <!-- Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing reservation: </center>
        <form method="POST" action="staffRoomView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Confirmation number: <br> <input type="number" name="editConfNum" size="6"> </p>
            <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"> </p>
            <p align="left">Customer Id: <br> <input type="number" name="editCid" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="editSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="editEDate" size="8"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a room -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete a Reservation: <br>
              Are you sure you want to delete this reservation? This action can't be undone.
              Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Confirmation Number: <br> <input type="number" name="deleteConfNum"></p>
            <center><input type="submit" value="Delete reservation" name="deleteReservation"></center>
            <!-- check if reservation exists, if so, delete. refresh page.-->
          </form>
        </div>
      </div>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug");

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
      header("location: staffRoomView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

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
      header("location: staffRoomView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

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
      //delete booking
      executeBoundSQL("delete from room where room_num=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      header("location: staffRoomView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

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
      header("location: staffRoomView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

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
    //add reservation
    $result5 = executeBoundSQL("insert into roomReservation values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: staffRoomView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

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
      //delete booking
      $resultTemp = executeBoundSQL("delete from roomReservation where room_num=:bind1 and start_date=:bind2 and end_date=:bind3", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      header("location: staffRoomView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";
  }

  //Commit to save changes...
  OCILogoff($db_conn);
} else {
  echo "cannot connect";
  $e = OCI_Error(); // For OCILogon errors pass no handle
  echo htmlentities($e['message']);
}

?>
