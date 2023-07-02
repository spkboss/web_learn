<?php include('data_db.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>"Login-Page"</title>
<link rel="icon" href="imgs/himslogo.png"  rel="shortcut icon">
<link href="css/logincss.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form method="post" action="login.php">
<div class="totdiv">

<div class="hdiv">HRI - ASSET TRAKING SYSTEM<br />(A.T.S.)  <br /><br />LOGIN SYSTEM
</div>

<div class="mdiv" ><label>User Id:</label></div>
<div class="mdiv1"> <input type="text" value="" name="userid" autocomplete="user_id" placeholder="User Id"/></div>

<div class="mdiv" ><label>Password:</label></div>
<div class="mdiv1"> <input type="password" name="password" autocomplete="password" placeholder="Password"/></div>

<div class="mdiv" >&nbsp;</div>
<div class="mdiv1"> <button type="submit" name="login_user" class="btn"/>Login</button> <Button type="reset" value="Reset" class="btn">
	Clear</Button>	<br /><br /><font face="Courier New, Courier, monospace" size="-1"> Not yet a member? </font> <a href="signup.php" style="text-decoration:none">Sign up</a>
	</div>

<div class="ldiv"> <?php include('errors.php'); ?> </div>
</div>

</body>
</form>
</html>
