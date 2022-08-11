<?php
	//open db connection
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$pharmName = mysqli_real_escape_string($connection, trim($_POST['pharmName']));
	$pharmSurname = mysqli_real_escape_string($connection, trim($_POST['pharmSurname']));
	$pharmID = mysqli_real_escape_string($connection, trim($_POST['pharmID']));
	$pharmEmail = mysqli_real_escape_string($connection, trim($_POST['pharmEmail']));
	$pharmUsername = mysqli_real_escape_string($connection, trim($_POST['pharmUsername']));


		 //Generate Random Password from the below string
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	//store the password in $password
	$password = substr( str_shuffle( $chars ), 0, 8 );
	//store the encrypted password in $paswordEncrypted
	$passwordEncrypted = hash('sha512',$password);

	//retrieve pharmacist details from table login
	$query = "SELECT * FROM login WHERE USERNAME = '$pharmUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));
	
	//get 1 row here or 0 row -- QUERY A
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new pharm if result is 0 in QUERY A
		$query = "INSERT INTO login (PASSWORD, ROLE, USERNAME)
				  VALUES ('$passwordEncrypted', 'pharm', '$pharmUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query22 " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
}


	//retrieve pharm details from table pharmacist_det
	$query = "SELECT * FROM pharmacist_det WHERE USERNAME = '$pharmUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query A: " . mysqli_error($connection));
	
	//get 1 row here or 0 row -- QUERY B
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new pharm if result is 0 in QUERY B
		$query = "INSERT INTO pharmacist_det (ID, USERNAME, SURNAME, NAME, EMAIL, PHARM_ALLOCATED)
				  VALUES ('$pharmID', '$pharmUsername', '$pharmSurname', '$pharmName', '$pharmEmail', Null)";
		$result = mysqli_query($connection, $query) or die("Error in query B: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "Pharmacists added!"; //success message

		//send email to new pharmacist user who has been created on eMEDY with credentials
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


		header('Location: ../admin-home.php'); //page redirection
		exit();
	} else {
		//update existing pharm if QUERY A returned a row
		$query = "UPDATE pharmacists_det 
				  SET NAME = '$pharmName', SURNAME = '$pharmSurname', REG_NUM = '$pharmID', EMAIL = '$pharmEmail', TITLE_ID = '$title', USERNAME = $'pharmUsername'
				  WHERE USERNAME = '$pharmUsername'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		$_SESSION['success'] = "Pharmacist updated!"; //success message
		header('Location: ../mdhome.php'); //page redirection
		exit();

	}
	
	?>