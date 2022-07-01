<?php include_once('header.php'); 

	 //show error or success
              if(isset($_SESSION['success'])) {
              echo '<div class="alert alert-success" role="success">'.$_SESSION['success'].'</div>';
                            unset($_SESSION['success']);
              
              }

        

            




?>



        <!-- Section 1 -->
        <div class="section-1-container section-container">
	        <div class="container">
	            <div class="row">
	                <div class="col section-1 section-description wow fadeIn">
	                    <h2>Admin Home Page</h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                </div>
	            </div>
	            <div class="row">
	            	<a href="md-det-edit.php">
                	<div class="col-md-4 section-1-box wow fadeInUp">
                		<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fas fa-user-md"></i></i>
			                	</div>
		                	</div>
	                		<div class="col-md-8">
	                    		<h3>Doctor Details</h3>
	                    		<p>You can add/update/delete doctor's information from here</p>
	                    	</div>
	                    </div>
	                </a>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInDown">
	                	<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fa fa-tasks" aria-hidden="true"></i>
			                	</div>
		                	</div>
	                		<div class="col-md-8"><a href="admin-det-edit.php">
	                    		<h3>Admin Details</h3>
	                    		<p>You can add/update/delete admin details from here</p>
	                    	</div></a>
	                    </div>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInDown">
	                	<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fas fas fa-prescription"></i>
			                	</div>
		                	</div>
	                		<div class="col-md-8"><a href="pharm-det-edit.php">
	                    		<h3>Pharmacists Details</h3>
	                    		<p>You can add/update/delete pharmacists details from here</p>
	                    	</div></a>
	                    </div>
                    </div>
                    <div class="col-md-4 section-1-box wow fadeInUp">
	                	<div class="row">
                			<div class="col-md-4">
			                	<div class="section-1-box-icon">
			                		<i class="fas fas fa-prescription"></i>
			                		
			                	</div>
		                	</div>
	                		<div class="col-md-8">
	                    		<h3>Pharmacy</h3>
	                    		<p>You can add/update/delete pharmacists details from here</p>
	                    	</div>
	                    </div>
                    </div>
	            </div>
	        </div>
        </div>

<?php include_once('footer.php'); ?>