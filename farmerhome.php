<?php

session_start();

if(isset($_POST['logout'])){
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['dob']);
unset($_SESSION['position']);
session_destroy();
header("Location: index.html");
}

if(!isset($_SESSION['firstname'])){
	session_destroy();
	session_unset();
	header("Location: index.html");
}
if(!isset($_SESSION['lastname'])){
	session_destroy();
	header("Location: index.html");
}
if(!isset($_SESSION['username'])){
	session_destroy();
	header("Location: index.html");
}
if(!isset($_SESSION['password'])){
	session_destroy();
header("Location: index.html");
}
if(!isset($_SESSION['dob'])){
	session_destroy();
	header("Location: index.html");
}
if(!isset($_SESSION['position'])){
	session_destroy();
	header("Location: index.html");
}

$conn=mysqli_connect('localhost','root','','agricultural_project');

if(isset($_SESSION['username'])){
	$f_usr=$_SESSION['username'];
}

$f_id="SELECT * FROM users WHERE username='$f_usr';";
$sql_f_id=mysqli_query($conn,$f_id);
$id=mysqli_fetch_assoc($sql_f_id);
$farmer_id=$id['id'];

$check_labour_info="SELECT * FROM farmerdb WHERE id='$farmer_id';";
$check_labour=mysqli_query($conn,$check_labour_info);
$num_labour=mysqli_num_rows($check_labour);
if($num_labour!=null){
	$hired_labours=mysqli_fetch_assoc($check_labour);
	$us_labours=$hired_labours['labours'];
	$us_labours=unserialize($us_labours);
	foreach($us_labours as $labours){
		$labour_first="SELECT * FROM users WHERE username='$labours';";
		$sql_labour_first=mysqli_query($conn,$labour_first);
		$labour_details=mysqli_fetch_assoc($sql_labour_first);
		if($labour_id=$labour_details['id']){
			$labour_job="SELECT * FROM labourdb WHERE id='$labour_id';";
			$labour_conn=mysqli_query($conn,$labour_conn);
			$job=$labour_conn['job'];
			if($job==false){
				if(($update_labour=array_search($labours,$us_labours))!==false){
					unset($us_labours[$update_labour]);
						$labour_arr=array_values($us_labours);
						$labour_arr=serialize($labour_arr);
						$update_farmer="UPDATE farmerdb SET labours='$labour_arr' WHERE id='$farmer_id';";
						if(mysqli_query($conn,$update_farmer)){
							mysqli_close($conn);
						}
				}
			}
		}
	}
}

?>