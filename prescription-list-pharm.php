<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   



	<div class="container">



<h3>Prescription Result</h3>
<div class="row">&nbsp;</div>
<form action="prescription-list-pharm.php" method="POST">
  <div class="form-group row">
    <label for="orderId" class="col-sm-2 col-form-label">Order ID</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="orderID" name="orderID" placeholder="input order number" >
    </div>
    <button type="submit" class="btn btn-success">Search</button>
  </div>
 </form>   

<form action="process-data/prescription-history-process.php" method="POST">
 <?php
require_once('process-data/connect_db.php');

	    $connection = OpenCon();
	
	//extract all the required variables and validate them
	$orderID = mysqli_real_escape_string($connection, trim($_POST['orderID']));
  
	//could not connect to database
  if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error(); //error connection mysql 
      }

  else {
	$result = mysqli_query($connection,"SELECT * FROM prescription_order 
	Left Join drug on drug.ID = prescription_order.DRUG_ID
  Left Join md_det on md_det.REG_NUM = prescription_order.MD_ID
  Left Join person_title on person_title.ID = md_det.TITLE_ID
	WHERE ORDER_ID = '$orderID'");

  $order_pt_det =  mysqli_fetch_assoc($result);
  
  echo '<form action="process-data/revoke-prescription-process.php" method="POST">
  <div class="form-group">
                      <div class="container">
                      <h4>Order ID: ' .$orderID.' - Prescribed by '.$order_pt_det['SHORTNAME'].' '.$order_pt_det['NAME'].' '.$order_pt_det['SURNAME'].'</h2>
                          <table class="table" border="1">
                            <thead>
                              <tr>
                                <th>Drug Name</th>
                                <th>Last Day</th>
                                <th><label for="eventChckbx"><input class="form-check-input" type="checkbox"  name=eventChckbx id="flexCheckDefault" onclick="eventCheckBox()"></th>
                              </tr>
                            </thead>
                            <tbody>';

  //name variable
  //$nr=0;
    
 $result = mysqli_query($connection,"SELECT * FROM prescription_order 
  Left Join drug on drug.ID = prescription_order.DRUG_ID
  Left Join patient on patient.PATIENT_ID = prescription_order.PATIENT_ID
  WHERE ORDER_ID = '$orderID'
  AND prescription_order.STATUS = '1'");	       
 while($order_det = mysqli_fetch_array($result))  
 {
 // $nr++;
 echo ' <tr><td>'.$order_det['NAME'].'</td><td>'.$order_det['DURATION'].' ('.$order_det['DURATION_DAYS'].' days)</td><td><input class="form-check-input" type="checkbox" value="'.$order_det['ORDER_ID'].'¬'.$order_det['ITEM'].'" name=drugID[] id="flexCheckDefault"></td></tr>
                            ';
      
  }

  echo '</tbody>
                            </table></div></div>';

}	

			 

    
?>
	<a href="pharm-home.php"><input type="button" class="btn btn-dark" name="back" value="Back"></a> 
	<input type="submit" class="btn btn-success" name="submit" value="Submit">
</form>
  </div>


 <script>
 	function eventCheckBox() {
  let checkboxs = document.getElementsByTagName("input");
  for(let i = 0; i < checkboxs.length ; i++) { //zero-based array
    checkboxs[i].checked = !checkboxs[i].checked;
  }
}
 </script>


<?php include_once('footer.php'); ?>
