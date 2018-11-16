<!-- Staff home page: This is the staff directory. This is where logged in staff members can select what they want to do next. This page is basically for rediretion purposes.
-->

<!-- Page title -->
<title>Hotel Ski Resort</title>
<center>
  <h1>Staff Homepage</h1>
  <p> Welcome staff id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the staff id. -->

    <!-- TODO:
    - Ensure that the rooms/equipment buttons are disabled depending on staff type
    - Ensure data to profile is redirected to the correct profile, according tot he staff id given in login.
    -->
  <!-- Below are the directory options -->
  <div style="background-color:lightGrey;
              width: 10%;
              padding-top: 20px;
              padding-bottom: 1px">
    <form action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Edit Profile" name="staffProfile">
    </form>
  </div>

  <div style="height: 10px;"></div>

  <div style="background-color:lightGrey;
              width: 10%;
              padding-top: 20px;
              padding-bottom: 1px">
    <form method="POST" action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Rooms" name="staffRooms">
    </form>

    <form method="POST" action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Equipment" name="staffEquip">
    </form>

    <form method="POST" action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Lessons" name="staffLessons">
    </form>

    <form method="POST" action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Customers" name="staffCustomers">
    </form>

    <form method="POST" action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Management" name="staffManage">
    </form>

    <form method="POST" action="staffDir.php"> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Staff" name="Staff">
    </form>
  </div>

</center>

<!--  Setup connection and connect to DB -->
<?php
//Setup
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_u3i0b", "a14691142", "dbhost.ugrad.cs.ubc.ca:1522/ug"); // TODO: make this git ignored

// Connect to Oracle DB
if ($db_conn) {

		if (array_key_exists('staffProfile')) {
      if ($success) {
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
