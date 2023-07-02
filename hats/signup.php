<?php include('data_db.php') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>"User Registration"</title>
<link rel="icon" href="imgs/jms-icn.png"  rel="shortcut icon">
<link href="css/register.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="totdiv">

<div class="hdiv">HRI - ASSET TRAKING SYSTEM<br />(I.T.S.)  <br /><br />USER REGISTERATION</div>
<form action="signup.php"  method="POST"  enctype="multipart/form-data">

<div class="mdiv" >User Id:</div>
<div class="mdiv1"> <input type="text" value="<?php echo $userid; ?>" name="userid"  placeholder="User ID" tabindex="1" />
</div>

<div class="mdiv" >Name:</div>
<div class="mdiv1"> <input type="text" value="<?php echo $username; ?>" name="username" autocomplete="useriname" placeholder="Name" tabindex="2" />
</div>

<div class="mdiv" >Mail:</div>
<div class="mdiv1"> <input type="email" value="<?php echo $email; ?>" name="email" autocomplete="usermail" placeholder="User Mail" tabindex="3" />
</div>

<div class="mdiv" >Mobile:</div>
<div class="mdiv1"> <input type="text" value="<?php echo $mobile; ?>" name="mobile" autocomplete="usermobile" placeholder="User Mobile" tabindex="4" />
</div>

<div class="mdiv" >Password:</div>
<div class="mdiv1"> <input type="password" value="" name="password" maxlength="15" autocomplete="userpass" placeholder="Password" tabindex="5" />
</div>

<div class="mdiv" >Confirm Password:</div>
<div class="mdiv1"> <input type="password" value="" name="ipass1" maxlength="15" autocomplete="usercpasas" placeholder="Confirm Password" tabindex="6" />
</div>

<div class="mdiv" >Department:</div>
<div class="mdiv1">

<select id="dept_name" name="dept_name" tabindex="7"  >

<option selected value="">Select Department:</option>
<option Value="DEPT-IT">IT</option>
<option Value="DEPT-1">Non-IT</option>
</select> 

</div>

<div class="mdiv" >Gender:</div>
<div class="rdiv"> 
<input type="radio"name="gen"  value="male" tabindex="8" />male
<input type="radio" name="gen" value="female" tabindex="9" />female

</div>

<div class="mdiv" >Profile Photo:</div>
<div class="mdiv1"> <input type="file" name="file" placeholder="Select your images" tabindex="10" />
</div>


<div class="mdiv1"> 
	<button type="submit" name="reg_user" class="btn" tabindex="8" />Register</Button> 
	<Button type="reset" value="Reset" class="btn" tabindex="9">Clear</Button>
<font face="Courier New, Courier, monospace" size="-1"> Already member </font><a href="login.php" style="text-decoration:none" tabindex="9">Login Now</a>
</div>
<div class="ldiv"><?php include('errors.php'); ?></div>
</div>


</form>

</body>
</html>
