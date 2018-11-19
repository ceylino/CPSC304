<?php
//Setup
session_start();
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
<p> Welcome staff id: <?php echo $staffidcookie; ?></p>

<div style="display: flex; width: 100%; justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Booked Lessons: </h3>
      <?php
        $result = executePlainSQL("select bl.c_id, bl.lesson_id, bl.lesson_type, bl.lesson_datetime, c.c_name from bookedLessons bl, customer c where c.c_id = bl.c_id");
        echo "<table>";
        echo "<tr><th>Customer Id</th><th>Customer Name</th><th>Lesson Id</th><th>Lesson Type Name</th><th>Lesson Date&Time</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["C_ID"] . "</td><td>" . $row["C_NAME"] . "</td><td>" . $row["LESSON_ID"] . "</td><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3>Lessons: </h3>
    <?php
        $result = executePlainSQL("select s.s_name, l.lesson_type, l.lesson_datetime, l.lesson_id from lesson l, skiStaff s where l.staff_id = s.staff_id");
        echo "<table>";
        echo "<tr><th>ID</th><th>Instructor Name</th><th>Lesson Type</th><th>Date and Time</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["LESSON_ID"] .  "</td><td>" . $row["S_NAME"] .  "</td><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
        }
        echo "</table>";
      ?>

      <h3> Customers: </h3>
      <?php
          $result = executePlainSQL("select * from customer");
          echo "<table>";
          echo "<tr><th>Customer Id</th><th>Customer Name</th><th>E-mail</th></tr>";
          while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["C_ID"] . "</td><td>" . $row["C_NAME"] . "</td><td>" . $row["E_MAIL"] . "</td></tr>";
          }
          echo "</table>";
      ?>
  </div>

  <div style="justify-content: flex-start;">
    <h3> Lessons Classlist: </h3>
    <?php
        $result = executePlainSQL("select s.s_name, l.lesson_type, l.lesson_datetime from lesson l, skistaff s where l.staff_id = s.staff_id");
        echo "<table>";
        echo "<tr><th>Instructor Name</th><th>Lesson Type</th><th>Lesson Datetime</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["S_NAME"] . "</td><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Ski Staff: </h3>
    <?php
        //sql statement
        $result = executePlainSQL("select staff_id, s_name from skiStaff");
        echo "<table>";
        echo "<tr><th>Staff Id</th><th>Name</th></tr>"; //column names
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          //column names, caps for var names
          echo "<tr><td>" . $row["STAFF_ID"] . "</td><td>" . $row["S_NAME"] . "</td></tr>";
        }
        //
        echo "</table>";
    ?>

    <h3> Lessons Times: </h3>
    <?php
          //sql statement
          $result = executePlainSQL("select * from lessonTime");
          echo "<table>";
          echo "<tr><th>Lesson Type</th><th>Lesson Datetime</th></tr>"; //column names
          while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            //column names, caps for var names
            echo "<tr><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
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
  </div>
</div>

<div style="height: 30px;"></div>

