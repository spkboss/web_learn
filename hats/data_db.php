<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
// initializing variables
$id = $userid = $username = $email = $mobile = $dept_name = $gen = $file = "";
$srno = $rec_date = $aname = $aserial = $abar = $amake = $asset_des =  $nature_hims = "";
$udept = $uname = $umobile = $uemail =  $ulocation = $udes = $display_errors = "" ;
$an_rec_date  = $an_type = $an_make = $an_serial = $an_name = $an_mobile = $an_email = $an_dept = $an_location = $an_des = "";
$errors = array(); 
$sucesss = array(); 

// connect to the database

$db = mysqli_connect('localhost', 'root', 'Hri@12345', 'hats');
if (!$db) { die("Connection failed: " . mysqli_connect_error());}

//echo " conntion ok";
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $ipass1 = mysqli_real_escape_string($db, $_POST['ipass1']);
  $dept_name = mysqli_real_escape_string($db, $_POST['dept_name']);
  $gen = mysqli_real_escape_string($db, $_POST['gen']);
  $file = mysqli_real_escape_string($db, $_POST['file']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($userid)) { array_push($errors, "UserId required"); }
  if (empty($username)) { array_push($errors, "Username required"); }
  if (empty($email)) { array_push($errors, "Email required"); }
  if (empty($mobile)) { array_push($errors, "mobile required"); }
  if (empty($password)) { array_push($errors, "Password required"); }
  if ($password != $ipass1) {array_push($errors, "Password mismatch");}
  if (empty($dept_name)) { array_push($errors, "Department required"); }
  if (empty($gen)) { array_push($errors, "Select gender"); }


// Check mobile no. 10 digit 
$mobile = $_POST['mobile'];

if(!empty($mobile)) // phone number is not empty
{
    if(preg_match('/^\d{10}$/',$mobile)) // phone number is valid
    {
      $mobile = $mobile;
    }
    else // phone number is not valid
    {
      array_push($errors, 'Mobile number invalid !');
    }
}
else // phone number is empty
{
  array_push($errors, 'You must provid a Mobile number !');
}


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users_new WHERE userid='$userid' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
  	if ($user['userid'] === $userid) {
      array_push($errors, "Id already exists,try new one.");
    }
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
	
	if ($user['mobile'] === $mobile) {
      array_push($errors, "mobile already exists");
    }
  }


// File upload path
$statusMsg = '';
$targetDir = "profile_img/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
if(isset($_POST["reg_user"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
   
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
          if($query){ $statusMsg = "The file ".$fileName. " has been uploaded successfully.";}
            else{ $statusMsg = "File upload failed, please try again."; } 
          // Finally, register user if there are no errors in the form
          if (count($errors) == 0) 
          {
          $password = md5($password);//encrypt the password before saving in the database
          // Insert image file name into database
          $query = "INSERT INTO users_new (userid, username, email, mobile, password, dept_name, gender, img_name, uploaded_on) 
          VALUES('$userid', '$username', '$email', $mobile, '$password', '$dept_name', '$gen', '$fileName', NOW())";
          if ($db->query($query) === TRUE)

          {
            array_push($sucesss, "'Registeration done sucessfully.'");
            //echo "done";
          }
          else
          { 
            echo "'check any field for fill!'";
          }
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Login Now";
          header('location: login.php');
        
          } else{ $statusMsg = "Sorry, there was an error uploading your file."; }
          } else{ $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.'; }
          } else{ $statusMsg = 'Please select a file to upload.';}
}            
// Finally, register user if there are no errors in the form

}

  
// ... 


