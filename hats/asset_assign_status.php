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
    <div class=ttl><B>HRI-ASSIGN ASSET SETATUS </B></div>
	
     Update/Edit data of asset ...
    <form name="search" method="post" action="asset_assign_status.php">
    <!-- Search data -->
       <div class="text-search">
          <h5 class="card-header">Search user by name, mobile Number & by Status</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" id="search-box" name="searchdata" placeholder="search user by name / mobile / status" required="true">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Search!</button>
                <br /> <br />
              </span>
            </div>
          </div>
        </div>
    </form>


      <table cellpadding="10" border="0" width="100%"  >
      <tr style="color:white; background-color:#95b7bf;  border-collapse: collapse; text-align:center;">
			<th WIDTH="10%">ID</th>
			<th WIDTH="10%">Date (Assign Assset)</th>
			<th WIDTH="15%">User Name</th>
			<th WIDTH="10%">Mobile</th>
      <th WIDTH="15%">Email</th>
			<th WIDTH="10%">Asset Make/Brand</th>
			<th WIDTH="10%">Asset Type</th>
			<th WIDTH="10%">Asset Serial</th>
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
			$res=mysqli_query($db,"SELECT * from assign_asset where (an_name like '%$sdata%'|| an_mobile like '%$sdata%' || use_status like '%$sdata%') and (asset_status=1)");
      $num=mysqli_num_rows($res);
      if($num>0){
      $cnt=1;
      while ($row=mysqli_fetch_array($res)) {
      ?>
			<td WIDTH="10%"><strong><font size="2"><center><?php echo $row['srno']; ?></center></font></strong></td>
			<td WIDTH="10%"><strong><font size="2"><center><?php echo $row['an_rec_date']; ?></center></font></strong></td>
			<td WIDTH="15%"><strong><font size="2"><center><?php echo $row['an_name']; ?></center></font></strong></td>
      <td WIDTH="10%"><strong><font size="2"><center><?php echo $row['an_mobile']; ?></center></font></strong></td>
      <td WIDTH="15%"><strong><font size="2"><center><?php echo $row['an_email']; ?></center></font></strong></td>
			<td WIDTH="10%"><strong><font size="2"><center><?php echo $row['an_make']; ?></center></font></strong></td>
			<td WIDTH="10%"><strong><font size="2"><center><?php echo $row['an_type']; ?></center></font></strong></td>
			<td WIDTH="10%"><strong><font size="2"><center><?php echo $row['an_serial']; ?></center></font></strong></td>
			<td WIDTH="10%"><strong><font size="2"><center><?php echo $row['use_status']; ?></center></font></strong></td>		

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
