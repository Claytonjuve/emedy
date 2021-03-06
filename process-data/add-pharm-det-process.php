<?php
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$pharmName = mysqli_real_escape_string($connection, trim($_POST['pharmName']));
	$pharmSurname = mysqli_real_escape_string($connection, trim($_POST['pharmSurname']));
	$pharmID = mysqli_real_escape_string($connection, trim($_POST['pharmID']));
	$pharmEmail = mysqli_real_escape_string($connection, trim($_POST['pharmEmail']));
	$pharmUsername = mysqli_real_escape_string($connection, trim($_POST['pharmUsername']));


		 //Generate Random Password
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	$password = substr( str_shuffle( $chars ), 0, 8 );
		//encrypt pwd
	$passwordEncrypted = hash('sha512',$password);

	$query = "SELECT * FROM login WHERE USERNAME = '$pharmUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO login (PASSWORD, ROLE, USERNAME)
				  VALUES ('$passwordEncrypted', 'pharm', '$pharmUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query22 " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
}



	$query = "SELECT * FROM pharmacist_det WHERE USERNAME = '$pharmUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO pharmacist_det (ID, USERNAME, SURNAME, NAME, EMAIL, PHARM_ALLOCATED)
				  VALUES ('$pharmID', '$pharmUsername', '$pharmSurname', '$pharmName', '$pharmEmail', Null)";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "Pharmacists added!";

		//send email process
      $subject = 'eMedy New User Login Details';
      $body = 'Dear ' .$pharmSurname. ' ' .$pharmName. '
			Your eMedy account is created. Kindly login with the following details:
			Username: ' .$pharmUsername.' 
			Password: ' .$password.  '
			May we remind you to change your password as soon as you login. ';


	  $headers = 'From: itservices@emedy.com' . "\r\n" 
			    .'Reply-To: itservices@emedy.com';
	   
		// send email
		mail("itservices@emedy.com", $subject, $body, $headers);


		header('Location: ../admin-home.php');
		exit();
	} else {
		//update existing product
		$query = "UPDATE pharmacists_det 
				  SET NAME = '$pharmName', SURNAME = '$pharmSurname', REG_NUM = '$pharmID', EMAIL = '$pharmEmail', TITLE_ID = '$title', USERNAME = $'pharmUsername'
				  WHERE USERNAME = '$pharmUsername'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		$_SESSION['success'] = "Pharmacist updated!";
		header('Location: ../mdhome.php');
		exit();

	}
	
	?>