<!-- Home page: This is where the application starts!
Staff and customers can log in from here and then get redirected to the appropriate internal page.
If their logins are incorrect then they remain on this page and get an error.
-->

<!-- Page title -->
<title>Hotel Ski Resort</title>
<center>
  <h1>Hotel Ski Resort</h1>

  <p>Insert your id below:</p>

  <!-- Staff Login -->
  <div style="background-color:lightGrey;
              width: 25%;
              padding-top: 10px;
              padding-bottom: 10px">
    <h3>Staff Login</h3>
    <form method="POST" action="home.php">
    <!-- if not a existing account, stay in same page and get error message -->

      Id: <input type="number" name="staff_id" size="6">
      <input type="submit" value="Log in" name="staffIdLogin">
    </form>
  </div>

  <div style="height: 10px;"></div>

  <!-- Customer Login -->
  <div style="background-color:lightGrey;
              width: 25%;
              padding-top: 10px;
              padding-bottom: 10px">
    <h3>Customer Login</h3>
    <form method="POST" action="home.php">
      Id: <input type="number" name="c_id" size="6">
      <input type="submit" value="Log in" name="customerIdLogin">
    </form>
  </div>

  <div style="height: 10px;"></div>

  <!-- New Customers: Create new account -->
  <div style="background-color:lightGrey;
              width: 25%;
              padding-top: 10px;
              padding-bottom: 10px">
    <h3>New Customers</h3>
    <p>Don't have an account? Create one below:</p>
    <form method="POST" action="home.php">
      <div style="padding-left: 50px;">
        <p align="left">Id: <br> <input type="number" name="NewC_id" size="6"> </p>
        <p align="left">Name: <br> <input type="text" name="NewC_name" size="20"> </p>
        <p align="left">E-mail: <br> <input type="text" name="NewC_email" size="40"> </p>
        <p align="left">Credit Card Number: <br> <input type="number" name="NewC_CCnum" size="16"> </p>
      </div>
      <input type="submit" value="Create New Account" name="newCustomer">
    </form>
  </div>

</center>


<!--  Setup connection and connect to DB -->
<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a_14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored

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
				":bind1" => $_POST['staffIdLogin']
			);
			$alltuples = array (
				$tuple
			);
			$result = executeBoundSQL("select staff_id from hotelStaff, skiStaff where staff_id = (:bind1)", $alltuples);
      if ($_POST && $success && $result) { // TODO: does this work?
        header("location: staff.php");
        //TODO: how do we send JSON web token with it so we can get the id's?
      }

		} else
			if (array_key_exists('customerIdLogin', $_POST)) {
				// Update tuple using data from user
				$tuple = array (
					":bind1" => $_POST['customerIdLogin']
				);
				$alltuples = array (
					$tuple
				);
				$result = executeBoundSQL("select c_id from customers where c_id = (:bind1)", $alltuples);

        if ($_POST && $success && $result) {
          header("location: customer.php");
          //TODO: how do we send JSON web token with it so we can get the id's?
        }

			} else
				if (array_key_exists('newCustomer', $_POST)) {
					// Inserting data into table using bound variables
					$tuple = array (
						":bind1" => $_POST['NewC_id'],
						":bind2" => $_POST['NewC_name'],
            ":bind3" => $_POST['NewC_email'],
            ":bind4" => $_POST['NewC_CCnum'],
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
