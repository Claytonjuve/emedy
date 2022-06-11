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

<link rel="stylesheet" type="text/css" href="css/login.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" rel="stylesheet" id="bootstrap-css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" id="bootstrap-css">


</head>
<body>
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
                    <div class="col-md-8 col-md-offset-2">
                        <!-- login_wrapper -->
                        <div class="login_wrapper">
                            
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
                                </div>
                            </div>
                            <div class="login_remember_box">
                                <a href="#" class="forget_password">
                                    Forgot Password
                                </a>
                            </div>
                            <div class="login_btn_wrapper">
                                <input type="submit" value="Login" class="btn btn-success"> 
                            </div>
                            <div class="login_message">
                                <p>Don&rsquo;t have an account ? <a href="#"> Sign up </a> </p>
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