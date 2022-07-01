<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Success'])) {
              echo '<div class="alert alert-success" role="success">'.$_SESSION['Success'].'</div>';
                            unset($_SESSION['Success']);
              
              }
            ?>   


<form action="process-data/change-pwd-process.php" method="POST">

<div class="container">
<h3>Change Password</h3>
  <div class="form-group row">
    <input type="hidden" name="currentUsername" value=<?php echo $_SESSION['currentUser'];?>>
    <label for="mdSearch" class="col-sm-2 col-form-label">Current Password</label>
    <div class="col-sm-9"><input type="password" class="form-control" id="currentPwd" name="currentPwd" placeholder="***"> </div>
     <label for="mdSearch" class="col-sm-2 col-form-label">New Password</label>
    <div class="col-sm-9"><input type="password" class="form-control" id="newPwd" name="newPwd" placeholder="***"> </div>
     <label for="mdSearch" class="col-sm-2 col-form-label">Confirm Password</label>
    <div class="col-sm-9"><input type="password" class="form-control" id="confPwd" name="confPwd" placeholder="***"> </div>


</div>
<input type="submit" name="submit" class="btn btn-success" value="Change" onclick="validatePassword();">

</div>
</form>

<script type="text/javascript">
  var password = document.getElementById("newPwd")
  , confirm_password = document.getElementById("confPwd");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

newPwd.onchange = validatePassword;
confPwd.onkeyup = validatePassword;

</script>

  


<?php include_once('footer.php'); ?>