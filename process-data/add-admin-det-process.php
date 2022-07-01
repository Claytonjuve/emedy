<?php
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$adminName = mysqli_real_escape_string($connection, trim($_POST['adminName']));
	$adminSurname = mysqli_real_escape_string($connection, trim($_POST['adminSurname']));
	$adminID = mysqli_real_escape_string($connection, trim($_POST['adminID']));
	$adminEmail = mysqli_real_escape_string($connection, trim($_POST['adminEmail']));
	$adminUsername = mysqli_real_escape_string($connection, trim($_POST['adminUsername']));


		 //Generate Random Password
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	$password = substr( str_shuffle( $chars ), 0, 8 );
		//encrypt pwd
	$passwordEncrypted = hash('sha512',$password);

	$query = "SELECT * FROM login WHERE USERNAME = '$adminUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO login (PASSWORD, ROLE, USERNAME)
				  VALUES ('$passwordEncrypted', 'admin', '$adminUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query22 " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
}



	$query = "SELECT * FROM admin_det WHERE USERNAME = '$adminUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO admin_det (ID, USERNAME, SURNAME, NAME, EMAIL)
				  VALUES ('$adminID', '$adminUsername', '$adminSurname', '$adminName', '$adminEmail')";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "adminacists added!";

		//send email process
      $subject = 'eMedy New User Login Details';
      $body = 'Dear ' .$adminSurname. ' ' .$adminName. '
			Your eMedy account is created. Kindly login with the following details:
			Username: ' .$adminUsername.' 
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
		$query = "UPDATE admin_det 
				  SET NAME = '$adminName', SURNAME = '$adminSurname', REG_NUM = '$adminID', EMAIL = '$adminEmail', TITLE_ID = '$title', USERNAME = $'adminUsername'
				  WHERE USERNAME = '$adminUsername'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		$_SESSION['success'] = "Admin updated!";
		header('Location: ../admin-home.php');
		exit();

	}
	
	?>