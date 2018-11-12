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
    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Edit Profile" name="staffProfile">
    </form>
  </div>

  <div style="height: 10px;"></div>

  <div style="background-color:lightGrey;
              width: 10%;
              padding-top: 20px;
              padding-bottom: 1px">
    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Rooms" name="staffRooms">
    </form>

    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Equipment" name="staffEquip">
    </form>

    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Lessons" name="staffLessons">
    </form>

    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Customers" name="staffCustomers">
    </form>

    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Management" name="staffManage">
    </form>

    <form action=""> <!-- TODO: Add rerouting to other staff pages -->
      <input type="submit" value="Staff" name="Staff">
    </form>
  </div>

</center>
