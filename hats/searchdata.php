<?php 
  session_start(); 
  error_reporting(0);
  include('data_db.php');
  if (!isset($_SESSION['userid'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['userid']);
  	header("location: login.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="imgs/himslogo.png"  rel="shortcut icon">
<link href="css/stylenew.css" rel="stylesheet" type="text/css" />
<title>"ITS Contact Search"</title>
<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
document.getElementById('ct').innerHTML = x;
display_c();
 }
</script>

</head>
<body style="font-family:Verdana;color:#03103c" onload=display_ct();>
<div class="hdr_stl">
 <!-- TOP PAGE -HEADER START -->
<div style="overflow:hidden"> 
<div class="img_left"> <!-- LOGO -->
 <a href="index.php" name="index" ><img src="imgs/himslogo.png"  id="img2" /></a>

</div>

<div class="title_head">
  <font face="Imprint MT Shadow, Arial, Helvetica, sans-serif">HRI - ASSET TRAKING SYSTEM </font> 

</div>

<div class="img_right"> 
  IP Address:<strong><font color="#0a4a82" size="+1"><?php $ip = getHostByName(getHostName()); echo $ip; ?> </font></strong>
 <!-- Profile Image -->
<?php
        include_once('data_db.php');
        $result=mysqli_query($db,"SELECT * from users_new where userid = '".$_SESSION['userid']."'");
        while($row=mysqli_fetch_assoc($result))
{ $imageURL = 'profile_img/'.$row["img_name"];
?> 
        <img src="<?php echo $imageURL; ?>" alt="" id="img1"  />
<?php 
}
?>


</div>
</div>
<div class="row">
 <div style="overflow:hidden">
 <div class="user_name">
  <?php  if (isset($_SESSION['userid'])) : ?>Welcome: <strong><font color="#0a4a82" size="+1"> <?php echo $_SESSION['userid']; ?></font></strong>
</div>

<div class="main_time">
  <font size="2" face="Arial, Helvetica, sans-serif" style="opacity: 0.7;"><b> <span id='ct' ></span></b></font>
</div>

<div class="right_session">
  <font size="+2"><b><a href="index.php?logout='1'" title="close session" class="btn style1" style=" text-decoration:none;">&nbsp;Logout&nbsp; </a> </b></font>
<?php endif ?>
</div>

<hr class="newhr1" noshade>
<marquee scrollamount="4" behavior="alternate" > <font  size="4" color="#005cad"> <b>STATEMENT:</b> ALL ASSETS AT A GLANCE.</font></marquee>
</div>
</div>
 <!-- TOP PAGE -HEADER END -->
 
<!-- LEFT MENU PAGE -->
<div style="overflow:auto">
  <div class="menu">
      <a href="create_record.php" name="abc_link" class="url_hit" id="menuid"  tabindex="1" > Create Inventory (A.T.S.)</a>
      <a href="index.php" name="abc_link" class="url_hit"  id="menuid" tabindex="2" > A.T.S. Stock Status</a>
      <a href="ats_update.php" name="abc_link" class="url_hit"  id="menuid" tabindex="3" > Update/Edit A.T.S.</a>
      <a href="ats_remove.php" name="abc_link" class="url_hit"  id="menuid" tabindex="4" > Remove A.T.S.</a>
      <a href="assign_asset.php" name="abc_link" class="url_hit"  id="menuid" tabindex="5" > Manage A.T.S.</a>      
      <a href="users_record.php" name="abc_link" class="url_hit"  id="menuid" tabindex="6" > Generate new user</a>
      <a href="users_record_update.php" name="abc_link" class="url_hit"  id="menuid" tabindex="7" > Update/Edit Records</a>
      <a href="users_record_details.php" name="abc_link" class="url_hit"  id="menuid" tabindex="8" > User Records Status</a>
      <a href="user_contact.php" name="abc_link" class="url_hit"   id="menuid" tabindex="9"> User's Contact</a>
 
</div>
<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B> TEAM CONTACT</B></div>

  <div class="container">
  	
  <div style="overflow-x:unset ">

<?php 
$sdata=$_POST['searchdata']; 
?>
  <h4 align="LEFT" style="color:red">Contact result against "<?php echo $sdata;?>" keyword <button class="btn btn-secondary" onclick="history.go(-1);">Go Back </button></h4> 
  
<?php
$ret=mysqli_query($db,"SELECT * from users_record where (uname like '%$sdata%'|| umobile like '%$sdata%') and (Status=1)");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

	<div class="contentcss">
	<div class="transboxcss">
	 <H2>TEAM HEAD </H2>
	 <!-- div class="u_img"><img src="" alt="Avatar" style= "width:100px; border-radius: 50%"; /></div -->

   <!-- div class="u_img"><?php echo '<img src="' .'profile_img/'.$row['img_name']. '" style= "width:100px; border-radius: 50%">'; ?> </div -->
	 <img src ="css/def/usr_headlogo.png" width="3%" height="auto" />&nbsp; <?php  echo $row['uname'];?> <br /><br />
	 <img src ="css/def/tellogo.png" width="3%" height="auto" />&nbsp; Tel: 1111  
	 <img src ="css/def/moblogo.png" width="3%" height="auto" />&nbsp; <?php  echo $row['umobile'];?> <br /><br />
	 <img src ="css/def/mail.png" width="4%" height="auto" />&nbsp; <?php  echo $row['uemail'];?><br /><br />
   <img src ="css/def/deptlogo.png" width="4%" height="auto" />&nbsp; <?php  echo $row['udept'];?><br /><br />
		</div>
    </div>
 <?php }  } else { ?>
</div>
<h4 class="card-title" align="center">No Result found against this search</h4>
</div>

<?php } ?>
<!-- MAIN PAGE WORK -->  
  </div>
 </div>
  </div>
 </div>
 


<div class="ftr_stl">© copyright Pk</div>

</body>
</html>
