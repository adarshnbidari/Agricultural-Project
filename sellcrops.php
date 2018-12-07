<?php
$db=mysqli_connect('localhost','root','belagaum@1998','agricultural_project');

if(isset($_SESSION['username'])){
	$usr=$_SESSION['username'];
}

/*$farmer_usr="SELECT * FROM users WHERE username='$usr';";
if($q=mysqli_query($db,$farmer_usr)){
	$details=mysqli_fetch_assoc($q);
	$id=$details['id'];
}
*/

if(isset($_GET['sellcrop'])){
	$update="UPDATE farmerdb SET sold_crops=sold_crops+1 WHERE id IN (SELECT id FROM users WHERE username='$usr');";
	if(mysqli_query($db,$update)){
		header("Location: sellcrops.html?sold");
	}
}


?>