<!-- Customer profile: This is the page where customer may view their profiles and edit their data -->

<!-- Page title -->
<title>Hotel Ski Resort</title>

<center>
  <!-- Personal  Info-->
  <p> Welcome customer id:<?php echo $_POST[""];?> </p> <!-- TODO: echo the customer id. -->
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

  <!-- Membership Info-->
  <div style="background-color:lightGrey; width: 50%; padding-top: 10px; padding-bottom: 10px">
    <h4> Membership Information </h4>
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
</center>

  <div style="height: 30px;"></div>

<!---------------- Forms to add & update data ---------------->
<center>
<!-- Update personal info -->
  <div>
    <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
      <center>Update Personal Information: </center>
      <form> <!-- TODO: Add any SQL processing necessary-->
          <p align="left">Id: <br> <input type="number" name="editCID" size="6"> </p>
          <p align="left">Name: <br> <input type="text" name="editName" size="20"> </p>
          <p align="left">E-mail: <br> <input type="text" name="editEmail" size="40"> </p>
          <p align="left">Credit Card Number: <br> <input type="number" name="editCCnum" size="16"> </p>

        <center>
          <input type="submit" value="Update" name="updateCust">
        </center>
      </form>
    </div>
  </div>

  <div style="height: 10px;"></div>

  <!-- Become a member -->
  <!-- TODO: make sure this only is clickable if the membership doens't already exist -->
  <div>
    <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
      <form> <!-- TODO: Add any SQL processing necessary-->
        <center>
          <input type="submit" value="Become a member" name="newMember">
        </center>
      </form>
    </div>
  </div>
</center>
