<?php


if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	

	//	const SALT = "KFb38BDB886DH20&£Hdbb2808";

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "emedpres";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   




?>