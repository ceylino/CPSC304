<?php
//Setup
if (isset($_POST["staffid"])) {
  $staffidcookie = $_POST['staffid'];
}else{
  $staffidcookie = $_COOKIE["staffid"];
}

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug");
?>

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id: <?php echo $staffidcookie; ?> </p>

<div style="display: flex; width: 100%; justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Hotel Management: </h3>
      <?php
        $result = executePlainSQL("select r.room_num, r.room_type, m.staff_id, h.s_name from room r, roomManagement m, hotelStaff h where r.room_num = m.room_num and m.staff_id = h.staff_id");
        echo "<table>";
        echo "<tr><th>Room Number</th><th>Room Type</th><th>Staff Id</th><th>Staff Name</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["ROOM_NUM"] . "</td><td>" . $row["ROOM_TYPE"] . "</td><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td></tr>";
        }
        echo "</table>";
      ?>

      <div style="display: flex; width: 100%; justify-content: space-between;">
        <div style="justify-content: flex-start;">
        <h3> Hotel Staff: </h3>
        <?php
          $result = executePlainSQL("select * from hotelStaff");
          echo "<table>";
          echo "<tr><th>Id</th><th>Staff Name</th></tr>";
          while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td></tr>";
          }
          echo "</table>";
        ?>
        </div>

        <div style="justify-content: flex-start;">
          <h3> Rooms: </h3>
          <?php
            $result = executePlainSQL("select * from room");
            echo "<table>";
            echo "<tr><th>Room Number</th><th>Room Type</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
              echo "<tr><td>" . $row["ROOM_NUM"] . "</td><td>" . $row["ROOM_TYPE"] . "</td></tr>";
            }
            echo "</table>";
          ?>
        </div>
      </div>
    </div>

    <div style="justify-content: flex-start;">
    <h3> Equipment Management: </h3>
    <?php
        $result = executePlainSQL("select r.equip_id, r.equip_type, m.staff_id, s.s_name from rentalEquip r, equipManagement m, skiStaff s where r.equip_id = m.equip_id and m.staff_id = s.staff_id");
        echo "<table>";
        echo "<tr><th>Equipment Id</th><th>Equipment Type</th><th>Staff Id</th><th>Staff Name</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["EQUIP_ID"] . "</td><td>" . $row["EQUIP_TYPE"] . "</td><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td></tr>";
        }
        echo "</table>";
      ?>

      <div style="display: flex; width: 100%; justify-content: space-between;">
        <div style="justify-content: flex-start;">
        <h3> Ski Staff: </h3>
        <?php
          $result = executePlainSQL("select * from skiStaff");
          echo "<table>";
          echo "<tr><th>Id</th><th>Staff Name</th></tr>";
          while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td></tr>";
          }
          echo "</table>";
        ?>
        </div>

        <div style="justify-content: flex-start;">
          <h3> Equipments: </h3>
          <?php
            $result = executePlainSQL("select * from rentalEquip");
            echo "<table>";
            echo "<tr><th>Equipment Id</th><th>Equipment Type</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
              echo "<tr><td>" . $row["EQUIP_ID"] . "</td><td>" . $row["EQUIP_TYPE"] . "</td></tr>";
            }
            echo "</table>";
          ?>
        </div>
      </div>
  </div>

  <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey; width: 200px; padding-top: 20px; padding-bottom: 1px">
      <center>
        <form method="POST" action="staffDir.php">
        <input type="hidden" name="staffid" value="<?php echo $staffidcookie; ?>">
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>
  </div>
</div>

<div style="height: 30px;"></div>

