 <?php include_once('header.php'); ?>

    <?php //show error if email does not exosts or if password is incorrect
              if(isset($_SESSION['success'])) {
              echo '<div class="alert alert-success" role="success">'.$_SESSION['success'].'</div>';
                            unset($_SESSION['success']);
              
              }

            ?>  

     <?php //show error 
              if(isset($_SESSION['error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
                            unset($_SESSION['error']);
              
              }
            ?>   

      <!-- Section 1 -->
        <div class="section-1-container section-container">
            <div class="container">
                <div class="row">
                    <div class="col section-1 section-description wow fadeIn">
                        
   <h2>Pharmacists Home Page</h2>
                       

                        <div class="divider-1 wow fadeInUp"><span></span></div>
                    </div>
                </div>



<?php
    require_once('process-data/connect_db.php');

        $connection = OpenCon();
    
    //extract all the required variables and validate them
    $Username = $_SESSION['currentUser'];
    
    
    $query = "SELECT PHARM_ALLOCATED FROM pharmacist_det WHERE USERNAME = '$Username'";
    //result true or false
    $result = mysqli_query($connection, $query) or die("Error in query here: " . mysqli_error($connection));


    
    //get 1 row here
    //$row = mysqli_fetch_assoc($result);
    while ($row=mysqli_fetch_assoc($result))
    if(is_null($row)){ echo '
                                        <div class="row">
                   
                    
                    <div class="col-md-4 section-1-box wow fadeInUp">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fas fas fa-prescription"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3>Unable to Retrieve Prescription</h3>
                                <p>You cannot retrieve a prescription. First you need to choose a pharmacy</p>
                            </div>
                        </div>
                    
                    </div>';

}
         else { echo '  <div class="row">
                   
                    <a href="prescription-edit.php">
                    <div class="col-md-4 section-1-box wow fadeInUp">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fas fas fa-prescription"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3>Retrieve Prescription</h3>
                                <p>You can retrieve a prescription from here</p>
                            </div>
                        </div>
                    </a>
                    </div> 
';}




    
    ?>




<!--


                <div class="row">
                   
                    <a href="prescription-edit.php">
                    <div class="col-md-4 section-1-box wow fadeInUp">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fas fas fa-prescription"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3>Retrieve Prescription</h3>
                                <p>You can retrieve a prescription from here</p>
                            </div>
                        </div>
                    </a>
                    </div>


-->









                    <div class="col-md-4 section-1-box wow fadeInDown">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-1-box-icon">
                                    <i class="fas fa-hospital "></i>
                                </div>
                            </div>
                            <div class="col-md-8"><a href="pharm-allocated.php">
                                <h3>Pharmacy</h3>
                                <p>You can change the pharmacy you are working</p>
                            </div>
                        </div></a>
                    </div>
                    
                </div>


        </div>



<?php include_once('footer.php'); ?>