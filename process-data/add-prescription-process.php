<?php
	//open databse connection
	require_once('connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$ptId = mysqli_real_escape_string($connection, trim($_POST['ptId']));
	
	$drug_det0 = mysqli_real_escape_string($connection, trim($_POST['drugSearch0']));
	$duration0 = mysqli_real_escape_string($connection, trim($_POST['duration0']));
	$Date = date("Y-m-d"); //current date in format year-month-day
	$newDuration0 = date('Y-m-d', strtotime($Date. " + $duration0 days"));
	$usage0 = mysqli_real_escape_string($connection, trim($_POST['usage0']));
	$drug_det1 = mysqli_real_escape_string($connection, trim($_POST['drugSearch1']));
	$duration1 = mysqli_real_escape_string($connection, trim($_POST['duration1']));
	$usage1 = mysqli_real_escape_string($connection, trim($_POST['usage1']));
	$mdId = mysqli_real_escape_string($connection, trim($_POST['mdId']));
	$curOrderId = mysqli_real_escape_string($connection, trim($_POST['orderId']));
	$newOrderId = $curOrderId += 1; //adding 1 to current order ID to create a new order ID




	//query A will always retrieve null so that the condition will always was pass to STEP 1
	$query = "SELECT * FROM prescription_order WHERE ID = 'does_not_exsits'";
	//result true or false
	$result = mysqli_query($connection, $query) or die("Error in query 2: " . mysqli_error($connection));
	
	//get 1 row here - STEP 1
	$row = mysqli_fetch_assoc($result);
	if(empty($row)){
				//insert new items in prescription - seq 0
		$query = " INSERT INTO prescription_order (ID, ORDER_ID, ITEM, PATIENT_ID, MD_ID, DRUG_ID, ORDER_DATE, ORDER_TIME, DURATION, USAGE_ID, STATUS, DURATION_DAYS)
				  VALUES ('', '$curOrderId', '0', '$ptId', '$mdId', '$drug_det0', curdate(), now(),'$newDuration0' ,'$usage0', '1', '$duration0')";
		$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
		$product_id = mysqli_insert_id($connection);
		
				//insert new items in prescription - seq 1
		if (!empty($drug_det1)){
			$query = " INSERT INTO prescription_order (ID, ORDER_ID, ITEM, PATIENT_ID, MD_ID, DRUG_ID, ORDER_DATE, ORDER_TIME, DURATION, USAGE_ID, STATUS, DURATION_DAYS)
				  VALUES ('','$curOrderId', '1', '$ptId', '$mdId', '$drug_det1', curdate(), now(), '$duration1' ,'$usage1', '1', '$duration1')";
				$result = mysqli_query($connection, $query) or die("Error in query44: " . mysqli_error($connection));
				$product_id = mysqli_insert_id($connection);

				$_SESSION['success'] = "Prescription added!"; //success message
		} else { 


			$_SESSION['success'] = "Prescription added!"; //success message
	} 
	} else { 
			$_SESSION['success'] = "Prescription added!"; //success message
			
	} 

	//send email process to patient informing the patient the a prescription has been submitted with a unique order id. The patient would be able to visit the pharmacy and buy the required medications by just showing the order id.

 	$query = "SELECT * FROM prescription_order
 left join	drug on drug.ID = prescription_order.DRUG_ID
 	WHERE ORDER_ID = '$newOrderId'"; //get order details
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($order_det = mysqli_fetch_assoc($result)) {
      
      $subject = 'Medical Prescription Submitted. Order Number - '.$order_det['ORDER_ID'].' ';
    } 

             //get patient details
    $ptSurname = mysqli_real_escape_string($connection, trim($_POST['ptSurname']));
    $ptName = mysqli_real_escape_string($connection, trim($_POST['ptName']));

	$body1 = 'Dear ' .$ptSurname. ' ' .$ptName. '
			Order has been submitted.
			Kindly visit your preferred pharmacy to collect the below drugs.';

			//get prescriptions details
	$query = "SELECT * FROM prescription_order JOIN drug on drug.ID = prescription_order.DRUG_ID  WHERE ORDER_ID = '$curOrderId +=1'"; //get order details
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table    
    while($order_det = mysqli_fetch_array($result)){
$body2 =  '<p>Drug Name: '.$order_det['NAME'].'.</p>' ;

//works in progress
foreach($body2 as $druglist){$body1 .= "$druglist\n<br />";}

}

$body = $body1. ' ' .$druglist;

$headers = 'From: prescription@emedy.com' . "\r\n" 
			.'Reply-To: prescription@emedy.com';
	   
// send email
mail("webmaster@example.com", $subject, $body, $headers);

header('Location: ../md-home.php'); //page redirections
			exit(); 
	?>