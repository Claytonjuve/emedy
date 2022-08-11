<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	
	//use the database
    require_once("connect_db.php");
    
    //get a connection to the database
    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$Username = mysqli_real_escape_string($connection, trim($_POST['currentUsername']));
	$cPassword = mysqli_real_escape_string($connection, trim($_POST['currentPwd']));
	$nPassword = mysqli_real_escape_string($connection, trim($_POST['newPwd']));
	
	//encrypted password in SHA512
	$passwordEncrypted = hash('sha512',$cPassword);
	//new encrypted password in SHA512
	$npasswordEncrypted = hash('sha512',$nPassword);

	//check if the email address is in the database and if the encrypted password matches

	$query = "SELECT * FROM login
	WHERE login.username = '$Username' AND login.password = '$passwordEncrypted'";
	
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	
	if(empty($row)){  //if login details fail
		$_SESSION['Error'] = "Incorrect current password.";
		header('Location: ../change-pwd.php'); 
		exit;
	}
	else {

		//update pwd in the table login
		$query = "UPDATE login SET PASSWORD = '$npasswordEncrypted'
		WHERE login.username = '$Username' AND login.password = '$passwordEncrypted'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
	
	
		$_SESSION['Success'] = "Password updated!";
		header('Location: ../change-pwd.php');
		exit(); 


		}
		
?>