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
<div class="img_left"> <!-- LOGO -->
<img src="imgs/himslogo.png"  id="img2" />
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
<form method="post" action="ims_remove.php">
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
      <a href=" # " name="abc_link" class="url_hit"   id="menuid" tabindex="9"> Contact Info</a>
 
</div>

<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B>HRI-AMS UPDATE ASSET </B></div>
  
     Update/Edit/Remove data of asset ...
	
<div style="overflow-x:auto;">
<table cellspacing="0" cellpadding="0" WIDTH="100%">
  <tr>
    <td>
      <table cellspacing="2" cellpadding="10" border="0" width="100%"  >
      <tr style="color:white; background-color:grey;  border-collapse: collapse;">
      <th WIDTH="5%">Asset ID</th>
      <th WIDTH="10%">Asset Date (Record)</th>
      <th WIDTH="10%">Asset Name/Model</th>
      <th WIDTH="10%">Brand</th>
      <th WIDTH="10%">Asset Serial</th>
      <th WIDTH="10%">Bar Code</th>
      <th WIDTH="30%">Description</th>
      <th WIDTH="5%">Total Quantity</th>
      <th WIDTH="10%">Delete Record</th>

      </tr>
       </table>
    </td>
  </tr>
	<tr>
    <td>
    <div class="tbldiv">
    <table cellspacing="0" cellpadding="1" border="1" class="table2" >
        
       <?php
      include_once('data_db.php');
      $result=mysqli_query($db,"SELECT * from asset_record;");
      while($row=mysqli_fetch_assoc($result))
      {
      
      echo "<tr>";
      echo"<td WIDTH=5%><strong><font size=3> <center>".$row['srno']. "</center></font></strong></td>";
      echo"<td WIDTH=10%><strong> <font size=2>".$row['rec_date']. "</font></strong> </td>";
      echo"<td WIDTH=10%><strong> <font size=2>".$row['aname']. "</font></strong> </td>";
      echo"<td WIDTH=10%><strong> <font size=2>".$row['amake']. "</font></strong> </td>";
      echo"<td WIDTH=10%><strong> <font size=2>".$row['aserial']. "</font></strong> </td>";
      echo"<td WIDTH=10%><strong> <font size=2>".$row['abar']. "</font></strong> </td>";
      echo"<td WIDTH=30%><strong> <font size=2>".$row['asset_des']. "</font></strong> </td>";
      echo"<td WIDTH=5%><strong> <font size=2>".$row['quantity_total']. "</font></strong> </td>";

      echo'<td WIDTH=10% style="text-align:center">
           <form action="" method="POST">
           <a href="ats_edit.php?srno=<?php echo $row["srno"]; ?>" > <img src="imgs/hatsedit.png" id="img2" /></a> 
           <input type="hidden" name="srno" value=' . $row["srno"] . '>
           <input type="submit" class="btn_del" name="deleterecord" value="DELETE"></form></td>';
      echo "</tr>";
      }
  echo "</table>"; 
  ?>   
    </td>
  </tr>
</table>
</div>
<label ><?php include('errors.php'); ?></label>
</div>
</div>
<!-- MAIN PAGE WORK -->  

</form>
<div class="ftr_stl">© copyright Pk</div>
</div>
</body>
</html>

