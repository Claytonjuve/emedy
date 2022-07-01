<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   

<div class="container">
<h3>Edit or Delete a Prescription</h3>
<div class="row">&nbsp;</div>
<form action="edit-revoke-prescription.php" method="POST" id="form">
  <div class="form-group row">
    <label for="orderId" class="col-sm-2 col-form-label">Order ID</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="orderID" name="orderID" placeholder="input order number" required >
    </div>
    <button type="submit" class="btn btn-success" onclick="OrderIdPop ();">Search</button>
  </div>
    
 </form>
</div>

<hr/>
<div class="row">&nbsp;</div>
<form action="process-data/add-prescription-process.php" method="POST" id="form">
	<div class="container">
<h3>Submit new Prescription</h3>
<div class="form-group row">
    <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
      
      $username = $_SESSION['currentUser']; 

    //get md details
  

    //get latest ID from prescripotion_order
      $query = "SELECT * FROM md_det WHERE USERNAME = '$username'";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in input
    while($md_det = mysqli_fetch_assoc($result)) {
      echo '<input type="hidden" class="form-control" id="mdId" name="mdId" value='.$md_det['REG_NUM'].' readonly>';
    }
     

     //get md details
    $query = "SELECT ORDER_ID FROM prescription_order 
              ORDER BY ORDER_ID DESC 
              LIMIT 1";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in input
    while($order_id = mysqli_fetch_assoc($result)) {
      echo '<input type="hidden" class="form-control" id="orderId" name="orderId" value='.$order_id['ORDER_ID'].' readonly>';
    }  
    

    ?>
</div>


<h6>Retreive patient by name/surname/id</h6>
  <div class="form-group row">
    <label for="ptSearch" class="col-sm-2 col-form-label">Search Patient by Name/Surname/ID</label>
    <div class="col-sm-9">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="ptSearch" name="ptSearch" style="width: 100%" tabindex="-1" aria-hidden="true" onchange="ShowPtDetails()" required>
     <option value="" data-select2-id="select2-data-141-mcra"></option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT patient.*, person_title.SHORTNAME, person_title.ID
          FROM patient
          join person_title on person_title.ID = patient.TITLE
        ";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($pt_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$pt_det['PATIENT_ID'].'_'.$pt_det['PT_NAME'].'_'.$pt_det['SURNAME'].'_'.$pt_det['EMAIL'].'_'.$pt_det['CONTACT_NO'].'_'.$pt_det['ID'].'_'.$pt_det['SHORTNAME'].'" data-select2-id="select2-data-141-mcra">'.$pt_det['PATIENT_ID'].' - '.$pt_det['SHORTNAME'].' '.$pt_det['PT_NAME'].' '.$pt_det['SURNAME'].'</option>';
    }
    ?>


  </select>




    </div>
  </div>
</div>
<div class="row"></div>
<div class="container">
<hr/>
<h6>Patient does not exists in the system or Patient's details are incorrect? <span class="text-danger">Click <a href="pt-det-edit.php">here</a> to add a new patient</span></h6>
  <div class="form-group row">
    <label for="ptSurname" class="col-sm-2 col-form-label">Surname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptSurname" name="ptSurname" placeholder="Surname" readonly>
    </div>
  </div>
    <div class="form-group row">
    <label for="ptName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptName" name="ptName" placeholder="Name" readonly>
    </div>
  </div>
      <div class="form-group row">
    <label for="ptId" class="col-sm-2 col-form-label">ID Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptId" name="ptId" placeholder="ID Card" readonly>
    </div>
  </div>
    <div class="form-group row">
    <label for="ptEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="ptEmail" name="ptEmail" placeholder="Email" readonly>
    </div>
  </div>
   <div class="form-group row">
    <label for="ptTel" class="col-sm-2 col-form-label">Contact Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptTel" name="ptTel" placeholder="Contact Number" readonly>
    </div>
  </div>
 <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
<div class="col-sm-10">
<select  id="ptTitle" name="ptTitle" placeholder="ptTitle" style="width: 100%" tabindex="-1" aria-hidden="true" disabled> <!--class="custom-select" -->
     <option value=""></option>
           <?php
      //get a connection to the databases
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all person title
    $query = "SELECT *
          FROM person_title
          ORDER BY SHORTNAME ASC";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($title = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$title['ID'].'data-select2-id="select2-data-141-mcra">'.$title['SHORTNAME'].'</option>';
    }
    ?>
  </select>
</div>
</div>


<h6>Choose the required drug/s</h6>

