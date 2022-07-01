<?php include_once('header.php'); ?>

 </p>

<form action="process-data/update-pharm-allocation.php" method="POST">
 <div class="container">
 	<div class="form-group row">
 		<?php
 		
  		require_once('process-data/connect_db.php');

	    $connection = OpenCon();

    //get pharmacist details
 		$Username = $_SESSION['currentUser'];
      $query = "SELECT * FROM pharmacist_det WHERE USERNAME = '$Username'";
    	$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in input
    while($pharm_det = mysqli_fetch_assoc($result)) {
      echo '<input type="hidden" class="form-control" id="pharmId" name="pharmId" value='.$pharm_det['ID'].' readonly>';
    }
     
        echo     '<label for="pharmacySearch" class="col-sm-6 col-form-label">Current Pharmacy Allocation: <strong>'.$_SESSION['pharmAllocated'].'</strong></label>';
 
 ?>
<div class="col-sm-4">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="pharmacySearch" name="pharmacySearch" placeholder="Search Pharmacy" style="width: 100%" tabindex="-1" aria-hidden="true">
 <?php       
         //get a connection to the database
    	require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    	//get all data
    	$query = "SELECT * FROM pharmacy";
    	$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($pharm = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$pharm['ID'].'" data-select2-id="select2-data-141-mcra">'.$pharm['PHARM_NAME'].'</option>';
    }


?>  
</select>
</div>
<button type="submit" class="btn btn-success">Update</button>
</form>
</div>
<a href="pharm-home.php"><input type="button" name="Back" value="Back" type="button" class="btn btn-dark"></a>
</div>

<?php include_once('footer.php'); ?>