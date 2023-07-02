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
<title>"HRI-Assign Asset"</title>
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
<form method="post" action="assign_asset.php">

<div style="overflow:auto">
  <div class="menu">
     <?php include("menus.php"); ?> 

</div>
<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B>Assign An Asset</B></div>
    <br />
    Now can assign an user as on requirement of any assets...
    <br /><br />
    <div style="overflow-x:auto;">


<table cellspacing="0" cellpadding="0"   border="0px solid"  class="table1">
  <tr><td colspan="4"><label><b>Assign Asset with Complete User Details:</b></label></td> </tr>
  <tr><td><label for="an_rec_date">Record Date:</label></td> <td colspan="3"><strong>
  <input type="date"  value="" name="an_rec_date" placeholder="Record Date" tabindex="1" /></strong></td></tr>
  <tr>
    <tr><td><label for="an_dept">Department:</label></td>      <td colspan="3"><strong>
            <select name="an_dept" tabindex="2" >
            <option selected value="">Department</option>
            <option value="Acedmic">Acedmic Dept</option>
            <option value="Library">Library Dept</option>
            <option value="Processor">Processor</option>
            <option value="Post_Doc">Post_Doc Student</option>
            <option value="Phd">Phd Student</option>
            <option value="Tech_Dept">Tech Dept</option>
            <option value="others">others</option>
        </select>
        </td>
        </tr>

    <td><label for="an_type">Asset Type:</label></td>  <td colspan="3"><strong>
            <select name="an_type" tabindex="3" >
            <option selected value="">ASSET TYPE</option>
            <option value="AIO">AIO</option>
            <option value="CPU">CPU</option>
            <option value="Mouse">Mouse</option>
            <option value="Desktop">Desktop</option>
            <option value="Keyboard">Keyboard</option>
            <option value="Printer">Printer</option>
            <option value="Scanner">Scanner</option>
            <option value="Server">Server</option>
        </select>
        </td>
        </tr>

        <tr><td><label for="an_make">Asset Make:</label></td>  <td colspan="3"><strong>
            <select name="an_make" tabindex="4" >
            <option selected value="">Brand/Make</option>
            <option value="HP">HP</option>
            <option value="HCL">HCL</option>
            <option value="IBM">IBM</option>
            <option value="DELL">DELL</option>
            <option value="ASUS">ASUS</option>
            <option value="i-Mac">i-Mac</option>
            <option value="Server I">Server I</option>
            <option value="Server II">Server II</option>
            <option value="Server III">Server III</option>
            </select>
        </td>
        </tr>
  <tr><td><label for="an_serial">Asset Serial No: </label></td> 
  <td colspan="3"><strong><input type="text"  value="" name="an_serial" placeholder="Asset serial code" tabindex="5" /></strong></td></tr>

  

  <tr><td><label for="an_name">User's Name:</label></td>
  <td colspan="3"><strong><input type="text"  value="" name="an_name" placeholder=" name of user" tabindex="6" /></strong></td></tr>
  <tr><td><label for="an_mobile">User's Contact: </label></td> 
  <td colspan="3"><strong><input type="text"  value="" name="an_mobile" placeholder=" mobile no of user" tabindex="7" /></strong></td></tr>

  <tr><td><label for="an_email">Mail - any:</label></td>
  <td colspan="3"><strong><input type="email"  value="" name="an_email" placeholder="mail id - if any" tabindex="8" /></strong></td></tr>

  <tr><td><label for="an_location">Current Location/Area:</label></td>
  <td colspan="3"><strong><input type="text"  value="" name="an_location" placeholder=" location" tabindex="9" /></strong></td></tr>

  <tr><td><label for="an_des">User info (any):</label></td>
  <td colspan="3"><strong><textarea id="msg" name="an_des" autocomplete="message" placeholder="Asset description" tabindex="10" ><?php echo stripcslashes($an_des); ?></textarea></strong></td>


	<tr><td><label >&nbsp;</label></td>
	<td colspan="3"><Button type="submit" name="asset_assign" tabindex="11" class="btn">Assign</button>  
	<Button type="reset" onclick="reset()"; class="btn" tabindex="11">Clear</Button></td></tr>


	</table>
	<label ><?php include('errors.php'); ?></label>
  </div>
</div>
</form>
<!-- MAIN PAGE WORK -->  
<div class="ftr_stl">© copyright Pk</div>



</body>
</html>

