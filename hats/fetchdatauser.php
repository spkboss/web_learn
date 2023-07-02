<?php
ini_set('display_errors',1);

include 'con_db.php';
$con= dbcon();
$n = $_POST["x"];
$sql="selct * from users_record WHERE uname={$n}";
$result= mysqli_query($con, $sql);
while($rows = mysqli_fetch_array($result)){

	$data['mobileno'] = $rows["umobile"];
	$data['emailid'] = $rows["uemail"];
}
echo  json_encode($data);

?>