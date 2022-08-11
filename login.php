<?php 
  
        if (session_status() == PHP_SESSION_NONE) { //if PHP session is not started, session should start
        session_start();
    }
  
    require_once('process-data/connect_db.php');



?>



<!DOCTYPE html>
<html>
<head>
	<title>eMedy Login Screen</title>


        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="192x192" href="ico/android-chrome-192x192.png">
        <link rel="apple-touch-icon-precomposed" sizes="512x512" href="ico/android-chrome-512x512.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">

<link rel="stylesheet" type="text/css" href="css/login.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" rel="stylesheet" id="bootstrap-css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" id="bootstrap-css">

<script type="text/javascript">
    function showPass() {
  var pwd = document.getElementById("Password");
  if (pwd.type === "password") {
    pwd.type = "text";
  } else {
    pwd.type = "password";
  }
}

</script>


</head>

	<body>


                 <?php //show error if email does not exosts or if password is incorrect
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>  
                
            </div>
            <form action="process-data/login-process.php" method="POST">

            <div class="login_form_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-12">&nbsp;</div>
                    <div class="col-md-2 col-md-offset-2"></div>
                    <div class="col-md-8 col-md-offset-2">
                        <!-- login_wrapper -->
                        <div>
                            
                            </div>
                            <h2>Welcome to eMEDY</h2>
                            <div class="formsix-pos">
                                <div class="form-group i-email">
                                    <input type="text" class="form-control" required="" name="Username" id="Username" placeholder="Username *">
                                </div>
                            </div>
                            <div class="formsix-e">
                                <div class="form-group i-password">
                                    <input type="password" class="form-control" required="" name="Password" id="Password" placeholder="Password *">
                                    <input type="checkbox" onclick="showPass()"> Show Password
                                </div>
                            </div>
                            <div class="login_remember_box">
                                <a href="contact-us.php" class="forget_password" target="_blank">
                                    Forgot Password
                                </a>
                            </div>
                            <div class="login_btn_wrapper">
                                <input type="submit" value="Login" class="btn btn-success"> 
                            </div>
                            <div class="login_message">
                                <p>Don&rsquo;t have an account ? <a href="contact-us.php" target="_blank"> Contact eMedy </a> </p>
                            </div>
                        </div>
                        <!-- /.login_wrapper-->
                    </div>
                </div>
            </div>
        </form>
    
        </div>

</body>

</body>
</html>