<?php
require '../core/init.php';

if(isset($_POST['submit'])){

//$general->logged_out_protect();
$id   = $_GET['designer_id']; // storing the user's username after clearning for any html tags.

$message   = htmlentities('query');
$category  = htmlentities('category');

$insert_message = $chartforum->insert_data($desiger_id,$message,$category);
header('Location:list_messages.php');


}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form method="post" action="">

<select name= "category" class="form-control">
    <option> - Select - </option>
    <option value="Design"> Design </option>
    <option value="Business"> Business </option>
    </select>
    <br><br>

<label>Your Query</label>
<textarea id="textarea" name="message" required=""></textarea>
<br><br>
<button type="submit" name="submit" class="btn bg-blue btn-block">send</button>					


</form>
                  
</body>
</html>