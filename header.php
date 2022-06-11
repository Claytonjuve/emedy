<?php 
  
        if (session_status() == PHP_SESSION_NONE) { //if PHP session is not started, session should start
        session_start();
    }
  
    require_once('process-data/connect_db.php');
?>
<!doctype html>
<html lang="en">

    <head>

    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>eMedy Application</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/media-queries.css">
 


          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">

        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

                        <!-- Select2 Searchable dropdwon field -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    </head>

    <body>

    <!-- Top menu -->
    <nav class="navbar navbar-dark fixed-top navbar-expand-md navbar-no-bg">
      <div class="container">
        <a class="navbar-brand" href="">Welcome to eMedy</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto navbar-menu-items fadeIn animated">


<?php 

                 if ($_SESSION['currentRole']=="admin"){
echo       '<li class="nav-item">
                      <a class="nav-link scroll-link" href="admin-home.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                  </li>';
    
}
      if ($_SESSION['currentRole']=="md"){
echo       '<li class="nav-item">
                      <a class="nav-link scroll-link" href="md-home.php"><i class="fad fa-home"></i></a>
                  </li>';
} 

      if ($_SESSION['currentRole']=="pharm"){
echo       '<li class="nav-item">
                      <a class="nav-link scroll-link" href="pharm-home.php<i class="fa fa-home" aria-hidden="true"><i class="fa fa-home" aria-hidden="true"></i></a>
                  </li>';
} 


?>

                  <li class="nav-item">
                      <a class="nav-link scroll-link" href="#top-content"></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link scroll-link" href="#section-1">Personal Details</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link scroll-link" href="#section-2">Change Password</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link scroll-link" href="#section-3">Contact Us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link scroll-link" href="process-data/logout-process.php">Sign out</a>
                  </li>
              </ul>
              <form class="form-inline navbar-search-form disabled ml-auto" action="" method="post">
                <input type="search" name="search" placeholder="Type and hit enter..." aria-label="Search" class="search form-control">
              </form>
              <ul class="navbar-nav navbar-search-button">
                  <li class="nav-item">
                      <a class="nav-link search-button" href="#"><i class="fas fa-search"></i></a>
                  </li>
              </ul>
          </div>
        </div>
    </nav>

        <!-- Top content -->
        <div class="top-content">
          
            <div class="inner-bg">
                <div class="container">
                  
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text">
                            <h1 class="wow fadeInLeftBig">Welcome to eMedy</h1>
                            <div class="description wow fadeInUp">
                              <p>
                                <?php
  
  echo '<h2">You are logged in as '.$_SESSION['currentTitle'].' '.$_SESSION['currentSurname'].' '.$_SESSION['currentName'].' ('.$_SESSION['currentUser'].')</h2>';

?>
                              </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 401px; width: 1903px; z-index: -999998; position: absolute;"><img src="img/backgrounds/bg2.jpg" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1903px; height: 1268.67px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -333.833px;"></div>
        </div>
        
      
