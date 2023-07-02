<?php
  session_start();

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
<title>"HRI-ATS"</title>
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
<body style="font-family:Verdana;color:#0a6182" onload=display_ct();>

<div class="hdr_stl">
 <!-- TOP PAGE -HEADER START -->
<div style="overflow:hidden"> 
<div class="img_left">
 <a href="index.php" name="index" ><img src="imgs/himslogo.png"  id="img2" /></a>

</div>

<div class="title_head">
  <font face="Imprint MT Shadow, Arial, Helvetica, sans-serif" >HRI - ASSET TRAKING SYSTEM </font> 

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
<form method="post" action="users_record.php">
<div style="overflow:auto">
  <div class="menu">
<?php include("menus.php"); ?> 
  
</div>
<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B>USER'S RECORD CREATION</B></div>
    <br />
    Create record for all users with each asset details as per uses...
    <br />  <br />
<div style="overflow-x:auto;">
<table cellspacing="0" cellpadding="0"   border="0px solid"  class="table1">

 <tr><td><label for="udept">User's Department Type:</label></td>      <td colspan="3"><strong>
    <select name="udept" tabindex="1" >
            <option selected value="">Department</option>
            <option value="Acedmic">Acedmic Dept</option>
            <option value="Library">Library Dept</option>
            <option value="Processor">Processor</option>
            <option value="Post_Doc">Post_Doc Student</option>
            <option value="Phd">Phd Student</option>
            <option value="Tech_Dept">Tech Dept</option>
            <option value="Visitor">Visitor</option>
    </select>
        </td>
        </tr>
	<tr><td><label for="uname">User Name :</label></td> 
  <td colspan="3"><strong><input type="text"  value="" name="uname" placeholder=" user name" tabindex="2" /></strong></td></tr>

	<tr><td><label for="umobile">User Contact: </label></td> 
  <td colspan="3"><strong><input type="text"  value="" name="umobile" placeholder=" mobile no of user" tabindex="3" /></strong></td></tr>

	<tr><td><label for="uemail">Mail - any:</label></td>
  <td colspan="3"><strong><input type="email"  value="" name="uemail" placeholder="mail id - if any" tabindex="4" /></strong></td></tr>

	<tr><td><label for="ulocation">Current Location/Area:</label></td>
  <td colspan="3"><strong><input type="text"  value="" name="ulocation" placeholder=" location" tabindex="5" /></strong></td></tr>

	
	<tr><td><label for="udes">User info (any):</label></td>
	<td colspan="3"><strong><textarea id="msg" name="udes" autocomplete="message" placeholder="user's any other information" tabindex="8" ><?php echo stripcslashes($udes); ?></textarea></strong></td>

	<tr><td><label >&nbsp;</label></td>
	<td colspan="3"><Button type="submit" name="uats_submit" tabindex="9" class="btn">Save</button>  
	<Button type="reset" onclick="reset()"; class="btn" tabindex="10">Clear</Button></td></tr>

	</table>
	<label ><?php include('errors.php'); ?></label>
  </div>
</div>
</form>
<!-- MAIN PAGE WORK -->  
<div class="ftr_stl">© copyright Pk</div>



</body>
</html>
