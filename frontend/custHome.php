<!-- Customer page: This is the main customer page. This is where logged in customers and members can view their current reservations etc. and be redirected to create new ones, edit or delete existing ones.
-->


<!DOCTYPE html>
<html>
<p>Customer</p>

<br>
<?php 
$custid = $_COOKIE["custid"];
echo $custid;


//Setup connection and connect to DB -->

session_start();
echo $custid;

//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_e6b2b", "a43992254", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored

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

	if (array_key_exists('addRoomReservation', $_POST)) {
   $tuple = array (
      ":bind1" => $_POST['addRoomNum'],
      ":bind2" => $custid, //TODO: get this from token - cid
      ":bind3" => $_POST['addRoomSDate'],
      ":bind4" => $_POST['addRoomEDate']
		);
		$alltuples = array (
			$tuple
		);
    //add reservation
    $result2 = executeBoundSQL("insert into roomReservation values (:bind1,:bind2, :bind3, :bind4)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: custHome.php");
    }

	} else
  if (array_key_exists('updateRoomReservation', $_POST)){
		$tuple = array (
      ":bind1" => $custid, //TODO: get this from token - cid
      ":bind2" => $_POST['oldRoomNum'],
      ":bind4" => $_POST['oldRoomSDate'],
      ":bind5" => $_POST['oldRoomEDate'],

      ":bind7" => $_POST['newRoomNum'],
      ":bind9" => $_POST['newRoomSDate'],
      ":bind0" => $_POST['newRoomEDate']
		);
		$alltuples = array (
			$tuple
		);
    $result = executeBoundSQL("select * from roomReservation where room_num=:bind2 and start_date=:bind4 and end_date=:bind5", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //update room reservation
      executeBoundSQL("update roomReservation set room_num=:bind7, c_id=:bind1, start_date=:bind9, end_date=:bind0 where room_num=:bind2 and start_date=:bind4 and end_date=:bind5", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      header("location: custHome.php");
    }

	} else
  if (array_key_exists('addEquipReservation', $_POST)) {
  	$tuple = array (
      ":bind0" => $_POST['editEquipId'],
      ":bind1" => $custid, //TODO: add token -cid
      ":bind2" => $_POST['editEquipSDate'],
      ":bind3" => $_POST['editEquipEDate']
  	);
  	$alltuples = array (
  		$tuple
  	);
    //add reservation
    $result2 = executeBoundSQL("insert into equipReservation values (:bind0, :bind1, :bind2, :bind3)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: custHome.php");
    }

	} else
  if (array_key_exists('updateEquipReservation', $_POST)) {
    $tuple = array (
    	":bind1" => $_POST['oldEquipNum'],
    	":bind2" => $_POST['oldEquipSDate'],
      ":bind3" => $_POST['oldEquipEDate'],

      ":bind4" => $_POST['newEquipNum'],
      ":bind5" => $_POST['newEquipSDate'],
      ":bind6" => $_POST['newEquipEDate'],

      ":bind7" => $custid //TODO: get this from token - cid

    );
    $alltuples = array (
    	$tuple
    );

    $result = executeBoundSQL("select * from equipReservation where equip_id=:bind1 and start_date=:bind2 and end_date=:bind3 ", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //update equip reservation
      executeBoundSQL("update equipReservation set equip_id=:bind4, c_id=:bind7, start_date=:bind5, end_date=:bind6 where equip_id=:bind1 and start_date=:bind2 and end_date=:bind3 ", $alltuples);
      OCICommit($db_conn);
    }

    if ($_POST && $success) {
    	header("location: custHome.php");
    }

  } else
  if (array_key_exists('addBooking', $_POST)) {
  	$tuple = array (
      ":bind0" => $_POST['addType'],
      ":bind1" => $custid //TODO: add token -cid
  	);
  	$alltuples = array (
  		$tuple
  	);
    //add reservation
    $result2 = executeBoundSQL("insert into bookedLessons values (:bind1, :bind0)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: custHome.php");
    }

	} else
  if(array_key_exists('deleteLBooking', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteLType'],
      ":bind2" => $custid //TODO: add token -cid
  	);
    $alltuples = array (
      $tuple
    );
    $result3 = executeBoundSQL("select * from bookedLessons where c_id=:bind2 and lesson_type=:bind1", $alltuples);
    if($row3 = OCI_Fetch_Array($result3, OCI_BOTH)){
      //delete booking
      $resultTemp = executeBoundSQL("delete from bookedLessons where c_id=:bind2 and lesson_type=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
    	//header("location: custHome.php");
    }
  }else
  if(array_key_exists('addPass', $_POST)){
    $tuple = array (
      ":bind0" => $custid, //TODO: add token -cid
      ":bind1" => $_POST['passPid'],
      ":bind2" => $_POST['passDate'],
      ":bind3" => 50 // pass price is fixed.
  	);
    $alltuples = array (
      $tuple
    );
    //add reservation
    executeBoundSQL("insert into purchasedLiftPass values (:bind0, :bind1, :bind2, :bind3)", $alltuples);
    OCICommit($db_conn);
    if ($_POST && $success) {
    	header("location: custHome.php");
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
<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome customer id:<?php echo $custid;?> </p> <!-- TODO: echo the customer id. -->

<div style="display: flex; width: 100%; justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Rooms Reservations: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php

        $tuple = array (
          ":bind1" => $custid //TODO: get this from token - cid
        );
        $alltuples = array (
          $tuple
        );
        $result = executeBoundSQL("select * from roomReservation where c_id=:bind1", $alltuples);
        echo "<table>";
        echo "<tr><th>Room Number</th><th>Customer ID</th><th>Start Date</th><th>End Date</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["ROOM_NUM"] . "</td><td>" . $row["C_ID"] . "</td><td>" . $row["START_DATE"] . "</td><td>" . $row["END_DATE"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Equipment Reservations: </h3>

    <h3> Available Lessons: </h3>
    <!--make sure to allow customers to see available lessons or else we cant book new ones-->

    <h3> Booked Lessons: </h3>

    <h3> Purchased Passes: </h3>
  </div>

  <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey; width: 200px; padding-top: 20px; padding-bottom: 1px">
      <center>
        <form method ="POST" action="custProfile.php">
          <input type="submit" value="Edit Profile" name="custProfile">
          <input type="hidden" name="customerid" value="<?php echo $custid; ?>">

        </form>
      </center>
    </div>

  </div>
</div>

<div style="height: 30px;"></div>

<!-- Forms to add & update data -->
<!-- IMPORTANT: before adding any SQL check to see what needs to be done by looking at the createTables file and checking for functional dependencies! Or else THINGS WILL BREAK!!-->
<center>
  <div style="display: flex; width: 100%; justify-content: space-around;">

    <div> <!-- Room Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new room reservation: </center>
        <form method="POST" action="custHome.php">
            <p align="left">Room number: <br> <input type="number" name="addRoomNum" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="addRoomSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="addRoomEDate" size="8"> </p>
          <center>
            <input type="submit" value="Add" name="addRoomReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update room reservation: </center>
        <form method="POST" action="custHome.php">
            <p align="left">Old Room number: <br> <input type="number" name="oldRoomNum" size="6"> </p>
            <p align="left">Old Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="oldRoomSDate" size="8"> </p>
            <p align="left">Old End Date: (numbers only - yyyymmdd) <br> <input type="text" name="oldRoomEDate" size="8"> </p>
            <br>
            <p align="left">New Room number: <br> <input type="number" name="newRoomNum" size="6"> </p>
            <p align="left">New Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="newRoomSDate" size="8"> </p>
            <p align="left">New End Date: (numbers only - yyyymmdd) <br> <input type="text" name="newRoomEDate" size="8"> </p>
          <center>
            <input type="submit" value="Update" name="updateRoomReservation">
          </center>
        </form>
      </div>
    </div>

    <div> <!-- Equip Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new equipment reservation: </center>
        <form method="POST" action="custHome.php">
            <p align="left">Equipment Id: <br> <input type="number" name="editEquipId" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="editEquipSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="editEquipEDate" size="8"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add" name="addEquipReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update equipment reservation: </center>
        <form method="POST" action="custHome.php">
            <p align="left">Old Equipment Id: <br> <input type="number" name="oldEquipNum" size="6"> </p>
            <p align="left">Old Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="oldEquipSDate" size="8"> </p>
            <p align="left">Old End Date: (numbers only - yyyymmdd) <br> <input type="text" name="oldEquipEDate" size="8"> </p>
            <br>
            <p align="left">New Equipment Id: <br> <input type="number" name="newEquipNum" size="6"> </p>
            <p align="left">New Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="newEquipSDate" size="8"> </p>
            <p align="left">New End Date: (numbers only - yyyymmdd) <br> <input type="text" name="newEquipEDate" size="8"> </p>
          <center>
            <input type="submit" value="Update" name="updateEquipReservation">
          </center>
        </form>
      </div>
    </div>

    <div> <!-- Lesson booking -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Book a new lesson: </center>
        <form method="POST" action="custHome.php">
            <p align="left">Lesson Type: <br> <input type="text" name="addType" size="20"> </p>
          <center>
            <input type="submit" value="Book Lesson" name="addBooking">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a lesson booking -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="custHome.php">
            <center>Delete a lesson booking: <br>
              Are you sure you want to delete this booking? This action cannot be undone.<br>
            </center>
            <p align="left">Lesson Type: <br> <input type="text" name="deleteLType" size="20"> </p>
            <center><input type="submit" value="Delete Booking" name="deleteLBooking"></center>
          </form>
        </div>
      </div>
    </div>

    <div> <!-- Buy Pass -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Buy a new pass: </center>
        <form method="POST" action="custHome.php">
          <p align="left">Pass Id: <br> <input type="number" name="passPid" size="6"> </p>
          <p align="left">Purchase Date: (numbers only - yyyymmdd) <br> <input type="text" name="passDate" size="8"> </p>
          <center><input type="submit" value="Buy Pass" name="addPass"></center>
        </form>
      </div>
    </div>

  </div>
</center>


</html>