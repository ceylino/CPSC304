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
    <h3> Booked Lessons: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
      <?php
      //TODO : this part needs to be changed
        $result = executePlainSQL("select * roomReservation where c_id=3"); //TODO: set up the cid & use views
        echo "<table>";
        echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
          echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        }
        echo "</table>";
      ?>

    <h3> Available Lessons: </h3> <!-- TODO: Join lesson and staff. Display staff name and all lesson details-->

    <h3> Lessons Classlist: </h3> <!-- TODO: Join lesson, staff and customer tables and group by lesson type. Display customer name, staff name and all lesson details-->
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
  </div>
</div>

<div style="height: 30px;"></div>

<!---------------- Forms to add & update data ---------------->
<!-- IMPORTANT: before adding any SQL check to see what needs to be done by looking at the createTables file and checking for functional dependencies! Or else THINGS WILL BREAK!!-->
<center>
  <div style="display: flex; width: 100%; justify-content: space-around;">
    <div> <!-- Lesson -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update existing lesson: </center>
        <form method="POST" action="staffLessonView.html">
          <!-- TODO: Add any SQL processing: check if this lesson exists. If so: update, if not insert-->
          <p align="left">Customer Id: <br> <input type="number" name="editLessonCid" size="6"> </p>
          <p align="left">Lesson Type: <br> <input type="text" name="editType" size="20"> </p>
          <p align="left">Staff Id: <br> <input type="number" name="editLessonCid" size="6"> </p>
          <center>
            <input type="submit" value="Add/Update" name="editEquipReservation">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete a lesson -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form> <!-- TODO: Add any SQL processing necessary-->
            <center>Delete a lesson: <br>
              Are you sure you want to delete this lesson? This action cannot be undone.<br>
            </center>
            <p align="left">Customer Id: <br> <input type="number" name="deleteLessonCid" size="6"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="deleteLessonType" size="20"> </p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteLessonSid" size="6"> </p>

            <center><input type="submit" value="Delete Lesson" name="deleteLesson"></center>
            <!-- check if booking exists, if so, delete. refresh page.-->

          </form>
        </div>
      </div>

    </div>

    <div> <!-- Lesson booking -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Book a new lesson: </center>
        <form method="POST" action="staffLessonView.html">
          <!-- TODO: Add any SQL processing: check if this lesson exists. If so: update, if not insert-->
            <p align="left">Customer Id: <br> <input type="number" name="editBookedCid" size="6"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="editBookedType" size="20"> </p>
            <p align="left">Staff Id: <br> <input type="number" name="editBookedSid" size="6"> </p>
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
            <p align="left">Customer Id: <br> <input type="number" name="deleteBookedCid" size="6"> </p>
            <p align="left">Lesson Type: <br> <input type="text" name="deleteBookedType" size="20"> </p>
            <p align="left">Staff Id: <br> <input type="number" name="deleteBookedSid" size="6"> </p>

            <center><input type="submit" value="Delete Booking" name="deleteBooking"></center>
            <!-- check if booking exists, if so, delete. refresh page.-->

          </form>
        </div>
      </div>
    </div>

  </div>
</center>
