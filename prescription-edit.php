<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   


<form action="prescription-list-pharm.php" method="POST" id="form">
	<div class="container">



<h3>Retrieve Prescription</h3>
<div class="row">&nbsp;</div>
<form>
  <div class="form-group row">
    <label for="orderId" class="col-sm-2 col-form-label">Order ID</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="orderID" name="orderID" placeholder="input order number" required >
    </div>
    <button type="submit" class="btn btn-success">Search</button>
  </div>
    
 </form>

  


  </div>


 


<?php include_once('footer.php'); ?>