<!-- Forms to add & update data -->
<center>
  <div style="display: flex; width: 100%; justify-content: space-around;">

    <div> <!-- Room Management -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new room management: </center>
        <form method="POST" action="staffManagementView.php">

          <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"></p>
          <p align="left">Staff Id: <br> <input type="number" name="editSid" size="6"> </p>
          <center><input type="submit" value="Add" name="addRoomManage"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Update Room management -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update existing room management: </center>
        <form method="POST" action="staffManagementView.php">
          <p align="left">Old Room number: <br> <input type="number" name="oldRoomNum" size="6"></p>
          <p align="left">Old Staff Id: <br> <input type="number" name="oldSid" size="6"> </p>
          <p align="left">New Room number: <br> <input type="number" name="newRoomNum" size="6"></p>
          <center><input type="submit" value="Update" name="updateRoomManage"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a Room management -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffManagementView.php">
            <center>Delete room management: <br> Are you sure you want to delete this entry? This action cannot be undone.<br></center>
            <p align="left">Room number: <br> <input type="number" name="deleteRoomNum" size="6"></p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteSid" size="6"> </p>
            <center><input type="submit" value="Delete Management" name="deleteRoomManage"></center>
          </form>
        </div>
      </div>
    </div>

    <div> <!-- Equip Management -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new equipment management: </center>
        <form method="POST" action="staffManagementView.php">
          <!-- TODO: Add any SQL processing: check if this equipment & staff exists. If so: update, if not insert-->
          <p align="left">Equipment ID: <br> <input type="number" name="editEquipId" size="6"></p>
          <p align="left">Staff Id: <br> <input type="number" name="editSid" size="6"> </p>
          <center><input type="submit" value="Add" name="addEquipManage"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Update Equip management -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update existing equipment management: </center>
        <form method="POST" action="staffManagementView.php">
          <p align="left">Old Equip Id: <br> <input type="number" name="oldEquipId" size="6"></p>
          <p align="left">Old Staff Id: <br> <input type="number" name="oldESid" size="6"> </p>
          <p align="left">New Equip Id: <br> <input type="number" name="newEquipId" size="6"></p>
          <center><input type="submit" value="Update" name="updateEquipManage"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a equipment management -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffManagementView.php">
            <center>Delete equipment management: <br> Are you sure you want to delete this entry? This action cannot be undone.<br></center>
            <p align="left">Equipment ID: <br> <input type="number" name="deleteEquipId" size="6"></p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteSid" size="6"> </p>
            <center><input type="submit" value="Delete Management" name="deleteEquipManage"></center>
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

// Connect to Oracle DB
if ($db_conn) {

	if (array_key_exists('addRoomManage', $_POST)) {
   $tuple = array (
      ":bind1" => $_POST['editRoomNum'],
      ":bind2" => $_POST['editSid']
		);
		$alltuples = array (
			$tuple
		);
    //add management
    $result2 = executeBoundSQL("insert into roomManagement values (:bind1, :bind2)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }


	} else
  if (array_key_exists('updateRoomManage', $_POST)){
		$tuple = array (
      ":bind1" => $_POST['oldRoomNum'],
      ":bind2" => $_POST['oldSid'],

      ":bind3" => $_POST['newRoomNum']
		);
		$alltuples = array (
			$tuple
		);
    $result = executeBoundSQL("select * from roomManagement where room_num=:bind1 and staff_id=:bind2", $alltuples);

    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //update room management
      executeBoundSQL("update roomManagement set room_num=:bind3 where room_num=:bind1 and staff_id=:bind2", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }


	} else
  if(array_key_exists('deleteRoomManage', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteRoomNum'],
      ":bind2" => $_POST['deleteSid']
  	);
    $alltuples = array (
      $tuple
    );
    $result = executeBoundSQL("select * from roomManagement where staff_id=:bind2 and room_num=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //delete management
      $resultTemp = executeBoundSQL("delete from roomManagement where staff_id=:bind2 and room_num=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
    	setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }

  }
  if (array_key_exists('addEquipManage', $_POST)) {
   $tuple = array (
      ":bind1" => $_POST['editEquipId'],
      ":bind2" => $_POST['editSid']
    );
    $alltuples = array (
      $tuple
    );
    //add management
    $result2 = executeBoundSQL("insert into equipManagement values (:bind1, :bind2)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }


  } else
  if (array_key_exists('updateEquipManage', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['oldEquipId'],
      ":bind2" => $_POST['oldESid'],

      ":bind3" => $_POST['newEquipId']
    );
    $alltuples = array (
      $tuple
    );
    $result = executeBoundSQL("select * from equipManagement where equip_id=:bind1 and staff_id=:bind2", $alltuples);

    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //update equip management
      executeBoundSQL("update equipManagement set equip_id=:bind3 where equip_id=:bind1 and staff_id=:bind2", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }


  } else
  if(array_key_exists('deleteEquipManage', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteEquipId'],
      ":bind2" => $_POST['deleteSid']
    );
    $alltuples = array (
      $tuple
    );
    $result = executeBoundSQL("select * from equipManagement where staff_id=:bind2 and equip_id=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //delete management
      $resultTemp = executeBoundSQL("delete from equipManagement where staff_id=:bind2 and equip_id=:bind1", $alltuples);
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
