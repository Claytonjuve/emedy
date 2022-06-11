<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	
	//use the database
    require_once("connect_db.php");
    
    //get a connection to the databases
    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$Username = mysqli_real_escape_string($connection, trim($_POST['Username']));
	$Password = mysqli_real_escape_string($connection, trim($_POST['Password']));
	
	//check if the email is in the database and if the hashed password matches
	// to add below in query
	//Join pharmacist_det on login.username = pharmacist_det.username
	//Join md_det on login.username = md_det.username
	$query = "SELECT * FROM login
	Left Join admin_det on login.username = admin_det.username
	Left Join md_det on login.username = md_det.username
	Left Join person_title on person_title.ID = admin_det.TITLE_ID

	 WHERE login.username = '$Username' AND login.password = '$Password'";
	

	//below are the roles
	$md = "MD";
	$pharm = "PHARM";
	$admin = "ADMIN";

	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
	
	//get 1 row here
	$row = mysqli_fetch_assoc($result);
	
	if(empty($row)){  //if login details fail
		$_SESSION['Error'] = "Incorrect username and/or password.";
		header('Location: ../login.php'); 
		exit;
	}
	else {

		
		// save the user data in the session
		$_SESSION['currentUser'] = $Username;
		$_SESSION['currentRole'] = $row['ROLE'];
		$_SESSION['currentName'] = $row['NAME'];
		$_SESSION['currentSurname'] = $row['SURNAME'];
		$_SESSION['currentTitle'] = $row['SHORTNAME'];
	//	$_SESSION['success'] = "Hello " . $row['role'] . ", you are now logged in!";
		header('Location: user-homepage-redirection.php');
		exit;
		}
		
?>