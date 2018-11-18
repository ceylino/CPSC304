<!-- Customer page: This is the main customer page. This is where logged in customers and members can view their current reservations etc. and be redirected to create new ones, edit or delete existing ones.
-->

<!-- Page title -->

<title>Hotel Ski Resort</title>
<p> Welcome staff id: </p> <!-- TODO: echo the staff id. -->

<div style="display: flex;
            width: 100%;
            justify-content: space-between;">

  <!-- View table entries -->
  <div style="justify-content: flex-start;">
    <h3> Equipment Reservations: </h3> <!-- TODO: this table printing set up needs to be completed and added for the other tables as well -->
<!--       <?php
      //TODO : this part needs tobe changed
        // $result = executePlainSQL("select * roomReservation where c_id=3"); //TODO: set up the cid & use views
        // echo "<table>";
        // echo "<tr><th>COLUMN1</th><th>COLUMN2</th></tr>";
        // while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        //   echo "<tr><td>" . $row["COL1"] . "</td><td>" . $row["COL2"] . "</td></tr>";
        // }
        // echo "</table>";
      ?> -->

    <h3> Available Equipments: </h3>
  </div>

  <!-- Directory -->
  <div style="justify-content: flex-end;">
    <!-- Edit Profile-->
    <div style="background-color:lightGrey;
                  width: 200px;
                  padding-top: 20px;
                  padding-bottom: 1px">
      <center>
        <form method="POST" action="staffDir.php"> 
          <input type="submit" value="Back to Main Page" name="staffDir">
        </form>
      </center>
    </div>
  </div>
</div>

<div style="height: 10px;"></div>

<!---------------- Forms to add & update data ---------------->
<!-- IMPORTANT: before adding any SQL check to see what needs to be done by looking at the createTables file and checking for functional dependencies! Or else THINGS WILL BREAK!!-->
<center>
  <div style="display: flex;
              width: 100%;
              justify-content: space-around;">
    <div> <!-- Rental Equipment -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new or update rental equipment: </center>
        <form method="POST" action="staffEquipView.php">
          <!-- TODO: Add any SQL processing: check if this room number exists. If so: update, if not insert-->
            <p align="left">Equipment id: <br> <input type="number" name="editEqId" size="6"> </p>
            <p align="left">Equipment Type: <br> <input type="text" name="editEqType" size="20"> </p>
            <p align="left">Rental Rate: <br> <input type="number" name="editEqRate" size="6"> </p>
            <!-- Note: remember to update the roomRate table if needed -BEFORE- making any changes to the room table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add/Update" name="editEquip">
          </center>
        </form>
      </div>

      <div style="height: 10px;"></div>

      <!-- Delete an equipment -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffEquipView.php"> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete an equipment: <br>
              Are you sure you want to delete this equipment? This action cannot be undone. Deletion will cause cascading through other functionalities.<br>
            </center>
            <p align="left"> Equipment id: <br> <input type="number" name="delID"></p>
            <center><input type="submit" value="Delete Equipment" name="deleteEq"></center>
            <!-- check if equipment exists, if so, delete. refresh page.-->

          </form>
        </div>
      </div>
    </div>

        <div> <!-- Equip Reservations -->
      <div style="width: 300px; padding: 20px 20px 10px 20px; background-color: lightGrey; ">
        <center>Add new equipment reservation: </center>
        <form method="POST" action="staffEquipView.php">
            <p align="left">Equipment Id: <br> <input type="number" name="equipID" size="6"> </p>
            <p align="left">Customer Id: <br> <input type="number" name="custID" size="6"> </p>
            
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="equipStartDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="equipEndDate" size="8"> </p>
            <!-- Note: remember to update the roomResDate table if needed -BEFORE- making any changes to the roomReservation table or it will not work!! Once this is done, refresh the page (redirect to itself)-->
          <center>
            <input type="submit" value="Add Equipment Reservation" name="addEquipReservation">
          </center>
        </form>
      </div>


      <div style="height: 10px;"></div>

      <!-- Delete a reservation -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffEquipView.php"> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Delete an Equipment Reservation: <br>
             <br> Are you sure you want to delete this equipment reservation? This action can't be undone.
              Deletion will cause cascading through other functionalities.<br><br>
            </center>
            <p align="left">Equipment ID: <br> <input type="number" name="delEquipID" size="6"> </p>
            <p align="left">Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="delEquipSDate" size="8"> </p>
            <p align="left">End Date: (numbers only - yyyymmdd) <br> <input type="text" name="delEquipEDate" size="8"> </p>
            <center><input type="submit" value="Delete Equipment Reservation" name="deleteEquipReservation"></center>
            <!-- check if reservation exists, if so, delete. refresh page.-->
          </form>
        </div>
      </div>
    </div>

      <div style="height: 10px;"></div>

      <!-- Delete a reservation -->
      <!-- TODO: make sure that the necessary information is cascading properly from reservations etc. -->
      <div>
        <div style="width: 300px;  padding: 30px 20px 10px 20px; background-color: lightGrey; ">
          <form method="POST" action="staffEquipView.php"> <!-- TODO: Add any SQL processing necessary & add form tag details-->
            <center>Update Equipment Reservation: <br>
            </center>
            <p align="left">Equipment ID: <br> <input type="number" name="prevEquipID" size="6"> </p>
            <p align="left">Previous Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="prevSDate" size="8"> </p>
            <p align="left">Previous End Date: (numbers only - yyyymmdd) <br> <input type="text" name="prevEDate" size="8"> </p><br><br>


            <p align="left">New Equipment ID: <br> <input type="number" name="upEquipID" size="6"> </p>
            <p align="left">New Start Date: (numbers only - yyyymmdd) <br> <input type="text" name="upEquipSDate" size="8"> </p>
            <p align="left">New End Date: (numbers only - yyyymmdd) <br> <input type="text" name="upEquipEDate" size="8"> </p>
            <center><input type="submit" value="Update Equipment Reservation" name="updateEquipReservation"></center>
            <!-- check if reservation exists, if so, delete. refresh page.-->
          </form>
        </div>
      </div>
    </div>
  </div>
