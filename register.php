<?php
session_start();

$error=0;

$db=mysqli_connect('localhost','root','belagaum@1998','agricultural_project');

if(isset($_POST['register'])){

$first=htmlspecialchars(mysqli_real_escape_string($db,$_POST['first']));
$last=htmlspecialchars(mysqli_real_escape_string($db,$_POST['last']));
$usr=htmlspecialchars(mysqli_real_escape_string($db,$_POST['usr']));
$pwd=htmlspecialchars(mysqli_real_escape_string($db,$_POST['pwd']));
$dob=htmlspecialchars(mysqli_real_escape_string($db,$_POST['date']));
$position=htmlspecialchars(mysqli_real_escape_string($db,$_POST['position']));

if($dob>1998){
	$error=1;
}

if($position==""){
	$error=1;
	echo "<script>alert('Pleasespecify your position!...');</script>";
}

$check="SELECT * FROM users WHERE username='$usr'";
$check_sql=mysqli_query($db,$check);
$check_rows=mysqli_num_rows($check_sql);
if($check_rows>0){
        $error=1;
        echo "
        <script>alert('the user already exists!...');</script>
        ";
}

if($error==0){
    $insert="INSERT INTO users (firstname,lastname,username,password,date_of_birth,position) values('$first','$last','$usr','$pwd','$dob','$position')";
    if(mysqli_query($db,$insert)){
        $_SESSION['firstname']=$first;
        $_SESSION['lastname']=$last;
        $_SESSION['username']=$usr;
        $_SESSION['password']=$pwd;
        $_SESSION['dob']=$dob;
        $_SESSION['position']=$position;
		

        if($position=='farmer'){
				
				
				$get_farmer_info="SELECT * FROM users WHERE username='$usr';";
				$sql_get_farmer_info=mysqli_query($db,$get_farmer_info);
				$farmer_info=mysqli_fetch_assoc($sql_get_farmer_info);
				$farmer_id=$farmer_info['id'];
				
				$insert_id="INSERT INTO farmerdb (id) VALUES('$farmer_id');";
				mysqli_query($db,$insert_id);
				
				$rand=mt_rand(1,200);
				
				$farmer_crop="UPDATE farmerdb SET crops='$rand' WHERE id='$farmer_id';";
				$sql_crop=mysqli_query($db,$farmer_crop);
				
				$labours=array();
				$labours=serialize($labours);
				$farmer_labours="UPDATE farmerdb SET labours='$labours' WHERE id='$farmer_id';";
				mysqli_query($db,$farmer_labours);
			
            header("Location: farmerhome.html");
        }

        if($position=='labour'){
			
			if(isset($_SESSION['firstname'])){
				$get_id="SELECT * FROM users WHERE firstname='$first' LIMIT 1;";
				$sql_get_id=mysqli_query($db,$get_id);
				$fetch_id=mysqli_fetch_assoc($sql_get_id);
				$id=$fetch_id['id'];
			
			$insert_id="INSERT INTO labourdb(id) values('$id');";
			mysqli_query($db,$insert_id);
			}
			
            header("Location: labourhome.html");
        }

    }
}

}

?>