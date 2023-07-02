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

require('data_db.php');
$srno=$_REQUEST['srno'];
$slt_query = "SELECT * from assign_asset WHERE srno='".$srno."'"; 
//echo $slt_query;
$result = mysqli_query($db, $slt_query) or die ( mysqli_error($db));
$rows = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="imgs/himslogo.png"  rel="shortcut icon">
<link href="css/stylenew.css" rel="stylesheet" type="text/css" />
<title>"HRI-ATS Edit Record"</title>
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

  <div class="menu">
  <?php include("menus.php"); ?> 
  </div>

<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B>RELEASE ASSET RECORD</B></div>

<div style="overflow-x:auto;">

  <div class="upcss">
  <p><b>Make release of asset from an user to CC. </b> </p>
  
  <div class="form">
  <?php
  $status = "";
  if(isset($_POST['new']) && $_POST['new']==1)
  {
    $srno = $_REQUEST['srno'];
    $an_rel_date = date("Y-m-d");
    $an_rel_des = $_REQUEST['an_rel_des'];
    $use_status = $_REQUEST['use_status'];

    $submittedby = $_SESSION["userid"];
    
    $update ="UPDATE assign_asset SET an_rel_des='".$an_rel_des."', an_rel_date='".$an_rel_date."', use_status='".$use_status."' WHERE srno='".$srno."'";

      mysqli_query($db, $update) or die(mysqli_error());
      $status = "Asset now Released to CC Dept. Successfully. </br></br><a href='asset_assign_status.php'>View Updated Record</a>";
      echo '<p style="color:#FF0000;">'.$status.'</p>';
      }else 
      {
    ?>

    <div>
   <form name="form" method="post" action="release_asset.php">
    <table cellpadding="5" border="0px solid" width="100%" >
      <tr><td style=" background-color:#e7efff; text-align:right;" > Asset Asssign ID:<input type="hidden" name="srno" required value="<?php echo $rows['srno'];?>" /></td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><?php echo $rows['srno']; ?></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >User Name :</td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><?php echo $rows['an_name']; ?></font></strong></td></tr>

      <tr><td style=" background-color:#e7efff; text-align:right;" > Asset Brand  :</td>
      <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><?php echo $rows['an_make']; ?></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >Serial No :</td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><?php echo $rows['an_serial']; ?></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >Serial No :</td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><?php echo $rows['an_serial']; ?></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >Asset Use Status :</td>
     <td style=" background-color:#e2e9f7;">&nbsp;<strong><font color="#0a4a82"> <select id="use_status" name="use_status" tabindex="1" >
        <option><?php echo $rows['use_status']; ?></option>
        <option value="Free">Release</option> </select></font></strong>
     </td></tr>
     <tr><td style=" background-color:#e7efff; text-align:right;" >Release any Description : </td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><textarea id="msg" name="an_rel_des" tabindex="7" ><?php echo $rows['an_rel_des']; ?></textarea></font></strong></td></tr>

     <tr><td style=" background-color: text-align:right;" >&nbsp; </td>
     <td><p><input name="submit" type="submit" value="Release" class="btn_edit" /></p> </td></tr>

    </table>
    <input type="hidden" name="new" value="1" />
    

  </form>
    <?php } ?>
    </div>

</div>
</div>
</div>
</div>
</div>
<!-- MAIN PAGE WORK -->  

<div class="ftr_stl">© copyright Pk</div>



</body>
</html>
