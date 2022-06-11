<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   


<form action="process-data/add-prescription-process.php" method="POST" id="form">
	<div class="container">
<h6>Retreive a patient username</h6>
  <div class="form-group row">
    <label for="ptSearch" class="col-sm-2 col-form-label">Search Patient</label>
    <div class="col-sm-9">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="ptSearch" name="ptSearch" placeholder="Enter MD Reg num" style="width: 100%" tabindex="-1" aria-hidden="true" onchange="ShowPtDetails()" required>
     <option value="" data-select2-id="select2-data-141-mcra"></option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT patient.*, person_title.SHORTNAME, person_title.ID
          FROM patient
          join person_title on person_title.ID = patient.TITLE
        ";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($pt_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$pt_det['PATIENT_ID'].'_'.$pt_det['NAME'].'_'.$pt_det['SURNAME'].'_'.$pt_det['EMAIL'].'_'.$pt_det['CONTACT_NO'].'_'.$pt_det['ID'].'_'.$pt_det['SHORTNAME'].'" data-select2-id="select2-data-141-mcra">'.$pt_det['PATIENT_ID'].' - '.$pt_det['SHORTNAME'].' '.$pt_det['NAME'].' '.$pt_det['SURNAME'].'</option>';
    }
    ?>


  </select>




    </div>
    <button type="submit" class="btn btn-success">Search</button>
  </div>
</div>
<div class="row"></div>
<div class="container">
<hr/>
<h6>Patient does not exists in the system or Patient's details are incorrect? <span class="text-danger">Click <a href="pt-det-edit.php">here</a> to add a new patient</span></h6>
  <div class="form-group row">
    <label for="ptSurname" class="col-sm-2 col-form-label">Surname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptSurname" name="ptSurname" placeholder="Surname" readonly>
    </div>
  </div>
    <div class="form-group row">
    <label for="ptName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptName" name="ptName" placeholder="Name" readonly>
    </div>
  </div>
      <div class="form-group row">
    <label for="ptId" class="col-sm-2 col-form-label">ID Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptId" name="ptId" placeholder="ID Card" readonly>
    </div>
  </div>
    <div class="form-group row">
    <label for="ptEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="ptEmail" name="ptEmail" placeholder="Email" readonly>
    </div>
  </div>
   <div class="form-group row">
    <label for="ptTel" class="col-sm-2 col-form-label">Contact Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ptTel" name="ptTel" placeholder="Contact Number" readonly>
    </div>
  </div>
 <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
<div class="col-sm-10">
<select  id="ptTitle" name="ptTitle" placeholder="ptTitle" style="width: 100%" tabindex="-1" aria-hidden="true" disabled> <!--class="custom-select" -->
     <option value=""></option>
           <?php
      //get a connection to the databases
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all person title
    $query = "SELECT *
          FROM person_title
          ORDER BY SHORTNAME ASC";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($title = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$title['ID'].'data-select2-id="select2-data-141-mcra">'.$title['SHORTNAME'].'</option>';
    }
    ?>
  </select>
</div>
</div>


<h6>Choose the required drug/s</h6>
  <div class="form-group row">
    <div class="col-sm-6">
    
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="drugSearch" name="drugSearch" placeholder="Search Drug" style="width: 100%" tabindex="-1" aria-hidden="true" required>
     <option value="" data-select2-id="select2-data-141-mcra">Search Drug</option>
           <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM drug";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($drug_det = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$drug_det['ID'].'" data-select2-id="select2-data-141-mcra">'.$drug_det['ID'].' - '.$drug_det['NAME'].' '.$drug_det['DOSAGE'].'</option>';
    }
    ?>


  </select>

</div>
<div class="col-md-3">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="usage" name="usage" placeholder="Drug Usage" style="width: 100%" tabindex="-1" aria-hidden="true" required>
<option value="" data-select2-id="select2-data-141-mcra">Usage</option>
      <?php
      //get a connection to the database
    require_once('process-data/connect_db.php');

      $connection = OpenCon();
    
    //get all data
    $query = "SELECT *
          FROM usage_dai";
    $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
    
    //show in the table
    while($usage = mysqli_fetch_assoc($result)) {
      echo '<option value="'.$usage['ID'].'" data-select2-id="select2-data-141-mcra">'.$usage['TIMES'].'</option>';
    }
    ?>
</select>
 </div> 

<div class="col-md-2">
<select class="type-dropdown control-label select2-hidden-accessible col-sm-6" id="duration" name="duration" placeholder="Days" style="width: 100%" tabindex="-1" aria-hidden="true" required>
<option value="" data-select2-id="select2-data-141-mcra">Days</option>
</select>
</div>
<div class="col-md-1">
 <input type="button" class="btn btn-success" id = "btnAdd" onclick="AddDropDownList()" value = "Add DropDownList" />
</div>
<div id = "dvContainer">
  
</div>
</div>

  <input type="submit" class="btn btn-success" value="Submit">
