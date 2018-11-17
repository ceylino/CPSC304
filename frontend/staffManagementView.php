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
    <h3> equipment Management: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
      //TODO : this part needs tobe changed
        $result = executePlainSQL("select * equipmentReservation where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Equipment Management: </h3>
  </div>

  <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey; width: 200px; padding-top: 20px; padding-bottom: 1px">
      <center>
        <form action=""> <!-- TODO: Add rerouting to other staff pages -->
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>
  </div>
</div>

<div style="height: 30px;"></div>

<!---------------- Forms to add & update data ---------------->
<!-- IMPORTANT: before adding any SQL check to see what needs to be done by looking at the createTables file and checking for functional dependencies! Or else THINGS WILL BREAK!!-->
<center>
  <div style="display: flex; width: 100%; justify-content: space-around;">

    <div> <!-- Room Management -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing room management: </center>
        <form method="POST" action="staffManagementView.html">
          <!-- TODO: Add any SQL processing: check if this equipment & staff exists. If so: update, if not insert-->
          <p align="left">Room number: <br> <input type="number" name="editRoomNum" size="6"></p>
          <p align="left">Staff Id: <br> <input type="number" name="editSid" size="6"> </p>
          <center><input type="submit" value="Add/Update" name="editRoomManage"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a Room management -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete room management: <br> Are you sure you want to delete this entry? This action cannot be undone.<br></center>
            <p align="left">Room number: <br> <input type="number" name="deleteRoomNum" size="6"></p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteSid" size="6"> </p>
            <center><input type="submit" value="Delete Management" name="deleteManage"></center>
            <!-- check if exists, if so, delete. refresh page.-->
          </form>
        </div>
      </div>
    </div>

    <div> <!-- Equip Management -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing equipment management: </center>
        <form method="POST" action="staffManagementView.html">
          <!-- TODO: Add any SQL processing: check if this equipment & staff exists. If so: update, if not insert-->
          <p align="left">Equipment ID: <br> <input type="number" name="editEquipId" size="6"></p>
          <p align="left">Staff Id: <br> <input type="number" name="editSid" size="6"> </p>
          <center><input type="submit" value="Add/Update" name="editEquipManage"></center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a equipment management -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete equipment management: <br> Are you sure you want to delete this entry? This action cannot be undone.<br></center>
            <p align="left">Equipment ID: <br> <input type="number" name="deleteEquipID" size="6"></p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteSid" size="6"> </p>
            <center><input type="submit" value="Delete Management" name="deleteManage"></center>
            <!-- check if exists, if so, delete. refresh page.-->
          </form>
        </div>
      </div>
    </div>


  </div>
</center>
