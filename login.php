<?php
session_start();

$error=0;

$db=mysqli_connect('localhost','root','','agricultural_project');

if(isset($_POST['login'])){
	
$usr=htmlspecialchars(mysqli_real_escape_string($db,$_POST['usr']));
$pwd=htmlspecialchars(mysqli_real_escape_string($db,$_POST['pwd']));

$check_user="SELECT * FROM users WHERE username='$usr';";
$check_conn=mysqli_query($db,$check_user);
$check_res=mysqli_num_rows($check_conn);
$fetch=mysqli_fetch_assoc($check_conn);
	if($check_res<1){
		$error=1;
		echo "
		<script>alert('User doesnt exists!..');</script>
		";
	}
	if($check_res>0){
		if($fetch['password']!=$pwd){
			$error=1;
			echo "
			<script>
			alert('Invalid username/password');
			</script>
			";
		}
	}
	
	if($error==0){
		$_SESSION['username']=$usr;
		$_SESSION['password']=$pwd;
		$_SESSION['firstname']=$fetch['firstname'];
		$_SESSION['lastname']=$fetch['lastname'];
		$_SESSION['dob']=$fetch['date_of_birth'];
		$_SESSION['position']=$fetch['position'];
		
		if($fetch['position']=='farmer'){
			 header("Location: farmerhome.html");
		}
		
		if($fetch['position']=='labour'){
			header("Location: labourhome.html");
		}
		
	}
}

?>