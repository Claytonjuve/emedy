<?php
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$newPharm = mysqli_real_escape_string($connection, trim($_POST['pharmacySearch']));
	$Username = $_SESSION['currentUser'];
	
	
	$query = "SELECT * FROM pharmacist_det WHERE USERNAME = '$Username'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));


	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(!empty($row)){
				//insert new product
		$query = "UPDATE pharmacist_det 
					SET PHARM_ALLOCATED = '$newPharm'
				  WHERE USERNAME = '$Username'";
		$result = mysqli_query($connection, $query) or die("Error in query " . mysqli_error($connection));

		$query = "SELECT * FROM pharmacy WHERE ID = '$newPharm'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		 while($pharm = mysqli_fetch_assoc($result)){

		$_SESSION['pharmAllocated'] = $pharm['PHARM_NAME'];
}
		$_SESSION['success'] = "Pharmacy Allocation updated!";
		header('Location: ../pharm-home.php');
		exit();
} else { echo 'here';}




	
	?>