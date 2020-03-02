<?php
require_once 'niravcon.php';

if($_POST) {
	$email = $_POST['email'];
	$url   = $_POST['url'];
 	$mobilenumber = $_POST['mobilenumber'];
 	$editcheck = $_POST['editcheck'];
	$sql="insert into mplvisitingcard values('$email','$url','$mobilenumber','$editcheck')";
 if($connect->query($sql)===TRUE) {
 		echo "<p>New Record Successfully Created</p>";
  }
	else 
	{
		echo "not inserted";
	}

}
 ?>
