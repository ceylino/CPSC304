<!-- Customer page: This is the main customer page. This is where logged in customers and members can view their current reservations etc. and be redirected to create new ones, edit or delete existing ones.
-->

<!-- Page title -->
<title>Hotel Ski Resort</title>
<p> Welcome staff id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the staff id. -->

<div style="display: flex;
            width: 100%;
            justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Hotel Staff: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
      //TODO : this part needs tobe changed
        $result = executePlainSQL("select * roomReservation where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Ski Staff: </h3>
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
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>

    <div style="height: 10px;"></div>

    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <!-- Options -->
      <center>
        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Add hotel staff" name="newHotelStaff">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Delete hotel staff" name="deleteHotelStaff">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Update hotel staff" name="updateHotelStaff">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Add ski staff" name="newSkiStaff">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Delete ski staff" name="deleteSkiStaff">
        </form>

        <form action=""> <!-- TODO: Add rerouting to necessary forms -->
          <input type="submit" value="Update ski staff" name="updateSkiStaff">
        </form>

      </center>
    </div>
    <div style="height: 10px;"></div>

</div>
