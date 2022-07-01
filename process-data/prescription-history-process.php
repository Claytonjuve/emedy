
<?php
          require_once('connect_db.php');
          $connection = OpenCon();

  $Username = $_SESSION['currentUser'];
            //could not connect to database
  if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error(); //error connection mysql 
      }

  else {
    $result = mysqli_query($connection,"SELECT * FROM pharmacist_det 
    WHERE pharmacist_det.USERNAME = '$Username'");

     $pharmacy =  mysqli_fetch_assoc($result);
        if (!empty($pharmacy)){
          $pharmacistId = $pharmacy['ID'];
          $pharmacyId = $pharmacy['PHARM_ALLOCATED'];
        }

//$_POST['drugID']; 
//$orderId = strstr($drugID,"¬");
//$item = substr($drugID, strrpos($drugID, "¬") + 1); 


if(isset($_POST['submit'])){

         

    if(!empty($_POST['drugID'])) {

        foreach($_POST['drugID'] as $value){
          //$drugIdItem = $_POST['drugID'];
         // $drugIdItem = mysqli_real_escape_string($connection, trim($_POST['drugID']));
          $orderId = strstr($value,'¬', true);
          $item = ltrim(strstr($value, '¬'),'¬');
        
          $query = "INSERT INTO  prescription_history
            (ID, ORDER_ID, ITEM, PHARMACISTS_ID, PHARMACY_ID, COMPLETED_DATE)
            VALUE('', '$orderId', '$item',  '$pharmacistId',  '$pharmacyId', curdate())";
          $result = mysqli_query($connection, $query) or die("Error in query ** : " . mysqli_error($connection));
          $product_id = mysqli_insert_id($connection);




          $result = mysqli_query($connection,"UPDATE prescription_order SET STATUS = 2 
          WHERE CONCAT (ORDER_ID, '¬', ITEM) = '$value'");
         
        }
          $_SESSION['success'] = "Prescription updated!";
          header('Location: ../pharm-home.php');
          exit();

    }
    $_SESSION['error'] = "error!";
     header('Location: ../pharm-home.php');
      exit();
  

}
    
}
?>