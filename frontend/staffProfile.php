<!-- Staff profile: This is the page where staff may view their profiles and edit their data -->

<!-- Page title -->
<title>Hotel Ski Resort</title>

<center>
  <!-- Personal  Info-->
  <p> Welcome staff id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the staff id. -->
  <div style="background-color:lightGrey; width: 50%; padding-top: 10px; padding-bottom: 10px">
    <h4> Personal Information </h4>
    <!-- TODO: this table printing set up needs to be completed -->
      <?php
        $result = executePlainSQL("select * customers where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>Id:</th><th>Name:</th><th>E-mail:</th><th>Credit Card Number:</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>";
        }
        echo "</table>";
      ?>
  </div>

  <div style="height: 10px;"></div>
</center>

  <div style="height: 30px;"></div>

<!---------------- Form: ---------------->
<center>
<!-- Update personal info -->
  <div>
    <div style="width: 200px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
      <center>Update Personal Information:
        <form method="POST" action="staffProfile.php"> <!-- TODO: Add any SQL processing necessary-->
          <p align="left">Id: <br> <input type="number" name="editCID" size="6"> </p>
          <p align="left">Name: <br> <input type="text" name="editName" size="20"> </p>
          <p align="left">Phone Number: <br> <input type="number" name="editPhone" size="10"> </p>
          <input type="submit" value="Update" name="updateCust">
        </form>
      </center>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored

// Connect to Oracle DB
if ($db_conn) {

		if (array_key_exists('staffProfile', $_POST)) {
      if ($_POST && $success) {
        header("location: staffProfile.php");
      }

		} else if (array_key_exists('staffRooms', $_POST)) {
        if ($_POST && $success) {
          header("location: staffRoomView.php");
        }

		} else if (array_key_exists('staffEquip', $_POST)) {
        if ($_POST && $success) {
      		header("location: staffEquipView.php");
        }

    } else if (array_key_exists('staffLessons', $_POST)) {
        if ($_POST && $success) {
      		header("location: staffLessonView.php");
        }

    } else if (array_key_exists('staffCustomers', $_POST)) {
        if ($_POST && $success) {
      		header("location: staffCustomerView.php");
        }

    } else if (array_key_exists('staffManage', $_POST)) {
        if ($_POST && $success) {
      		header("location: staffManageView.php");
        }
      }

	OCILogoff($db_conn);
} else {
	echo "cannot connect";
	$e = OCI_Error(); // For OCILogon errors pass no handle
	echo htmlentities($e['message']);
}

?>
