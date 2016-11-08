<?php
require '../core/init.php';
$general->logged_out_protect();

$id = $_GET['id'];
$designer_id   = htmlentities($user['id']);
$view_messages = $chartforum->list_messages($id);


if(isset($_POST['submit'])){

$message   = htmlentities($_POST['message']);
$category  = htmlentities($_POST['category']);

$edit_message = $chartforum->edit_data($designer_id,$message,$category);
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

<?php foreach ($view_messages as $row ) {?>
<select name= "category" class="form-control">
    <option selected="selected" value="<?php echo $row["categgory"]; ?>"><?php echo $row['category']; ?></option>
    <option value="Design"> Design </option>
    <option value="Business"> Business </option>
    </select>
    <br><br>

<label>Your Query</label>
<textarea id="textarea" name="message" ><?php echo $row['message']; ?></textarea>
<br><br>
<button type="submit" name="submit" class="btn bg-blue btn-block">submit</button>					

<?php }?>
</form>
                  
</body>
</html>