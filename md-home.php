 <?php include_once('header.php'); ?>

    <?php //show error if email does not exosts or if password is incorrect
              if(isset($_SESSION['success'])) {
              echo '<div class="alert alert-success" role="success">'.$_SESSION['success'].'</div>';
                            unset($_SESSION['success']);
              
              }

         //     $dotPhp = "pt-det-edit.php";
          //    $link0 = urlencode(base64_encode($dotPhp));

            ?>  

      <!-- Section 1 -->
        <div class="section-1-container section-container">
            <div class="container">
                <div class="row">
                    <div class="col section-1 section-description wow fadeIn">
                        <h2>Medical Doctor Home Page</h2>
                        <div class="divider-1 wow fadeInUp"><span></span></div>
                    </div>
                </div>
                <div class="row">
                    <a href="pt-det-edit.php">
                    <div class="col-md-4 section-1-box wow fadeInUp">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fas fa-hospital"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3>Patient Details</h3>
                                <p>You can add/update/delete patient's information from here</p>
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInDown">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fas fas fa-prescription"></i>
                                </div>
                            </div>
                            <div class="col-md-8"><a href="prescription-new.php">
                                <h3>Prescription</h3>
                                <p>You can add/revoke a prescription from here</p>
                            </div>
                        </div></a>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInUp">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fa fa-medkit" aria-hidden="true"></i>
                                    
                                </div>
                            </div>
                            <div class="col-md-8"><a href="sick-cert.php">
                                <h3>Sick Certificate</h3>
                                <p>You can generate a sick certificate from here</p>
                            </div>
                        </div></a>
                    </div>
                </div>



            </div>
        </div>



<?php include_once('footer.php'); ?>