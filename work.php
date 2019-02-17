<?php

$db=mysqli_connect('localhost','root','','agricultural_project');


if(isset($_SESSION['username'])){
	$usr=$_SESSION['username'];
}

$rate=mt_rand(0,5);


if(isset($_POST['complete'])){
$job1="UPDATE labourdb SET job=false WHERE id IN(SELECT id FROM users WHERE username='$usr');";
$job2="UPDATE labourdb SET rating='$rate' WHERE id IN(SELECT id FROM users WHERE username='$usr')";
mysqli_query($db,$job1);

if(mysqli_query($db,$job2)){
	header("Location: work.html?completed");
}
}
?>