<!-- ROW 0 -->
  <div class="form-group row">
    <div class="col-sm-6">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="drugSearch" name="drugSearch0" placeholder="Search Drug" style="width: 100%" tabindex="-1" aria-hidden="true" required>
     <option value="" data-select2-id="select2-data-141-mcra">Search Drug</option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM drug";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($drug_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$drug_det['ID'].'" data-select2-id="select2-data-141-mcra">'.$drug_det['ID'].' - '.$drug_det['NAME'].' '.$drug_det['DOSAGE'].'</option>';
    }
    ?>


  </select>

</div>
<div class="col-md-3">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="usage" name="usage0" placeholder="Drug Usage" style="width: 100%" tabindex="-1" aria-hidden="true" required>
<option value="" data-select2-id="select2-data-141-mcra">Usage</option>
      <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM usage_dai";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($usage = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$usage['ID'].'" data-select2-id="select2-data-141-mcra">'.$usage['TIMES'].'</option>';
    }
    ?>
</select>
 </div> 

<div class="col-md-2">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="duration0" name="duration0" placeholder="Days" style="width: 100%" tabindex="-1" aria-hidden="true" required>
<option value="" data-select2-id="select2-data-141-mcra">Days</option>
</select>
</div>
<div class="col-md-1">
 <input type="button" class="btn btn-success" id = "btnAdd" onclick="AddDropDownList()" value = "Add New Prescription" />
</div>




</div>

<!-- ROW 1 -->

 <div class="form-group row" id="row-1" style="display:none;">
    <div class="col-sm-6">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="drugSearch1" name="drugSearch1" placeholder="Search Drug" style="width: 100%" tabindex="-1" aria-hidden="true" >
     <option value="" data-select2-id="select2-data-141-mcra">Search Drug</option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM drug";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($drug_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$drug_det['ID'].'" data-select2-id="select2-data-141-mcra">'.$drug_det['ID'].' - '.$drug_det['NAME'].' '.$drug_det['DOSAGE'].'</option>';
    }
    ?>


  </select>

</div>
<div class="col-md-3">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="usage1" name="usage1" placeholder="Drug Usage" style="width: 100%" tabindex="-1" aria-hidden="true" >
<option value="" data-select2-id="select2-data-141-mcra">Usage</option>
      <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM usage_dai";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($usage = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$usage['ID'].'" data-select2-id="select2-data-141-mcra">'.$usage['TIMES'].'</option>';
    }
    ?>
</select>
 </div> 

<div class="col-md-2">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="duration1" name="duration1" placeholder="Days" style="width: 100%" tabindex="-1" aria-hidden="true" >
<option value="" data-select2-id="select2-data-141-mcra">Days</option>
</select>
</div>
<div class="col-md-1">
 <input type="button" class="btn btn-success" id = "btnAdd" onclick="AddDropDownList()" value = "Add New Prescription" />
</div>
<div id = "dvContainer">
  
</div>




  
</div>
<a href="md-home.php"><input type="button" class="btn btn-dark" id="back" value="Back";></a>
<input type="submit" class="btn btn-success" id="submit" value="Submit";>
</div>


</form>


  <script type="text/javascript"> 
  //extracts patients details
    function ShowPtDetails(){
    var ptId = document.getElementById('ptSearch').value.split('_')[0].split('_')[0]; //extracts data
    var ptName = document.getElementById('ptSearch').value.split('_')[1].split('_')[0]; 
    var ptSurname = document.getElementById('ptSearch').value.split('_')[2].split('_')[0]; 
    var ptEmail = document.getElementById('ptSearch').value.split('_')[3].split('_')[0]; 
    var ptTel = document.getElementById('ptSearch').value.split('_')[4].split('_')[0]; 
    var ptTitleValue = document.getElementById('ptSearch').value.split('_')[5].split('_')[0]; 
    
        document.getElementById("ptId").value = ptId; //populate  data
        document.getElementById("ptName").value = ptName; 
        document.getElementById("ptSurname").value = ptSurname; 
        document.getElementById("ptTel").value = ptTel; 
        document.getElementById("ptEmail").value = ptEmail;
        document.getElementById("ptTitle").selectedIndex = ptTitleValue;
        
   }


    //populate days in duration dropdown row 0
    var duration = document.getElementById("duration0");
    var contents;

    for (let i = 1; i <= 100; i++) {
    contents += "<option value="+i+">" + i + "</option>";
    }

    duration.innerHTML = "<option>Days</option>" + contents;

       //populate days in duration dropdown row 1
    var duration = document.getElementById("duration1");
    var contents;

    for (let i = 1; i <= 100; i++) {
    contents += "<option value="+i+">" + i + "</option>";
    }

    duration.innerHTML = "<option>Days</option>" + contents;


    function AddDropDownList(){
      document.getElementById("row-1").style = "block";
    }


    </script>




 


<?php include_once('footer.php'); ?>