<?php
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$ptId = mysqli_real_escape_string($connection, trim($_POST['ptId']));
	
	$drug_det = mysqli_real_escape_string($connection, trim($_POST['drugSearch']));
	$duration = mysqli_real_escape_string($connection, trim($_POST['duration']));
	$usage = mysqli_real_escape_string($connection, trim($_POST['usage']));
	$nul = NULL;
	$pharm01 = 'pharm01';





	$query = "SELECT * FROM prescription_order WHERE ID = 'does_not_exsits'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = " INSERT INTO prescription_order (ID, ITEM, PATIENT_ID, MD_ID, DRUG_ID, ORDER_DATE, DURATION, USAGE_ID, STATUS)
				  VALUES ('','', '$ptId', 10, '$drug_det', curdate(), '$duration' ,'$usage', '1')";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "Prescription added!";

		header('Location: ../md-home.php');
		exit();
	} else {
		//update existing patient
		$query = "UPDATE patient 
				  SET NAME = '$ptName', SURNAME = '$ptSurname', PATIENT_ID = '$ptId', EMAIL = '$ptEmail', Title = '$ptTitle', CONTACT_NO = '$ptTel'
				  WHERE PATIENT_ID = '$ptId'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		$_SESSION['success'] = "Patient updated!";
		header('Location: ../md-home.php');
		exit();

	}
	
	?>