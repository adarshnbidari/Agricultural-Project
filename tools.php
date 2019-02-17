<?php

 $db=mysqli_connect("localhost","root","","agricultural_project");
 
 $error=0;
 
 if(isset($_POST['bid'])){
	 $bid=htmlspecialchars(mysqli_real_escape_string($db,$_POST['amount']));
	 $bid=trim($bid);

	if(empty($bid)){
		$error=1;
	}
	
	if(isset($_SESSION['firstname'])){
		$first=$_SESSION['firstname'];
	}
	
	$get_id="SELECT id FROM users WHERE firstname='$first' LIMIT 1;";
	$sql_get_id=mysqli_query($db,$get_id);
	$id_details=mysqli_fetch_row($sql_get_id);
	$id=$id_details[0];
	
	$insert_bid="UPDATE labourdb SET bid='$bid' WHERE id='$id';";
	if(mysqli_query($db,$insert_bid)){
		echo "
		<script>
		alert('Your bid has been successfully placed!...');
		</script>
		";
	}
		
}
	
?>