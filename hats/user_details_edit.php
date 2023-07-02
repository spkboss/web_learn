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
$id=$_REQUEST['id'];
$usr_query = "SELECT * from users_record WHERE id='".$id."'"; 
//echo $slt_query;
$result = mysqli_query($db, $usr_query) or die ( mysqli_error($db));
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
    <div class=ttl><B>USER'S RECORD EDIT</B></div>

<div style="overflow-x:auto;">

  <div class="upcss">
  <p><b>Change/update Users details </b> </p>
  
  <div class="form">
  <?php
  $status = "";
  if(isset($_POST['new']) && $_POST['new']==1)
  {
          $id = $_REQUEST['id'];
     //$rec_date = date("Y-m-d");
         $uname = $_REQUEST['uname'];
       $umobile = $_REQUEST['umobile'];
        $uemail = $_REQUEST['uemail'];
     $ulocation = $_REQUEST["ulocation"];
         $udept = $_REQUEST['udept'];
          $udes = $_REQUEST["udes"];
   $submittedby = $_SESSION["userid"];
    
    $update ="UPDATE users_record SET uname='".$uname."', umobile='".$umobile."', uemail='".$uemail."', ulocation='".$ulocation."', udept='".$udept."', udes='".$udes."' WHERE id='".$id."'";

      mysqli_query($db, $update) or die(mysqli_error());
      $status = "Record Updated Successfully. </br></br><a href='users_record_update.php'>View Updated Record</a>";
      echo '<p style="color:#FF0000;">'.$status.'</p>';
      }else 
      {
    ?>

    <div>

<form name="form" method="post" action="user_details_edit.php">
   <input type="hidden" name="new" value="1" />
    <table cellpadding="5" border="0px solid" width="100%" >
      <tr><td style=" background-color:#e7efff; text-align:right;" > Asset Track ID:<input type="hidden" name="id" required value="<?php echo $rows['id'];?>" /></td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><?php echo $rows['id']; ?></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >Asset Make:</td>
     <td style=" background-color:#e2e9f7;">&nbsp;<strong><font color="#0a4a82"> <select name="udept" tabindex="1" >
        <option><?php echo $rows['udept']; ?></option>
            <option value="Acedmic">Acedmic Dept</option>
            <option value="Library">Library Dept</option>
            <option value="Processor">Processor</option>
            <option value="Post_Doc">Post_Doc Student</option>
            <option value="Phd">Phd Student</option>
            <option value="Tech_Dept">Tech Dept</option>
            <option value="Visitor">Visitor</option>   
        </select></font></strong>
     </td></tr>

      <tr><td style=" background-color:#e7efff; text-align:right;" > User Name :</td>
      <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><input type="text" name="uname" required value="<?php echo $rows['uname']; ?>" tabindex="3" /></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >User Contact : </td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"> <input type="text" name="umobile" required value="<?php echo $rows['umobile']; ?>" tabindex="4" /></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >Mail ID : </td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"> <input type="text" name="uemail"required value="<?php echo $rows['uemail']; ?>" tabindex="5" /></font></strong></td></tr>

     <tr><td style=" background-color:#e7efff; text-align:right;" >Current Location/Area : </td>
     <td style=" background-color:#e2e9f7;">&nbsp;<strong><font color="#0a4a82"> <input type="text" name="ulocation" required value="<?php echo $rows['ulocation']; ?>" tabindex="6" /></font></strong></td></tr>
     <tr><td style=" background-color:#e7efff; text-align:right;" >User info :</td>
     <td style=" background-color:#e2e9f7;">&nbsp;&nbsp;<strong><font color="#0a4a82"><textarea id="msg" name="udes" tabindex="7" ><?php echo $rows['udes']; ?></textarea></font></strong></td></tr>

     <tr><td style=" background-color: text-align:right;" >&nbsp; </td>
     <td><p><input name="submit" type="submit" value="Update" class="btn_edit" /></p> </td></tr>

    </table>
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
