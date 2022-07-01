<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   


<form action="process-data/add-admin-det-process.php" method="POST">
	<div class="container">
<h6>Retreive a admin username</h6>
  <div class="form-group row">
    <label for="adminSearch" class="col-sm-2 col-form-label">Search Admin</label>
    <div class="col-sm-9">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="adminSearch" name="adminSearch" placeholder="Search by Name/Surname/Username" style="width: 100%" tabindex="-1" aria-hidden="true" onchange="ShowadminDetails()">
     <option value="" data-select2-id="select2-data-141-mcra"></option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM admin_det";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($admin_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$admin_det['ID'].'_'.$admin_det['NAME'].'_'.$admin_det['SURNAME'].'_'.$admin_det['USERNAME'].'_'.$admin_det['EMAIL'].'" data-select2-id="select2-data-141-mcra">'.$admin_det['NAME'].' '.$admin_det['SURNAME'].' - '.$admin_det['USERNAME'].'</option>';
    }
    ?>


  </select>

    </div>

  </div>
</div>
<div class="row"></div>
<div class="container">
<hr/>
<h6>Input the below fields to create a new adminacist user</h6>
  <div class="form-group row">
    <label for="adminId" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="adminId" name="adminId" placeholder="ID">
    </div>
  </div>

  <div class="form-group row">
    <label for="adminSurname" class="col-sm-2 col-form-label">Surname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="adminSurname" name="adminSurname" placeholder="Surname">
    </div>
  </div>
    <div class="form-group row">
    <label for="adminName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Name">
    </div>
  </div>
    <div class="form-group row">
    <label for="adminUsername" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="adminUsername" name="adminUsername" placeholder="Username">
    </div>
  </div>
    <div class="form-group row">
    <label for="adminEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Email">
    </div>
  </div>


  <input type="submit" class="btn btn-success" value="Submit">
</div>
</form>


  <script type="text/javascript"> //extracts patients details
    function ShowadminDetails(){
    var adminId = document.getElementById('adminSearch').value.split('_')[0].split('_')[0]; //extracts data
    var adminName = document.getElementById('adminSearch').value.split('_')[1].split('_')[0]; 
    var adminSurname = document.getElementById('adminSearch').value.split('_')[2].split('_')[0]; 
    var adminUsername = document.getElementById('adminSearch').value.split('_')[3].split('_')[0]; 
    var adminEmail = document.getElementById('adminSearch').value.split('_')[4].split('_')[0]; 
        
        document.getElementById("adminId").value = adminId; //populate  data
        document.getElementById("adminName").value = adminName; 
        document.getElementById("adminSurname").value = adminSurname; 
        document.getElementById("adminUsername").value = adminUsername; 
        document.getElementById("adminEmail").value = adminEmail;
   }



  </script>


<?php include_once('footer.php'); ?>