
  <?php
    ini_set('display_errors',1);
    include_once('con_db.php');
    $con = dbcon();
    $sql = "SELECT uname FROM `users_record`";
    $result=mysqli_query($con, $sql);
    ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="js/userdatalist.js"></script>

</head>
<body>

<table cellspacing="0" cellpadding="0"   border="0px solid"  class="table1">
 <tr>
   <td>Select User:</label></td> <td colspan="3"><strong>
 
    <select id="name" name="name" onchange="selectUser()"  tabindex="1"><option value="">List of All Users</option>
  
    <?php
       while($rows=mysqli_fetch_array($result))
    {
      $n = $rows['uname'];
      echo '<option  value="'.$n.'">'.$n.'</option>'; 

  }
  ?>
  </select>
  </td>
  </tr>

	<tr><td><label for="umobile">User's Contact: </label></td> 
  <td colspan="3"><strong><input type="text" name="mobile" id="mobile" placeholder=" mobile no of user" tabindex="3" /></strong></td></tr>

	<tr><td><label for="uemail">Mail - any:</label></td>
  <td colspan="3"><strong><input type="email" name="email" id="email" placeholder="mail id - if any" tabindex="4" /></strong></td></tr>


	</table>


</body></html>