// LOGIN USER
if (isset($_POST['login_user'])) {
  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($userid)) {
  	array_push($errors, "userid required");
  }
  if (empty($password)) {
  	array_push($errors, "Password required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query1 = "SELECT * FROM users_new WHERE userid='$userid' AND password='$password'";
  	$results = mysqli_query($db, $query1);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['userid'] = $userid;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

 // insert into inventory record


	if (isset($_POST['hats_submit'])) { // receive all input values from the form

	 $rec_date = mysqli_real_escape_string($db, $_POST['rec_date']);
   $asset_des = mysqli_real_escape_string($db, $_POST['asset_des']);
   $atype = mysqli_real_escape_string($db, $_POST['atype']);
	 $aname = mysqli_real_escape_string($db, $_POST['aname']);
	 $aserial = mysqli_real_escape_string($db, $_POST['aserial']);
	 $acode = mysqli_real_escape_string($db, $_POST['acode']);
	 $amake = mysqli_real_escape_string($db, $_POST['amake']);

	if (empty($rec_date)) { array_push($errors, "* Select Date first"); }
  if (empty($asset_des)) { array_push($errors, "* make the description of asset."); }
  if (empty($atype)) { array_push($errors, "* select type of asset"); }
	if (empty($aname)) { array_push($errors, "* Please enter asset name"); }
	if (empty($aserial)) { array_push($errors, "* enter serial no of asset."); } 
	if (empty($acode)) { array_push($errors, "* enter asset code"); }
	if (empty($amake)) { array_push($errors, "* select type of brand/make."); }



	$rec_date = date("Y-m-d");

	// Check assign user exist in db
	$user_check_query = "SELECT * FROM users_new where id='$id'";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
  
	if ($user) { // if user exists
  	if ($user['userid'] === $userid) {
      array_push($errors, "Id already exists,try new one.");
    }}
 
	if (count($errors) == 0) {
  $query2 = "INSERT INTO asset_record (srno, rec_date, aname, aserial, acode, amake, asset_des, atype ) 
 VALUES (NULL, '$rec_date', '$aname', '$aserial', '$acode', '$amake', '$asset_des', '$atype')";
	//echo "query1";
   if ($db->query($query2) === TRUE)
header('location:index.php');
}

}


 // insert into user's record

        if (isset($_POST['uats_submit'])) { // receive all input values from the form

         $udept = mysqli_real_escape_string($db, $_POST['udept']);
         $uname = mysqli_real_escape_string($db, $_POST['uname']);
         $umobile = mysqli_real_escape_string($db, $_POST['umobile']);
         $uemail = mysqli_real_escape_string($db, $_POST['uemail']);
         $ulocation = mysqli_real_escape_string($db, $_POST['ulocation']);
         $udes = mysqli_real_escape_string($db, $_POST['udes']);

        
        if (empty($udept)) { array_push($errors, "* select a department."); }
        if (empty($uname)) { array_push($errors, "* please enter user's name."); }
        if (empty($umobile)) { array_push($errors, "* enter a contact number."); } 
        if (empty($uemail)) { array_push($errors, "* enter an email of users/association."); }
        if (empty($ulocation)) { array_push($errors, "* enter a location."); }
        if (empty($udes)) { array_push($errors, "* remark users if any! ."); }

        $daterec = date("Y-m-d");

        // Check mobile no. 10 digit 
        $umobile = $_POST['umobile'];

        if(!empty($umobile)) // phone number is not empty
          { if(preg_match('/^\d{10}$/',$umobile)) // phone number is valid
            { $umobile = $umobile; }
        else // phone number is not valid
          { array_push($errors, 'Mobile number invalid !'); } 
          }
        else // phone number is empty
          { array_push($errors, 'You must provid a Mobile number !'); }


        // Check assign user exist in db
        $user_check_query = "SELECT * FROM users_new where id='$id'";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
  
        if ($user) { // if user exists
        if ($user['userid'] === $userid) {
      array_push($errors, "Id already exists,try new one.");
    }}
 
        if (count($errors) == 0) {
  $query3 = "INSERT INTO users_record (id, udept,  uname, umobile, uemail, ulocation, udes) 
 VALUES (NULL, '$udept', '$uname', '$umobile', '$uemail', '$ulocation', '$udes')";
        //echo "query1";
   if ($db->query($query3) === TRUE)
header('location:users_record_details.php');
}

}


 // Assign asset to user 

   if (isset($_POST['asset_assign'])) { // receive all input values from the form

   $an_rec_date = mysqli_real_escape_string($db, $_POST['an_rec_date']);
   $an_dept = mysqli_real_escape_string($db, $_POST['an_dept']);
   $an_type = mysqli_real_escape_string($db, $_POST['an_type']);
   $an_make = mysqli_real_escape_string($db, $_POST['an_make']);
   $an_serial = mysqli_real_escape_string($db, $_POST['an_serial']);
        $an_name = mysqli_real_escape_string($db, $_POST['an_name']);
        $an_mobile = mysqli_real_escape_string($db, $_POST['an_mobile']);
        $an_email = mysqli_real_escape_string($db, $_POST['an_email']);
        $an_location = mysqli_real_escape_string($db, $_POST['an_location']);
        $an_des = mysqli_real_escape_string($db, $_POST['an_des']);

  if (empty($an_rec_date)) { array_push($errors, "* Select Date first"); }
  if (empty($an_dept)) { array_push($errors, "* select a department"); }
  if (empty($an_type)) { array_push($errors, "* type of asset"); }
  if (empty($an_make)) { array_push($errors, "* type of brand/make"); }
  if (empty($an_serial)) { array_push($errors, "* serial no of asset."); } 
        if (empty($an_name)) { array_push($errors, "* please enter user's name"); }
        if (empty($an_mobile)) { array_push($errors, "* enter a contact number"); } 
        if (empty($an_email)) { array_push($errors, "* enter an email of users/association."); }
        if (empty($an_location)) { array_push($errors, "* enter a location."); }
        if (empty($an_des)) { array_push($errors, "* remark users if any! ."); }
 
  $an_rec_date = date("Y-m-d");

  // Check mobile no. 10 digit 
        $an_mobile = $_POST['an_mobile'];

        if(!empty($an_mobile)) // phone number is not empty
          { if(preg_match('/^\d{10}$/',$an_mobile)) // phone number is valid
            { $an_mobile = $an_mobile; }
        else // phone number is not valid
          { array_push($errors, 'Mobile number invalid !'); } 
          }
        else // phone number is empty
          { array_push($errors, 'You must provid a Mobile number !'); }
          
  // Check assign user exist in db
  $user_check_query = "SELECT * FROM users_new where id='$id'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['userid'] === $userid) {
      array_push($errors, "Id already exists,try new one.");
    }}
 
  if (count($errors) == 0) {
  $query4 = "INSERT INTO assign_asset (srno, an_rec_date, an_dept, an_type, an_make, an_serial, an_name, an_mobile, an_email, an_location, an_des) VALUES (NULL,'$an_rec_date', '$an_dept', '$an_type', '$an_make', '$an_serial', '$an_name', '$an_mobile', '$an_email', '$an_location', '$an_des')";
  echo "query1";
   if ($db->query($query4) === TRUE)
header('location:asset_assign_status.php');

}

}


// Remove Data

if(isset($_POST['deleterecord'])){
$query5 ="DELETE FROM `asset_record` WHERE srno = {$_REQUEST['srno']}";
//$query5 = "DELETE FROM query_generate WHERE issu_id= $id LIMIT 1";
if ($db->query($query5) === TRUE)

{
	array_push($sucesss, "'Record deleted sucessfully.'");
	//echo $query5;
}
else
{
	echo "'Facing issue over deleting record'";
}
}


?>



