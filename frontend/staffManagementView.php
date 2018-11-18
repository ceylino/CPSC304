<!-- Customer page: This is the main customer page. This is where logged in customers and members can view their current reservations etc. and be redirected to create new ones, edit or delete existing ones.
-->

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id:M </p> <!-- TODO: echo the staff id. -->

<div style="display: flex; width: 100%; justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> equipment Management: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
      //TODO : this part needs tobe changed
        $result = executePlainSQL("select * equipmentReservation where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Equipment Management: </h3>
  </div>

  <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey; width: 200px; padding-top: 20px; padding-bottom: 1px">
      <center>
        <form action=""> <!-- TODO: Add rerouting to other staff pages -->
          <input type="submit" value="Back to Main Page" name="staffDir">
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
          <p align="left">New Staff Id: <br> <input type="number" name="newSid" size="6"> </p>
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
            <!-- check if exists, if so, delete. refresh page.-->
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
          <p align="left">New Staff Id: <br> <input type="number" name="newESid" size="6"> </p>
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
      header("location: staffManagementView.php");
    }

	} else
  if (array_key_exists('updateRoomManage', $_POST)){
		$tuple = array (
      ":bind1" => $_POST['oldRoomNum'],
      ":bind2" => $_POST['oldSid'],

      ":bind3" => $_POST['newRoomNum'],
      ":bind4" => $_POST['newSid']
		);
		$alltuples = array (
			$tuple
		);
    $result = executeBoundSQL("select * from roomManagement where room_num=:bind1 and staff_id=:bind2", $alltuples);

    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //update room management
      executeBoundSQL("update roomManagement set room_num=:bind3, staff_id=:bind4 where room_num=:bind1 and staff_id=:bind2", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      header("location: staffManagementView.php");
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
    	header("location: staffManagementView.php");
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
      header("location: staffManagementView.php");
    }

  } else
  if (array_key_exists('updateEquipManage', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['oldEquipId'],
      ":bind2" => $_POST['oldESid'],

      ":bind3" => $_POST['newEquipId'],
      ":bind4" => $_POST['newESid']
    );
    $alltuples = array (
      $tuple
    );
    $result = executeBoundSQL("select * from equipManagement where equip_id=:bind1 and staff_id=:bind2", $alltuples);

    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //update equip management
      executeBoundSQL("update equipManagement set equip_id=:bind3, staff_id=:bind4 where equip_id=:bind1 and staff_id=:bind2", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      header("location: staffManagementView.php");
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
      header("location: staffManagementView.php");
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
