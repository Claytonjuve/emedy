<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   


<form action="process-data/add-md-det-process.php" method="POST">
	<div class="container">
<h3>Retreive a doctor username</h3>
  <div class="form-group row">
    <label for="mdSearch" class="col-sm-2 col-form-label">Search Doctor</label>
    <div class="col-sm-9">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="mdSearch" name="mdSearch" placeholder="Enter MD Reg num" style="width: 100%" tabindex="-1" aria-hidden="true" onchange="ShowMdDetails()">
     <option value="" data-select2-id="select2-data-141-mcra"></option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM md_det
          join person_title on person_title.ID = md_det.TITLE_ID
          ORDER BY md_det.REG_NUM ASC";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($md_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$md_det['REG_NUM'].'_'.$md_det['NAME'].'_'.$md_det['SURNAME'].'_'.$md_det['USERNAME'].'_'.$md_det['EMAIL'].'_'.$md_det['ID'].'" data-select2-id="select2-data-141-mcra">'.$md_det['REG_NUM'].' - '.$md_det['SHORTNAME'].' '.$md_det['NAME'].' '.$md_det['SURNAME'].'</option>';
    }
    ?>


  </select>




    </div>

  </div>
</div>
<div class="row"></div>
<div class="container">
<hr/>
<h6>Input the below fields to create a new doctor user</h6>
  <div class="form-group row">
    <label for="mdSurname" class="col-sm-2 col-form-label">Surname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="mdSurname" name="mdSurname" placeholder="Surname" required>
    </div>
  </div>
    <div class="form-group row">
    <label for="mdName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="mdName" name="mdName" placeholder="Name" required>
    </div>
  </div>
    <div class="form-group row">
    <label for="mdUsername" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="mdUsername" name="mdUsername" placeholder="Username" required>
    </div>
  </div>
      <div class="form-group row">
    <label for="mdId" class="col-sm-2 col-form-label">Reg Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="mdId" name="mdId" placeholder="Reg Num" required>
    </div>
  </div>
    <div class="form-group row">
    <label for="mdEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="mdEmail" name="mdEmail" placeholder="Email" required>
    </div>
  </div>

 <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
<div class="col-sm-10">
<select class="custom-select" id="Title" name="Title" placeholder="Title" style="width: 100%" tabindex="-1" aria-hidden="true">
     <option value=""></option>
           <?php
      //get a connection to the databases
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all products
    $query = "SELECT *
          FROM person_title
          ORDER BY SHORTNAME ASC";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($title = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$title['ID'].'"data-select2-id="select2-data-141-mcra">'.$title['SHORTNAME'].'</option>';
    }
    ?>
  </select>
</div>
</div>



  <a href="admin-home.php"><input type="button" class="btn btn-dark" value="Back"></a>
  <input type="submit" class="btn btn-success" value="Submit">
</div>
</form>


  <script type="text/javascript"> 
  //extracts the value from the dropdown and split the doctors details
    function ShowMdDetails(){
    var mdId = document.getElementById('mdSearch').value.split('_')[0].split('_')[0]; //extracts data
    var mdName = document.getElementById('mdSearch').value.split('_')[1].split('_')[0]; 
    var mdSurname = document.getElementById('mdSearch').value.split('_')[2].split('_')[0]; 
    var mdUsername = document.getElementById('mdSearch').value.split('_')[3].split('_')[0]; 
    var mdEmail = document.getElementById('mdSearch').value.split('_')[4].split('_')[0]; 
    var mdTitle = document.getElementById('mdSearch').value.split('_')[5].split('_')[0]; 
        
        //populate  data
        document.getElementById("mdId").value = mdId; 
        document.getElementById("mdName").value = mdName; 
        document.getElementById("mdSurname").value = mdSurname; 
        document.getElementById("mdUsername").value = mdUsername; 
        document.getElementById("mdEmail").value = mdEmail;
        document.getElementById("Title").selectedIndex = mdTitle;
   }



  </script>


<?php include_once('footer.php'); ?>