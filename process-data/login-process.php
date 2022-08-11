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
	
	//hash password
	$passwordEncrypted = hash('sha512',$Password);

	//check if the email is in the database and if the encrypted password matches

	$query = "SELECT * FROM login
	Left Join admin_det on login.username = admin_det.username
	Left Join md_det on login.username = md_det.username
	Left Join pharmacist_det pharm_det on login.username = pharm_det.username
	Left Join pharmacy on pharmacy.ID = pharm_det.PHARM_ALLOCATED
	

	 WHERE login.username = '$Username' AND login.password = '$passwordEncrypted'";
	

	//below are the roles
	$md = "MD";
	$pharm = "PHARM";
	$admin = "ADMIN";

	//random digits for 2fa

	$pin1 = rand(0,9);
	$pin2 = rand(0,9);
	$pin3 = rand(0,9);
	$pin4 = rand(0,9);
	$pin5 = rand(0,9);
	$pin6 = rand(0,9);

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

		//2fa
		$query = "UPDATE login SET 2FA_1 = '$pin1',
									2FA_2 = '$pin2',
									2FA_3 = '$pin3',
									2FA_4 = '$pin4',
									2FA_5 = '$pin5',
									2FA_6 = '$pin6' 
		WHERE login.username = '$Username' AND login.password = '$passwordEncrypted'";
		$result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
	
	//get 1 row here
	


		$query = "SELECT * FROM login 
		left join md_det on md_det.USERNAME = login.USERNAME 
		left join admin_det on admin_det.USERNAME = login.USERNAME 
		Left join pharmacist_det on pharmacist_det.USERNAME = login.USERNAME
		 WHERE login.USERNAME = '$Username'";
		 $result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection)); 
		$row = mysqli_fetch_assoc($result);

		// save the user data in the session
		$_SESSION['currentUser'] = $Username;
		$_SESSION['currentRole'] = $row['ROLE'];
		$_SESSION['currentName'] = $row['NAME'];
		$_SESSION['currentSurname'] = $row['SURNAME'];
		$_SESSION['currentTitle'] = $row['SHORTNAME'];
		$_SESSION['pharmAllocated'] = $row['PHARM_NAME'];
		$_SESSION['ID'] = $row['ID'];
		$pin1 = $row['2FA_1'];
		$_SESSION['pin2'] = $row['2FA_2'];
		$_SESSION['pin3'] = $row['2FA_3'];
		$_SESSION['pin4'] = $row['2FA_4'];
		$_SESSION['pin5'] = $row['2FA_5'];
		$_SESSION['pin6'] = $row['2FA_6'];





			//send email process
      $subject = 'eMedy one time 2FA';  

	  $body = 'Your one time 2FA is ' .$pin1. ''.$_SESSION['pin2']. ''.$_SESSION['pin3']. ''.$_SESSION['pin4']. ''.$_SESSION['pin5']. ''.$_SESSION['pin6']. ' 

			Thank You
			eMedy Team';


		$headers = 'From: webmaster@example.com' . "\r\n" 
			.'Reply-To: webmaster@example.com';
	   
		// send email
		mail("webmaster@example.com", $subject, $body, $headers);

		header('Location: ../2fa.php');
		exit(); 


		}
		
?>