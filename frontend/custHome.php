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
    <h3> Rooms Reservations: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
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

    <h3> Booked Lessons: </h3>

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

    <div style="height: 10px;"></div>

    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <!-- Room options -->
      <center>
        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Reserve new room" name="newRoom">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Edit room reservation" name="updateRoom">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Cancel room reservation" name="deleteRoom">
        </form>
      </center>
    </div>
    <div style="height: 10px;"></div>

    <!-- Equip options -->
    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <center>
        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Reserve new equipment" name="newEquip">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Edit equipment reservtaion" name="updateEquip">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Cancel equipment reservation" name="deleteEquip">
        </form>
      </center>
    </div>

    <div style="height: 10px;"></div>

    <!-- Lesson options -->
    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <center>
        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Book new lessons" name="newLessons">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Cancel lesson booking" name="deleteLessons">
        </form>
      </center>
    </div>

    <div style="height: 10px;"></div>

    <!-- Pass options -->
    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <center>
        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Purchase new passs" name="newPass">
        </form>
      </center>
    </div>

  </div>
</div>

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

}

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
			$result = executeBoundSQL("select staff_id from hotelStaff, skiStaff where staff_id =:bind1", $alltuples);
      if ($_POST && $success && $result) { // TODO: does this work?
        header("location: staff.php");
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
				$result = executeBoundSQL("select c_id from customer where c_id =:bind1");

        if ($_POST && $success && $result) {
          header("location: custHome.php");
          //TODO: how do we send JSON web token with it so we can get the id's?
        }

			} else
				if (array_key_exists('newCustomer', $_POST)) {
					// Inserting data into table using bound variables
					$tuple = array (
						":bind1" => $_POST['NewC_id'],
						":bind2" => $_POST['NewC_name'],
            ":bind3" => $_POST['NewC_email'],
            ":bind4" => $_POST['NewC_CCnum']
					);
          $alltuples = array (
  					$tuple
  				);
					$result = executeBoundSQL("insert into customers values (:bind1, :bind2, :bind3, :bind4)", $allrows);
					OCICommit($db_conn);

          if ($_POST && $success && $result) {
        		header("location: customer.php");
            //TODO: how do we send JSON web token with it so we can get the id's?
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
