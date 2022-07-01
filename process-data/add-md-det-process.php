<?php
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$mdName = mysqli_real_escape_string($connection, trim($_POST['mdName']));
	$mdSurname = mysqli_real_escape_string($connection, trim($_POST['mdSurname']));
	$mdId = mysqli_real_escape_string($connection, trim($_POST['mdId']));
	$mdEmail = mysqli_real_escape_string($connection, trim($_POST['mdEmail']));
	$mdUsername = mysqli_real_escape_string($connection, trim($_POST['mdUsername']));
	$title = mysqli_real_escape_string($connection, trim($_POST['Title']));




	 //Generate Random Password
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password = substr( str_shuffle( $chars ), 0, 8 );
	//encrypt pwd
$passwordEncrypted = hash('sha512',$password);


	$query = "SELECT * FROM login WHERE USERNAME = '$mdUsername'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));


	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO login (PASSWORD, ROLE, USERNAME)
				  VALUES ('$passwordEncrypted', 'md', '$mdUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query22 " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
}



	$query = "SELECT * FROM md_det WHERE REG_NUM = '$mdId'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new product
		$query = "INSERT INTO md_det (EMAIL, REG_NUM, NAME, SURNAME, TITLE_ID, USERNAME)
				  VALUES ('$mdEmail', '$mdId', '$mdName', '$mdSurname', '$title', '$mdUsername')";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		$_SESSION['success'] = "Doctor added!";


	

		//send email process
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

		
		header('Location: ../admin-home.php');
		exit();
	} else {
		//update existing product
		$query = "UPDATE md_det 
				  SET NAME = '$mdName', SURNAME = '$mdSurname', REG_NUM = '$mdId', EMAIL = '$mdEmail', TITLE_ID = '$title', USERNAME = $'mdUsername'
				  WHERE REG_NUM = '$mdId'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
		$_SESSION['success'] = "Patient updated!";
		header('Location: ../mdhome.php');
		exit();

	}
	
	?>