<!-- Forms to add & update data -->
<center>
  <div style="display: flex; width: 100%; justify-content: space-around;">

    <div> <!-- Lesson -->
      <!-- Add a Lesson -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new lesson: </center>
        <form method="POST" action="staffLessonView.php">
          <p align="left">Staff Id: <br> <input type="number" name="addLSid" size="6"> </p>
          <p align="left">New Lesson Id: <br> <input type="number" name="addLLid" size="6"> </p>
          <p align="left">Lesson Datetime: <br>(numbers only - yyyymmddhhmm) <br> <input type="number" name="addLDate" size="12"> </p>
          <p align="left">Lesson Type: <br> <input type="text" name="addLType" size="30"> </p>
          <center><input type="submit" value="Add" name="addLesson"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Update Lesson -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Update Lesson: </center>
        <form method="POST" action="staffLessonView.php">
            <p align="left">Lesson ID: <br> <input type="number" name="oldLLid" size="6"> </p>
            <br>
            <p align="left">New Staff ID: <br> <input type="number" name="newLSid" size="6"> </p>
            <p align="left">New Lesson Datetime: <br>(numbers only - yyyymmddhhmm) <br> <input type="number" name="newLDate" size="12"> </p>
            <p align="left">New Lesson Type: <br> <input type="text" name="newLType" size="30"> </p>
          <center>
            <input type="submit" value="Update" name="updateLesson">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a lesson -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffLessonView.php">
            <center>Delete a lesson: <br>
              Are you sure you want to delete this lesson? This action cannot be undone.<br>
            </center>
            <p align="left">Lesson Id: <br> <input type="number" name="deleteLLid" size="6"> </p>
            <center><input type="submit" value="Delete Lesson" name="deleteLesson"></center>
          </form>
        </div>
      </div>

    </div>

    <div> <!-- Lesson booking -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Book a new lesson: </center>
        <form method="POST" action="staffLessonView.php">
            <p align="left">Customer Id: <br> <input type="number" name="addBCid" size="6"> </p>
            <p align="left">Lesson Id: <br> <input type="number" name="addBLid" size="6"> </p>
            <p align="left">Lesson Datetime: <br>(numbers only - yyyymmddhhmm) <br> <input type="number" name="addBDate" size="12"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="addBType" size="20"> </p>
          <center><input type="submit" value="Book Lesson" name="addBooking"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a lesson booking -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffLessonView.php">
            <center>Delete a lesson booking: <br>
              Are you sure you want to delete this booking? This action cannot be undone.<br>
            </center>
            <p align="left">Lesson Id: <br> <input type="number" name="deleteBLid" size="6"></p>
            <p align="left">Customer Id: <br> <input type="text" name="deleteBCid" size="20"></p>
            <center><input type="submit" value="Delete Booking" name="deleteBooking"></center>
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

	if (array_key_exists('addLesson', $_POST)) {
   $tuple = array (
      ":bind1" => $_POST['addLSid'],
      ":bind2" => $_POST['addLLid'],
      ":bind3" => $_POST['addLDate'],
      ":bind4" => $_POST['addLType']
		);
		$alltuples = array (
			$tuple
		);

      executeBoundSQL("insert into lessonTime values (:bind4, :bind3)", $alltuples);
      OCICommit($db_conn);

      executeBoundSQL("insert into lesson values (:bind2, :bind1, :bind3, :bind4)", $alltuples);
      OCICommit($db_conn);

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }

	} else
  if (array_key_exists('updateLesson', $_POST)){
		$tuple = array (
      ":bind1" => $_POST['oldLLid'],
      ":bind3" => $_POST['newLSid'],
      ":bind4" => $_POST['newLDate'],
      ":bind5" => $_POST['newLType']
		);
		$alltuples = array (
			$tuple
		);
    $result = executeBoundSQL("select * from lesson where lesson_id=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){//Now check if the updated type and date exist in lessonTime
      $result = executeBoundSQL("select * from lessonTime where lesson_type=:bind5 and lesson_datetime=:bind4", $alltuples);

      if($row = OCI_Fetch_Array($result, OCI_BOTH)){ // If this entry already exists in Lesson time = update lesson
      executeBoundSQL("update lesson set staff_id=:bind3, lesson_datetime=:bind4, lesson_type=:bind5 where lesson_id=:bind1", $alltuples);
      OCICommit($db_conn);
      }
      else{
        //add entry to lessonTime first
        executeBoundSQL("insert into lessonTime values (:bind5, :bind4)", $alltuples);
        OCICommit($db_conn);
        executeBoundSQL("update lesson set staff_id=:bind3, lesson_datetime=:bind4, lesson_type=:bind5 where lesson_id=:bind1", $alltuples);
        OCICommit($db_conn);
      }

    }
    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }

	} else
  if (array_key_exists('deleteLesson', $_POST)) {
  	$tuple = array (
      ":bind1" => $_POST['deleteLLid']
  	);
  	$alltuples = array (
  		$tuple
  	);
    //delete lesson
    $result = executeBoundSQL("select * from lesson where lesson_id=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      executeBoundSQL("delete from lesson where lesson_id=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }

	} else
  if (array_key_exists('addBooking', $_POST)) {
  	$tuple = array (
      ":bind1" => $_POST['addBCid'],
      ":bind2" => $_POST['addBDate'],
      ":bind3" => $_POST['addBType'],
      ":bind4" => $_POST['addBLid']
  	);
  	$alltuples = array (
  		$tuple
  	);

    $result = executeBoundSQL("insert into bookedLessons values (:bind1, :bind2, :bind4, :bind3)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }

	} else
  if(array_key_exists('deleteBooking', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteBLid'],
      ":bind2" => $_POST['deleteBCid']
  	);
    $alltuples = array (
      $tuple
    );
    $result = executeBoundSQL("select * from bookedLessons where c_id=:bind2 and lesson_id=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //delete booking
      executeBoundSQL("delete from bookedLessons where c_id=:bind2 and lesson_id=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
    	setcookie("staffid", $staffidcookie);
      echo "<meta http-equiv='refresh' content='0'>";
    }
  }else

	//Commit to save changes...
	OCILogoff($db_conn);
} else {
	echo "cannot connect";
	$e = OCI_Error(); // For OCILogon errors pass no handle
	echo htmlentities($e['message']);
}
?>
