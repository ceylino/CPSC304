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
    <h3> Room Reservations: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
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

    <h3> Rooms: </h3>
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
          <input type="submit" value="View room status" name="roomStatus">
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
    <div> <!-- Rooms -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing room: </center>
        <form method="POST" action="staffRoomView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"> </p>
            <p align="left">Room Type: <br> <input type="text" name="editType" size="20"> </p>
            <p align="left">Room Rate: <br> <input type="number" name="editRate" size="6"> </p>
            <!-- Note: remember to update the roomRate table if needed -BEFORE- making any changes to the room table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editRoom">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a room -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete a Room: <br>
              Are you sure you want to delete this room? This action cannot be undone. Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Room number: <br> <input type="number" name="deleteRoomNum"></p>
            <center><input type="submit" value="Delete room" name="deleteRoom"></center>
            <!-- check if room exists, if so, delete. refresh page.-->

          </form>
        </div>
      </div>
    </div>

    <div> <!-- Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing reservation: </center>
        <form method="POST" action="staffRoomView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Confirmation number: <br> <input type="number" name="editConfNum" size="6"> </p>
            <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"> </p>
            <p align="left">Customer Id: <br> <input type="number" name="editCid" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="editSDate" size="8"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="editEDate" size="8"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a room -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete a Reservation: <br>
              Are you sure you want to delete this reservation? This action can't be undone.
              Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Confirmation Number: <br> <input type="number" name="deleteConfNum"></p>
            <center><input type="submit" value="Delete reservation" name="deleteReservation"></center>
            <!-- check if reservation exists, if so, delete. refresh page.-->
          </form>
        </div>
      </div>
    </div>
  </div>
</center>
