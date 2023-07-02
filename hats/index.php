<?php 
  session_start(); 
include 'data_d.php';
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
<title>"HRI-ASSET RECORD -(e)"</title>
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

<div style="overflow:auto">
<div class="menu">
<?php include("menus.php"); ?> 
</div>
<!-- MAIN PAGE WORK -->
<div class="main1">
    <div class=ttl><B>HRI-ASSET RECORD LIST </B></div>
  
     All C.C. Asset - HRI
    <form name="search" method="post" action="index.php">
    <!-- Search data -->
       <div class="text-search">
          <h5 class="card-header">Search asset by Brand / Type / Asset code</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" id="search-box" name="searchdata" placeholder="Search asset by Brand name / Type / asset code " required="true">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Search!</button>
                <br /> <br />
              </span>
            </div>
          </div>
        </div>
    </form>

      <table cellpadding="10" border="0" width="100%"  >
      <tr style="color:white; background-color:#3f51b5;  border-collapse: collapse; text-align:center;">
      <th WIDTH="10%">Asset ID</th>
      <th WIDTH="10%">Asset Date (Record)</th>
      <th WIDTH="10%">Asset Name/Model</th>
      <th WIDTH="10%">Brand</th>
      <th WIDTH="10%">Type</th>
      <th WIDTH="10%">Asset Serial</th>
      <th WIDTH="10%">Asset Code</th>
      <th WIDTH="20%">Description</th>
      <th WIDTH="10%">Status</th>


      </tr>
       </table>
    </td>
  </tr>
  <tr>
   <td>
    <div class="tbldiv"> 
    <?php 
      $sdata=$_POST['searchdata']; 
      ?>
      <table cellspacing="0" cellpadding="1" border="1" class="table2" >
        <tr>
       <?php
      include_once('data_db.php');
      $res=mysqli_query($db,"SELECT * from asset_record where (amake like '%$sdata%'|| atype like '%$sdata%' || aserial like '%$sdata%' || acode like '%$sdata%')");
      $num=mysqli_num_rows($res);
      if($num>0){
      $cnt=1;
      while ($row=mysqli_fetch_array($res)) {
      ?>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['srno']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['rec_date']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['aname']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['amake']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['atype']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['aserial']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['acode']; ?></center></font></strong></td>
      <td WIDTH="20%"><strong><font size="2"><center><?php echo $row['asset_des']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['astatus']; ?></center></font></strong></td>
      
      </tr>
      <?php }  } else { ?>
<h4 class="card-title" align="center">No Result found against this search</h4>
</table>
</div>

<?php } ?>   

</div>  </div>  
<!-- MAIN PAGE WORK -->  




</body>
</html>
