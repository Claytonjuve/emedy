<html>
<body>

<form method="post" action="md-home.php">
    <span>What are your favourite colours?</span><br/>
    <input type="checkbox" name='colour[]' value="Red"> Red <br/>
    <input type="checkbox" name='colour[]' value="Green"> Green <br/>
    <input type="checkbox" name='colour[]' value="Blue"> Blue <br/>
    <input type="checkbox" name='colour[]' value="Black"> Black <br/>
	<br/>
    <input type="submit" value="Submit" name="submit">
</form>

<?php
if(isset($_POST['submit'])){

    if(!empty($_POST['colour'])) {

        foreach($_POST['colour'] as $value){
            echo "Chosen colour : ".$value.'<br/>';
        }

    }

}
?>

</body>
</html>