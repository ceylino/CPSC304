<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_i4s0b", "a13641155", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored
?>

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id:</p> <!-- TODO: echo the staff id. -->

<div style="display: flex;
            width: 100%;
            justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Booked Lessons: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
      //TODO : this part needs to be changed
        $result = executePlainSQL("select c.c_name, s.s_name, l.lesson_type, l.lesson_datetime from bookedLessons b, lesson l, customer c, skistaff s where b.lesson_type = l.lesson_type and b.c_id = c.c_id and l.staff_id = s.staff_id"); 
        echo "<table>";
        echo "<tr><th>Customer Name</th><th>Staff Name</th><th>Lesson Type Name</th><th>Lesson Date&Time</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["C_NAME"] . "</td><td>" . $row["S_NAME"] . "</td><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
        }
        echo "</table>";
      ?>
     

    <h3> Available Lessons: </h3> 
    <?php
      //TODO currently displays all the lessons
      echo "This is not the right query";
        $result = executePlainSQL("select s.s_name, l.lesson_type, l.lesson_datetime from lesson l, skistaff s where l.staff_id = s.staff_id"); 
        echo "<table>";
        echo "<tr><th>Instructor Name</th><th>Lesson Type</th><th>Date and Time</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["S_NAME"] . "</td><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
        }
        echo "</table>";
      ?>
      </div>

    <div style="justify-content: flex-start;">
    <h3> Lessons Classlist: </h3>
    <?php
        $result = executePlainSQL("select s.s_name, l.lesson_type, l.lesson_datetime from lesson l, skistaff s where l.staff_id = s.staff_id"); 
        echo "<table>";
        echo "<tr><th>Instructor Name</th><th>Lesson Type</th><th>Date and Time</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["S_NAME"] . "</td><td>" . $row["LESSON_TYPE"] . "</td><td>" . $row["LESSON_DATETIME"] . "</td></tr>";
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
        <form action="staffDir.php">
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

    <div> <!-- Lesson -->
      <!-- Add a Lesson -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new lesson: </center>
        <form method="POST" action="staffLessonView.php">
          <p align="left">Staff Id: <br> <input type="number" name="addLSid" size="6"> </p>
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
            <p align="left">Old Staff ID: <br> <input type="number" name="oldLSid" size="6"> </p>
            <p align="left">Old Lesson Datetime: <br>(numbers only - yyyymmddhhmm) <br> <input type="number" name="oldLDate" size="12"> </p>
            <p align="left">Old Lesson Type: <br> <input type="text" name="oldLType" size="30"> </p>
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
            <p align="left">Staff Id: <br> <input type="number" name="deleteLSid" size="6"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="deleteLType" size="30"> </p>
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
            <p align="left">Customer Id: <br> <input type="number" name="deleteBCid" size="6"></p>
            <p align="left">Lesson Type: <br> <input type="text" name="deleteBType" size="20"></p>
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
      ":bind2" => $_POST['addLDate'],
      ":bind3" => $_POST['addLType']
		);
		$alltuples = array (
			$tuple
		);
    //add lesson

    $result = executeBoundSQL("select * from skiStaff where staff_id=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //check if staff id exists
      executeBoundSQL("insert into lessonTime values (:bind3, :bind2)", $alltuples);
      OCICommit($db_conn);
      executeBoundSQL("insert into lesson values (:bind1, :bind2, :bind3)", $alltuples);
      OCICommit($db_conn);
    }
    else{
      echo "This staff member doesn't exist!";
    }
    if ($_POST && $success) {
      header("location: staffLessonView.php");
    }

	} else
  if (array_key_exists('updateLesson', $_POST)){
		$tuple = array (
      ":bind1" => $_POST['oldLSid'],
      ":bind0" => $_POST['oldLDate'],
      ":bind2" => $_POST['oldLType'],
      ":bind3" => $_POST['newLSid'],
      ":bind4" => $_POST['newLDate'],
      ":bind5" => $_POST['newLType']
		);
		$alltuples = array (
			$tuple
		);
    $result = executeBoundSQL("select * from lesson where staff_id=:bind1 and lesson_type=:bind2 and lesson_datetime=:bind0", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){//Now check if the updated type and date exist in lessonTime
      $result = executeBoundSQL("select * from lessonTime where lesson_type=:bind5 and lesson_datetime=:bind4", $alltuples);

      if($row = OCI_Fetch_Array($result, OCI_BOTH)){ // If this entry already exists in Lesson time = update lesson
      executeBoundSQL("update lesson set staff_id=:bind3, lesson_datetime=:bind4, lesson_type=:bind5 where lesson_datetime=:bind0 and staff_id=:bind1 and lesson_type=:bind2", $alltuples);
      OCICommit($db_conn);
      echo "<meta http-equiv='refresh' content='0'>";

      }
      else{
        //add entry to lessonTime first
        executeBoundSQL("insert into lessonTime values (:bind5, :bind4)", $alltuples);
        OCICommit($db_conn);
        executeBoundSQL("update lesson set staff_id=:bind3, lesson_datetime=:bind4, lesson_type=:bind5 where lesson_datetime=:bind0 and staff_id=:bind1 and lesson_type=:bind2", $alltuples);
        OCICommit($db_conn);
      }
      echo "<meta http-equiv='refresh' content='0'>";
    }
    if ($_POST && $success) {
      header("location: staffLessonView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

	} else
  if (array_key_exists('deleteLesson', $_POST)) {
  	$tuple = array (
      ":bind1" => $_POST['deleteLSid'],
      ":bind2" => $_POST['deleteLType']
  	);
  	$alltuples = array (
  		$tuple
  	);
    //delete lesson
    $result = executeBoundSQL("select * from lesson where staff_id=:bind1 and lesson_type=:bind2", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      executeBoundSQL("delete from lesson where staff_id=:bind1 and lesson_type=:bind2", $alltuples);
      OCICommit($db_conn);
    }

    if ($_POST && $success) {
      header("location: staffLessonView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

	} else
  if (array_key_exists('addBooking', $_POST)) {
  	$tuple = array (
      ":bind1" => $_POST['addBCid'],
      ":bind2" => $_POST['addBDate'],
      ":bind3" => $_POST['addBType']
  	);
  	$alltuples = array (
  		$tuple
  	);
    //add reservation
    $result2 = executeBoundSQL("insert into bookedLessons values (:bind1, :bind2, :bind3)", $alltuples);
    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: staffLessonView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";

	} else
  if(array_key_exists('deleteBooking', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['deleteBType'],
      ":bind2" => $_POST['deleteBCid']
  	);
    $alltuples = array (
      $tuple
    );
    $result = executeBoundSQL("select * from bookedLessons where c_id=:bind2 and lesson_type=:bind1", $alltuples);
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){
      //delete booking
      executeBoundSQL("delete from bookedLessons where c_id=:bind2 and lesson_type=:bind1", $alltuples);
      OCICommit($db_conn);
    }
    if ($_POST && $success) {
    	header("location: staffLessonView.php");
    }
    echo "<meta http-equiv='refresh' content='0'>";
  }else

	//Commit to save changes...
	OCILogoff($db_conn);
} else {
	echo "cannot connect";
	$e = OCI_Error(); // For OCILogon errors pass no handle
	echo htmlentities($e['message']);
}

?>
