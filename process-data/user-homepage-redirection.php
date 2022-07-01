<?php

	
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	
	//use the database
    require_once("connect_db.php");
    
    //get a connection to the databases
    $connection = OpenCon();



    if ($_SESSION['currentRole']=="admin"){
//echo '<p>hello '.$_SESSION['currentUser'].'AW PHARM'.$_SESSION['success'].'try role'.$_SESSION['currentRole'].'</p>';	
    	header('Location: ../admin-home.php');
    	exit;
}
	    if ($_SESSION['currentRole']=="md"){
//echo '<p>hello '.$_SESSION['currentUser'].'AW PHARM'.$_SESSION['success'].'try role'.$_SESSION['currentRole'].'</p>';	
    	header('Location: ../md-home.php');
    	exit;
} 

	    if ($_SESSION['currentRole']=="pharm"){
//echo '<p>hello '.$_SESSION['currentUser'].'AW PHARM'.$_SESSION['success'].'try role'.$_SESSION['currentRole'].'</p>';	
    	header('Location: ../pharm-home.php');
    	exit;
} 



?>