<?php include_once('header.php'); ?>
  <?php //show error 
              if(isset($_SESSION['Error'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['Error'].'</div>';
                            unset($_SESSION['Error']);
              
              }
            ?>   
    <input type="button" id = "btnAdd" onclick = "AddDropDownList()" value = "Add DropDownList" />
    <hr />
    <div id = "dvContainer"></div>
    <script type="text/javascript">
        function AddDropDownList() {
            //Build an array containing Customer records.
            var customers = [
                { CustomerId: 1, Name: "John Hammond", Country: "United States" },
                { CustomerId: 2, Name: "Mudassar Khan", Country: "India" },
                { CustomerId: 3, Name: "Suzanne Mathews", Country: "France" },
                { CustomerId: 4, Name: "Robert Schidner", Country: "Russia" }
            ];
            //Create a DropDownList element.
            var ddlCustomers = document.createElement("SELECT");

            //Add the Options to the DropDownList.
            for (var i = 0; i < customers.length; i++) {
                var option = document.createElement("OPTION");

                //Set Customer Name in Text part.
                option.innerHTML = customers[i].Name;

                //Set CustomerId in Value part.
                option.value = customers[i].CustomerId;

                //Add the Option element to DropDownList.
                ddlCustomers.options.add(option);
            }

            //Reference the container DIV.
            var dvContainer = document.getElementById("dvContainer")

            //Add the DropDownList to DIV.
            var div = document.createElement("DIV");
            div.appendChild(ddlCustomers);

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
        };
    </script>
<?php include_once('footer.php'); ?>