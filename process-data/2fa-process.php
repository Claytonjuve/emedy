<?php
	//open php session
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	//open connaction for database
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$pin1 = mysqli_real_escape_string($connection, trim($_POST['pin1']));
	$pin2 = mysqli_real_escape_string($connection, trim($_POST['pin2']));
	$pin3 = mysqli_real_escape_string($connection, trim($_POST['pin3']));
	$pin4 = mysqli_real_escape_string($connection, trim($_POST['pin4']));
	$pin5 = mysqli_real_escape_string($connection, trim($_POST['pin5']));
	$pin6 = mysqli_real_escape_string($connection, trim($_POST['pin6']));
	$Username = $_SESSION['currentUser'];


	//query to validate 2fa with the user
	$query = "SELECT * FROM login WHERE USERNAME = '$Username'
		AND 2FA_1 = $pin1
		AND 2FA_2 = $pin2
		AND 2FA_3 = $pin3
		AND 2FA_4 = $pin4
		AND 2FA_5 = $pin5
		AND 2FA_6 = $pin6";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));


	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
			$_SESSION['Error'] = "Incorrect 2FA inputted";
			header('Location: ../login.php');
			exit();

}else{
		$_SESSION['currentRole'] = $row['ROLE'];
		header('Location: user-homepage-redirection.php');
		exit();
	} 
	
	?>