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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="imgs/himslogo.png"  rel="shortcut icon">
<link href="css/stylenew.css" rel="stylesheet" type="text/css" />
<title>"ITS Contact"</title>
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
<?php include("menus.php"); ?> 
</div>
<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B> TEAM CONTACT</B></div>

  <div class="container">
    <form name="search" method="post" action="searchdata.php">
    <!-- Jumbotron Header -->
       <div class="card my-4">
          <h5 class="card-header">Search User By Name/Contact Number</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" id="search-box" name="searchdata" placeholder="Search by name / mobile " required="true">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Search!</button>
                <br /> <br />
              </span>
            </div>
          </div>
        </div>
    </form>



	


<?php 
$ret=mysqli_query($db,"SELECT * from users_record where (uname like '$sdata%'|| umobile like '$sdata%') order by id  limit 3 ");

$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

	<div class="contentcss">
	<div class="transboxcss">
	 <H2>USER ID: <?php  echo $row['id'];?>  </H2>
	 <!-- div class="u_img"> <img src="css/def/usrslogo.png" alt="Avatar" style="width:100px; border-radius: 50%;"></div -->
   <!-- div class="u_img"><?php echo '<img src="' .'profile_img/'.$row['img_name']. '" style= "width:100px; border-radius: 50%">'; ?> </div -->
	 <img src ="css/def/usr_headlogo.png" width="3%" height="auto" />&nbsp; <?php  echo $row['uname'];?> <br /><br />
	 <img src ="css/def/tellogo.png" width="3%" height="auto" />&nbsp; Tel: 1111 &nbsp; &nbsp; &nbsp; &nbsp; 
	 <img src ="css/def/moblogo.png" width="3%" height="auto" />&nbsp; <?php  echo $row['umobile'];?> <br /><br />
	 <img src ="css/def/mail.png" width="4%" height="auto" />&nbsp; <?php  echo $row['uemail'];?><br /><br />
   <img src ="css/def/deptlogo.png" width="4%" height="auto" />&nbsp; <?php  echo $row['udept'];?><br /><br />
		</div>
    </div>
     <?php } }?>


</div>

</div>



<!-- MAIN PAGE WORK -->  

<div class="ftr_stl">© copyright Pk</div>
</div>
</body>
</html>
