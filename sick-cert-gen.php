<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }

    //use the database
    require_once("process-data/connect_db.php");
    
    //get a connection to the databases
    $connection = OpenCon();          

    $ptname = mysqli_real_escape_string($connection, trim($_POST['ptName']));
    $ptsurname = mysqli_real_escape_string($connection, trim($_POST['ptSurname']));
    //$pttitle = mysqli_real_escape_string($connection, trim($_POST['ptTitle']));    
    $strdate = mysqli_real_escape_string($connection, trim($_POST['start-date']));    
    $enddate = mysqli_real_escape_string($connection, trim($_POST['end-date']));
    $disease = mysqli_real_escape_string($connection, trim($_POST['disease']));
    $Username = $_SESSION['currentUser'];
    
            ?>   



	<div class="container" id="certificate">
    <h4> SICK CERTIFICATE</h4>
    <div class="col-sm-10">
      <p align="left">Dear Sir/Madam,</p>
       <?php echo '<p align="left">I have seen '.$ptname.' '.$ptsurname.' on '.$strdate.' and found the patient to be suffering from '.$disease.'.</p>';?>
      <?php echo '<p align="left">'.$ptname.' '.$ptsurname.' can return to school/work on '.$enddate.''; ?>
      <p align="left">Regards</p>
      <?php     
      //get all data
    $query = "SELECT *
          FROM md_det
          Left JOIN person_title on person_title.ID = md_det.TITLE_ID
          WHERE USERNAME = '$Username'";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($md_det = mysqli_fetch_assoc($result)) {
      echo '<p align="left">' .$md_det['SHORTNAME'].' '.$md_det['NAME'].' '.$md_det['SURNAME'].'</p>';
      echo '<p align="left">Medical Register '.$md_det['REG_NUM'].'</p>';
    }?>
      <p><br/></p>
    </div> 
  <small><em>THIS SICK CERTIFICATE HAS BEEN GENERATED FROM eMedy.</em></small>
  </div>

 <div class="col-sm-12">
  <br/>
  <a href="sick-cert.php"><input type="button" class="btn btn-success" value="Go Back"></a>
  <input type="button" class="btn btn-success" onclick="printCertificate();" value="Print">
</div>


<script>
        function printCertificate() {
            const printContents = document.getElementById('certificate').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
 

<?php include_once('footer.php'); ?>