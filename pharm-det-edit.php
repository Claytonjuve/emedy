<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   


<form action="process-data/add-pharm-det-process.php" method="POST">
	<div class="container">
<h6>Retreive a pharmacists username</h6>
  <div class="form-group row">
    <label for="mdSearch" class="col-sm-2 col-form-label">Search Pharmacist</label>
    <div class="col-sm-9">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="mdSearch" name="mdSearch" placeholder="Search by Name/Surname/Username" style="width: 100%" tabindex="-1" aria-hidden="true" onchange="ShowMdDetails()">
     <option value="" data-select2-id="select2-data-141-mcra"></option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM pharmacist_det";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($pharm_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$pharm_det['ID'].'_'.$pharm_det['NAME'].'_'.$pharm_det['SURNAME'].'_'.$pharm_det['USERNAME'].'_'.$pharm_det['EMAIL'].'" data-select2-id="select2-data-141-mcra">'.$pharm_det['NAME'].' '.$pharm_det['SURNAME'].' - '.$pharm_det['USERNAME'].'</option>';
    }
    ?>


  </select>

    </div>

  </div>
</div>
<div class="row"></div>
<div class="container">
<hr/>
<h6>Input the below fields to create a new pharmacist user</h6>
  <div class="form-group row">
    <label for="pharmId" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pharmID" name="pharmID" placeholder="Surname">
    </div>
  </div>

  <div class="form-group row">
    <label for="pharmSurname" class="col-sm-2 col-form-label">Surname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pharmSurname" name="pharmSurname" placeholder="Surname">
    </div>
  </div>
    <div class="form-group row">
    <label for="pharmName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pharmName" name="pharmName" placeholder="Name">
    </div>
  </div>
    <div class="form-group row">
    <label for="pharmUsername" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pharmUsername" name="pharmUsername" placeholder="Username">
    </div>
  </div>
    <div class="form-group row">
    <label for="pharmEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="pharmEmail" name="pharmEmail" placeholder="Email">
    </div>
  </div>


  <input type="submit" class="btn btn-success" value="Submit">
</div>
</form>


  <script type="text/javascript"> //extracts patients details
    function ShowMdDetails(){
    var pharmId = document.getElementById('mdSearch').value.split('_')[0].split('_')[0]; //extracts data
    var pharmName = document.getElementById('mdSearch').value.split('_')[1].split('_')[0]; 
    var pharmSurname = document.getElementById('mdSearch').value.split('_')[2].split('_')[0]; 
    var pharmUsername = document.getElementById('mdSearch').value.split('_')[3].split('_')[0]; 
    var pharmEmail = document.getElementById('mdSearch').value.split('_')[4].split('_')[0]; 
        
        document.getElementById("pharmId").value = pharmId; //populate  data
        document.getElementById("pharmName").value = pharmName; 
        document.getElementById("pharmSurname").value = pharmSurname; 
        document.getElementById("pharmUsername").value = pharmUsername; 
        document.getElementById("pharmEmail").value = pharmEmail;
   }



  </script>


<?php include_once('footer.php'); ?>