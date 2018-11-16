<!-- Customer page: This is the main customer page. This is where logged in customers and members can view their current reservations etc. and be redirected to create new ones, edit or delete existing ones.
-->

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome customer id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the customer id. -->

<div style="display: flex;
            width: 100%;
            justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Rooms Reservations: </h3>
    <!-- make this a view: These views allow customers to view room and rental equipment information, while not allowing them to make any changes, since changes to these can only be made by staff members.-->
    <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
        $result = executePlainSQL("select * roomReservation where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Equipment Reservations: </h3>
    <!-- make this a view: These views allow customers to view room and rental equipment information, while not allowing them to make any changes, since changes to these can only be made by staff members.-->


    <h3> Available Lessons: </h3>
    <!--make sure to allow customers to see available lessons or else we cant book new ones-->
    <!-- Make this a view: This view will allow them to see the instructor and the details of the lesson without exposing the instructor’s staff_id.-->

    <h3> Booked Lessons: </h3>
    <!-- Make this a view: This view allows the customers to see which lessons they are booked in but doesn’t allow them to see the full classlist.-->

    <h3> Purchased Passes: </h3>
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
          <input type="submit" value="Edit Profile" name="custProfile">
        </form>
      </center>
    </div>

  </div>
</div>

<div style="height: 30px;"></div>

<!---------------- Forms to add & update data ---------------->
<!-- IMPORTANT: before adding any SQL check to see what needs to be done by looking at the createTables file and checking for functional dependencies! Or else THINGS WILL BREAK!!-->
<center>
  <div style="display: flex;
              width: 100%;
              justify-content: space-around;">

    <div> <!-- Room Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing room reservation: </center>
        <form method="POST" action="custHome.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Confirmation number: <br> <input type="number" name="editRoomConfNum" size="6"> </p>
            <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"> </p>
            <p align="left">Customer Id: <br> <input type="number" name="editRoomCid" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="editRoomSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="editRoomEDate" size="8"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editRoomReservation">
          </center>
        </form>
      </div>
    </div>

    <div> <!-- Equip Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing equipment reservation: </center>
        <form method="POST" action="custHome.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Confirmation number: <br> <input type="number" name="editEquipConfNum" size="6"> </p>
            <p align="left">Equipment Id: <br> <input type="number" name="editEquipId" size="6"> </p>
            <p align="left">Customer Id: <br> <input type="number" name="editEquipCid" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="editEquipSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="editEquipEDate" size="8"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editEquipReservation">
          </center>
        </form>
      </div>
    </div>

    <div> <!-- Lesson booking -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Book a new lesson: </center>
        <form method="POST" action="custHome.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Customer Id: <br> <input type="number" name="editLessonCid" size="6"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="editType" size="20"> </p>
            <p align="left">Staff Id: <br> <input type="number" name="editLessonCid" size="6"> </p>
            <!-- Note: remember to update the roomRate table if needed -BEFORE- making any changes to the room table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Book Lesson" name="editBooking">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a lesson booking -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete a lesson booking: <br>
              Are you sure you want to delete this booking? This action cannot be undone.<br>
            </center>
            <p align="left">Customer Id: <br> <input type="number" name="deleteLessonCid" size="6"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="deleteType" size="20"> </p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteLessonCid" size="6"> </p>

            <center><input type="submit" value="Delete Booking" name="deleteBooking"></center>
            <!-- check if booking exists, if so, delete. refresh page.-->

          </form>
        </div>
      </div>
    </div>

    <div> <!-- Buy Pass -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Buy a new pass: </center>
        <form method="POST" action="custHome.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Customer Id: <br> <input type="number" name="passCid" size="6"> </p>
            <p align="left">Pass Id: <br> <input type="number" name="PassPid" size="6"> </p>
            <p align="left">Purchase Date: (numbers only - yyyymmdd) <br> <input type="text" name="passDate" size="8"> </p>
            <p align="left">Price:<br> <input type="number" name="passPrice" size="6"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Buy Pass" name="newPass">
          </center>
        </form>
      </div>
    </div>

  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored

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

//Ignore this code for now -- needs to be cleaned up
// function printResult($result) { //prints results from a select statement
// 	echo "result from SQL:";
//   echo "<table>";
// 	echo "<tr><th>ID</th><th>Name</th><th>email</th><th>ccnum</th></tr>";
// 	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
// 		// echo "<tr><td>" . $row["c_id"] . "</td>
//     //       <td>" . $row["c_name"] . "</td>
//     //       <td>" . $row["e_mail"] . "</td>
//     //       <td>" . $row["creditcard_num"] . "</td></tr>";
//     echo "$row[1]";
// 	}
//   echo "</table>";
//}

// Connect to Oracle DB
if ($db_conn) {

		if (array_key_exists('staffIdLogin', $_POST)) {
			//Getting the values from user and insert data into the table
			$tuple = array (
				":bind1" => $_POST['staff_id']
			);
			$alltuples = array (
				$tuple
			);
			$result = executeBoundSQL("select * from hotelStaff h, skiStaff s where h.staff_id =:bind1 or s.staff_id =:bind1", $alltuples);

      if ($_POST && $success && $result) {
        header("location: staffDir.php");
        //TODO: how do we send JSON web token with it so we can get the id's?
      }

		} else
			if (array_key_exists('customerIdLogin', $_POST)) {
				// Update tuple using data from user
				$tuple = array (
					":bind1" => $_POST['c_id']
				);
				$alltuples = array (
					$tuple
				);

        $result = executeBoundSQL("select c_id from customer where c_id =:bind1", $alltuples);

        if ($_POST && $success && $result) {
          header("location: custHome.php");
        }

			} else
				if (array_key_exists('newCustomer', $_POST)) {
					// Inserting data into table using bound variables
					$tuple = array (
						":bind1" => $_POST['newC_id'],
						":bind2" => $_POST['newC_name'],
            ":bind3" => $_POST['newC_email'],
            ":bind4" => $_POST['newC_CCnum']
					);
          $alltuples = array (
  					$tuple
  				);
					$result = executeBoundSQL("insert into customer values (:bind1, :bind2, :bind3, :bind4)", $allrows);
					OCICommit($db_conn);

          if ($_POST && $success && $result) {
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