</div>



</form>


  <script type="text/javascript"> //extracts patients details
    function ShowPtDetails(){
    var ptId = document.getElementById('ptSearch').value.split('_')[0].split('_')[0]; //extracts data
    var ptName = document.getElementById('ptSearch').value.split('_')[1].split('_')[0]; 
    var ptSurname = document.getElementById('ptSearch').value.split('_')[2].split('_')[0]; 
    var ptEmail = document.getElementById('ptSearch').value.split('_')[3].split('_')[0]; 
    var ptTel = document.getElementById('ptSearch').value.split('_')[4].split('_')[0]; 
    var ptTitleValue = document.getElementById('ptSearch').value.split('_')[5].split('_')[0]; 
    
        document.getElementById("ptId").value = ptId; //populate  data
        document.getElementById("ptName").value = ptName; 
        document.getElementById("ptSurname").value = ptSurname; 
        document.getElementById("ptTel").value = ptTel; 
        document.getElementById("ptEmail").value = ptEmail;
        document.getElementById("ptTitle").selectedIndex = ptTitleValue;
        
   }


    //populate days in duration dropdown
    var duration = document.getElementById("duration");
    var contents;

    for (let i = 1; i <= 100; i++) {
    contents += "<option value="+i+">" + i + "</option>";
    }

    duration.innerHTML = "<option>Days</option>" + contents;



    //create new prescription row
      function AddDropDownList() {
            //Build an array containing Drug records.
            var Drugs = [

  <?php
          //get a connection to the database
          require_once('process-data/connect_db.php');

          $connection = OpenCon();
        
        //get all data
        $query = "SELECT *
              FROM drug";
        $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
        
        //show in the table
        while($drug_det = mysqli_fetch_assoc($result)) {
          echo '{ DrugId: '.$drug_det['ID'].', Name:" '.$drug_det['NAME'].' - '.$drug_det['DOSAGE'].'" },';
                
        }
?>              


            ];
            //Create a DropDownList element.
            const ddlDrugs = document.createElement("SELECT");

            //add classes to dropdown
            ddlDrugs.classList.add('type-dropdown', 'control-label',  'col-sm-6');

            //Add the Options to the DropDownList.
            for (var i = 0; i < Drugs.length; i++) {
                var option = document.createElement("OPTION");

                //Set Drug Name in Text part.
                option.innerHTML = Drugs[i].Name;

                //Set DrugId in Value part.
                option.value = Drugs[i].DrugId;

                //set drugSearch as option name
                option.name = 'drugSearch';

                //Add the Option element to DropDownList.
                ddlDrugs.options.add(option);
            }



            /* ********************************** */

             //Build an array containing usage records.
            var Usage = [

  <?php
          //get a connection to the database
          require_once('process-data/connect_db.php');

          $connection = OpenCon();
        
        //get all data
        $query = "SELECT *
              FROM usage_dai";
        $result = mysqli_query($connection, $query) or die("Error in query: " . mysqli_error($connection));
        
        //show in the table
        while($usage = mysqli_fetch_assoc($result)) {
          echo '{ UsageId: '.$usage['ID'].', Name:" '.$usage['TIMES'].'" },';
                
        }
?>              


            ];
            //Create a DropDownList element.
            const ddlUsage = document.createElement("SELECT");

            //add classes to dropdown
            ddlUsage.classList.add('type-dropdown', 'control-label',  'col-sm-6');

            //set id attribute
            ddlUsage.setAttribute("name", "usage".[i]);

            //Add the Options to the DropDownList.
            for (var i = 0; i < Usage.length; i++) {
                var option = document.createElement("OPTION");

                //Set usage Name in Text part.
                option.innerHTML = Usage[i].Name;

                //Set UsageId in Value part.
                option.value = Usage[i].UsageId;
                
                //Add the Option element to DropDownList.
                ddlUsage.options.add(option);
            }

            /* ********************************** */ 


            //Create a DropDownList element.
            const ddlDays = document.createElement("SELECT");

            //add classes to dropdown
            ddlDays.classList.add('type-dropdown', 'control-label',  'col-sm-6');

            //set id attribute
            ddlDays.setAttribute("id", "duration");



            /* *************************************/

            //Reference the container DIV.
            var dvContainer = document.getElementById("dvContainer")

            //Add the DropDownList to DIV.
            var div = document.createElement("DIV");
            div.appendChild(ddlDrugs);
            div.appendChild(ddlUsage);
            div.appendChild(ddlDays);

            //Create a Remove Button.
            var btnRemove = document.createElement("INPUT");
            btnRemove.value = "Remove";
            btnRemove.type = "button";
            btnRemove.onclick = function () {
                dvContainer.removeChild(this.parentNode);
            };

            //Add the Remove Buttton to DIV.
            div.appendChild(btnRemove);

            //Add the DIV to the container DIV.
            dvContainer.appendChild(div);


    </script>




 


<?php include_once('footer.php'); ?>