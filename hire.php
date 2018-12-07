<?php

$db=mysqli_connect('localhost','root','belagaum@1998','agricultural_project');

if(isset($_SESSION['username'])){
	$usr=$_SESSION['username'];
}

$farmer_det="SELECT * FROM users WHERE username='$usr';";
$sql_farmer_det=mysqli_query($db,$farmer_det);
$get_id=mysqli_fetch_assoc($sql_farmer_det);
$farmer_id=$get_id['id'];


$error=0;

if(isset($_POST['hire'])){
	
	$uname=$_POST['firsthire'];
	
	$check_avail="SELECT * FROM labourdb WHERE id IN (SELECT id
	FROM users WHERE username='$uname');";
	$check_sql=mysqli_query($db,$check_avail);
	$res=mysqli_fetch_assoc($check_sql);
	if($res['job']===1){
		$error=1;
		header("Location: hire.html?no");
	}
	
	
	
	if($error==0){
	$labour_job="UPDATE labourdb SET job=true WHERE id IN ( SELECT id 
	FROM users WHERE username='$uname');";
	$sql_labour_job=mysqli_query($db,$labour_job);
	
	$get_labours="SELECT * FROM farmerdb WHERE id='$farmer_id';";
	$get_labours_sql=mysqli_query($db,$get_labours);
	$get_labour_details=mysqli_fetch_assoc($get_labours_sql);
	$farmer_data=$get_labour_details['labours'];
	$unl=unserialize($farmer_data);
	array_push($unl,$uname);
	$snl=serialize($unl);
	
	$farmer_labour="UPDATE farmerdb SET labours='$snl' WHERE id='$farmer_id';";
	if(mysqli_query($db,$farmer_labour)){
		header("Location: hire.html?hired");
	}
	}
}

?>