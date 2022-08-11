<?php
	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	
	//use the database
    require_once("connect_db.php");
    
    //get a connection to the databases
    $connection = OpenCon();



    if ($_SESSION['currentRole']=="admin"){	
    	header('Location: ../admin-home.php');
    	exit;
}
	    if ($_SESSION['currentRole']=="md"){
    	header('Location: ../md-home.php');
    	exit;
} 

	    if ($_SESSION['currentRole']=="pharm"){	
    	header('Location: ../pharm-home.php');
    	exit;
} 
?>