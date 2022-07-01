<?php
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$ptName = mysqli_real_escape_string($connection, trim($_POST['ptName']));
	$ptSurname = mysqli_real_escape_string($connection, trim($_POST['ptSurname']));
	$ptId = mysqli_real_escape_string($connection, trim($_POST['ptId']));
	$ptEmail = mysqli_real_escape_string($connection, trim($_POST['ptEmail']));
	$ptTel = mysqli_real_escape_string($connection, trim($_POST['ptTel']));
	$ptTitle = mysqli_real_escape_string($connection, trim($_POST['ptTitle']));





	$query = "SELECT * FROM patient WHERE PATIENT_ID = '$ptId'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO patient (PATIENT_ID, SURNAME, PT_NAME, EMAIL, CONTACT_NO, TITLE)
				  VALUES ('$ptId', '$ptSurname', '$ptName', '$ptEmail', '$ptTel' ,'$ptTitle')";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "Patient added!";

		header('Location: ../md-home.php');
		exit();
	} else {
		//update existing patient
		$query = "UPDATE patient 
				  SET PT_NAME = '$ptName', SURNAME = '$ptSurname', PATIENT_ID = '$ptId', EMAIL = '$ptEmail', Title = '$ptTitle', CONTACT_NO = '$ptTel'
				  WHERE PATIENT_ID = '$ptId'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		$_SESSION['success'] = "Patient updated!";
		header('Location: ../md-home.php');
		exit();

	}
	
	?>