</center>

<!--  Setup connection and connect to DB -->
<?php
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_c5b1b", "a34248161", "dbhost.ugrad.cs.ubc.ca:1522/ug"); 

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
  return $statement;

}
function printResult($result) { //prints results from a select statement
  echo "result from SQL:";
  echo "<table>";
  while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
  echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
  }
  echo "</table>\n";
}

if ($db_conn) {
  //edit or add equipement
  if (array_key_exists('editEquip', $_POST)) { 
    $tuple = array ( 
      ":bind1" => $_POST['editEqId'],
      ":bind2" => $_POST['editEqType'],
      ":bind3" => $_POST['editEqRate'] 
      );
    $alltuples = array ($tuple);
    $result = executeBoundSQL("select * from rentalEquip where equip_id=:bind1", $alltuples);
    
    //check if id exists in rental equipment
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){ 
        //update 
      executeBoundSQL("update rentalEquip set equip_type=:bind2, rental_rate=:bind3 where equip_id=:bind1", $alltuples);

    } else {
        //insert new equipment 
        //check if equipement exists 
        $result2 = executeBoundSQL("select * from rentalEquip where equip_id=:bind1", $alltuples);
        if($row = OCI_Fetch_Array($result2, OCI_BOTH) ){
           //do nothing
        } else {
          //insert into rental equip rate 
          executeBoundSQL("insert into rentalEquipRate values (:bind2, :bind3)", $alltuples); 
        }
        //insert equip into rental equip 
        executeBoundSQL("insert into rentalEquip values (:bind1, :bind2, :bind3)", $alltuples);     
    }

    OCICommit($db_conn);
    if ($_POST && $success){
      header("location: staffStaffView.php");
    }
  } 
  //delete equipment 
  else if (array_key_exists('deleteEq', $_POST)){
    $tuple = array ( 
      ":bind1" => $_POST['delID'] 
      );
    $alltuples = array ($tuple);
    $result = executeBoundSQL("select * from rentalEquip where equip_id=:bind1", $alltuples);
    
    //check if id exists in rental equipment
    if($row = OCI_Fetch_Array($result, OCI_BOTH)){ 
        //delete it 
      executeBoundSQL("delete from rentalEquip where equip_id=:bind1", $alltuples);
    } 

    OCICommit($db_conn);
    if ($_POST && $success){
      header("location: staffEquipView.php");
    }   
  } 
  //edit equip reservation 
  else if(array_key_exists('addEquipReservation', $_POST)){
    $tuple = array (
      ":bind1" => $_POST['equipID'],
      ":bind2" => $_POST['custID'],
      ":bind3" => $_POST['equipStartDate'],
      ":bind4" => $_POST['equipEndDate']
    );

    $alltuples = array (
      $tuple
    );

    $result = executeBoundSQL("insert into equipReservation values (:bind1, :bind2, :bind3, :bind4)", $alltuples);

    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: staffEquipView.php");
    }
  }
  //or update reservatiom
  else if(array_key_exists('deleteEquipReservation', $_POST)) {
    $tuple = array (
      ":bind1" => $_POST['delEquipID'],
      ":bind2" => $_POST['delEquipSDate'],
      ":bind3" => $_POST['delEquipEDate']
    );

    $alltuples = array (
      $tuple
    );

    $result = executeBoundSQL("select * from equipReservation where equip_id=:bind1 and start_date=:bind2 and end_date=:bind3", $alltuples);

    //if equipment reservation exists
    if($row = OCI_Fetch_Array($result, OCI_BOTH)) {
      //delete 
      executeBoundSQL("delete from equipReservation where equip_id=:bind1 and start_date=:bind2 and end_date=:bind3", $alltuples);

    }

    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: staffEquipView.php");
    }

  } else if(array_key_exists('updateEquipReservation', $_POST)) {
   $tuple = array (
      ":bind1" => $_POST['prevEquipID'],
      ":bind2" => $_POST['prevSDate'],
      ":bind3" => $_POST['prevEDate'],
      ":bind4" => $_POST['upEquipID'],
      ":bind5" => $_POST['upEquipSDate'],
      ":bind6" => $_POST['upEquipEDate'],
    );

    $alltuples = array (
      $tuple
    );

    $result = executeBoundSQL("select * from equipReservation where equip_id=:bind1 and start_date=:bind2 and end_date=:bind3", $alltuples);

    if($row = OCI_Fetch_Array($result, OCI_BOTH)) {
      executeBoundSQL("update equipReservation set equip_id=:bind4, start_date=:bind5, end_date=:bind6 where equip_id=:bind1 and start_date=:bind2 and end_date=:bind3 ", $alltuples);
    }

    OCICommit($db_conn);

    if ($_POST && $success) {
      header("location: staffEquipView.php");
    }

  }

  OCILogoff($db_conn);

  } else {echo "cannot connect";
  $e = OCI_Error(); // For OCILogon errors pass no handle
  echo htmlentities($e['message']);
}
?>




