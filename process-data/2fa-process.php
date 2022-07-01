<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

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



	// Generate Random Password
/*$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password = substr( str_shuffle( $chars ), 0, 8 );


// Encrypt password
$password = password_hash($password, PASSWORD_ARGON2I);



	//$password = substr( str_shuffle( $chars ), 0, 8 );
*/
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