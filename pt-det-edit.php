<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   


<form action="process-data/add-pt-det-process.php" method="POST">
	<div class="container">
<h6>Retreive a patient username</h6>
  <div class="form-group row">
    <label for="ptSearch" class="col-sm-2 col-form-label">Search Patient</label>
    <div class="col-sm-9">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="ptSearch" name="ptSearch" placeholder="Enter MD Reg num" style="width: 100%" tabindex="-1" aria-hidden="true" onchange="ShowPtDetails()">
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
      echo '<option value="'.$pt_det['PATIENT_ID'].'_'.$pt_det['NAME'].'_'.$pt_det['SURNAME'].'_'.$pt_det['EMAIL'].'_'.$pt_det['CONTACT_NO'].'_'.$pt_det['ID'].'_'.$pt_det['SHORTNAME'].'" data-select2-id="select2-data-141-mcra">'.$pt_det['PATIENT_ID'].' - '.$pt_det['SHORTNAME'].' '.$pt_det['NAME'].' '.$pt_det['SURNAME'].'</option>';
    }
    ?>


  </select>




    </div>
    <button type="submit" class="btn btn-success">Search</button>
  </div>
</div>
<div class="row"></div>
<div class="container">
<hr/>
<h6>Input the below fields to create a new patient</h6>
  <div class="form-group row">
    <label for="ptSurname" class="col-sm-2 col-form-label">Surname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptSurname" name="ptSurname" placeholder="Surname">
    </div>
  </div>
    <div class="form-group row">
    <label for="ptName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptName" name="ptName" placeholder="Name">
    </div>
  </div>
      <div class="form-group row">
    <label for="ptId" class="col-sm-2 col-form-label">ID Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptId" name="ptId" placeholder="ID Card">
    </div>
  </div>
    <div class="form-group row">
    <label for="ptEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="ptEmail" name="ptEmail" placeholder="Email">
    </div>
  </div>
   <div class="form-group row">
    <label for="ptTel" class="col-sm-2 col-form-label">Contact Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptTel" name="ptTel" placeholder="Contact Number">
    </div>
  </div>
 <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
<div class="col-sm-10">
<select class="custom-select"  id="ptTitle" name="ptTitle" placeholder="ptTitle" style="width: 100%" tabindex="-1" aria-hidden="true"> <!--class="custom-select" -->
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




  <input type="submit" class="btn btn-success" value="Submit">
</div>
</form>


  <script type="text/javascript"> //extracts patients details
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



  </script>


<?php include_once('footer.php'); ?>