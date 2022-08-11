<?php
	//open database connection
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$mdName = mysqli_real_escape_string($connection, trim($_POST['mdName']));
	$mdSurname = mysqli_real_escape_string($connection, trim($_POST['mdSurname']));
	$mdId = mysqli_real_escape_string($connection, trim($_POST['mdId']));
	$mdEmail = mysqli_real_escape_string($connection, trim($_POST['mdEmail']));
	$mdUsername = mysqli_real_escape_string($connection, trim($_POST['mdUsername']));
	$title = mysqli_real_escape_string($connection, trim($_POST['Title']));




	 //Generate Random Password from the below array
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	//store the password in $password
	$password = substr( str_shuffle( $chars ), 0, 8 );
	//encrypt password and store it in $passwordEncrypted
	$passwordEncrypted = hash('sha512',$password);

	//retrieve the user details from the table login
	$query = "SELECT * FROM login WHERE USERNAME = '$mdUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));


	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO login (PASSWORD, ROLE, USERNAME)
				  VALUES ('$passwordEncrypted', 'md', '$mdUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
}


	//retrieve doctor details from the table md_det
	$query = "SELECT * FROM md_det WHERE REG_NUM = '$mdId'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new doctor if result from previous query is 0
		$query = "INSERT INTO md_det (EMAIL, REG_NUM, NAME, SURNAME, TITLE_ID, USERNAME)
				  VALUES ('$mdEmail', '$mdId', '$mdName', '$mdSurname', '$title', '$mdUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "Doctor added!"; // success message when new doctor is created


	
		//send email process to the new created user (doctor) with the username and password to access eMEDY
      $subject = 'eMedy New User Login Details';
      $body = 'Dear ' .$mdSurname. ' ' .$mdName. '
			Your eMedy account is created. Kindly login with the following details:
			Username: ' .$mdUsername.' 
			Password: ' .$password.  '
			May we remind you to change your password as soon as you login. ';


	  $headers = 'From: itservices@emedy.com' . "\r\n" 
			    .'Reply-To: itservices@emedy.com';
	   
		// send email
		mail("itservices@emedy.com", $subject, $body, $headers);

		
		header('Location: ../admin-home.php'); //page redirection
		exit();
	} else {
		//update existing doctor when the previous query returned 1
		$query = "UPDATE md_det 
				  SET NAME = '$mdName', SURNAME = '$mdSurname', REG_NUM = '$mdId', EMAIL = '$mdEmail', 
				  TITLE_ID = '$title', 
				  USERNAME = '$mdUsername'
				  WHERE REG_NUM = '$mdId'";
		$result = mysqli_query($connection, $query) or die("Error in query23232: " . mysqli_error($connection));
		$_SESSION['success'] = "Doctor updated!"; //success message doctor updated
		header('Location: ../admin-home.php'); //page redirection
		exit();

	}
	
	?>