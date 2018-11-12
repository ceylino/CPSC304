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
