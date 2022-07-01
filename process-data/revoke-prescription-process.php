
<?php
if(isset($_POST['submit'])){

          require_once('connect_db.php');
          $connection = OpenCon();

    if(!empty($_POST['drugID'])) {

        foreach($_POST['drugID'] as $value){
            //echo "value : ".$value.'<br/>';
          
        
          $result = mysqli_query($connection,"UPDATE prescription_order SET STATUS = 3  
          WHERE CONCAT (ORDER_ID, '¬', ITEM) = '$value'");
         
         //   $orderID = strtok($value, '¬');
          //  echo "order id : ".$orderID.'<br/>';
        }

    }
     header('Location: ../md-home.php');
      exit();

}
?>

