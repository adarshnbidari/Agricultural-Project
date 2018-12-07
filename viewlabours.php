<?php

$db=mysqli_connect("localhost","root","belagaum@1998","agricultural_project");

$get_details="SELECT * FROM labours_info";
$sql_get_details=mysqli_query($db,$get_details);


while($labours=$sql_get_details->fetch_array()){
	$firstname=$labours['firstname'];
	$job=$labours['job'];
	$bid=$labours['bid'];
	$rating=$labours['rating'];
	
	$labour_fetch="SELECT * FROM users WHERE firstname='$firstname';";
	$sql=mysqli_query($db,$labour_fetch);
	$details=mysqli_fetch_assoc($sql);
	$usr=$details['username'];
	
	
	$bid=$labours['bid'];
	$rating=$labours['rating'];
	if($job==true){
		$stat="hired";
	}
	if($job==false){
		$stat="hire";
	}
 echo "
 <span id='labourinfobox'>
<span class='firstname' name='usr'>Name</br>$usr</span>
<span class='job'>Job</br>$job</span>
<span class='bid'>Bid</br>$bid</span>
<span class='rating'>Rating</br>$rating</span>";
if($stat=="hire"){
	echo "<button onclick='showalert()' id='rating'>$stat</button>";
}
if($stat=="hired"){
	echo "<button id='rating'>$stat</button>";
}
"</span>
 ";
}

?>