<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);  

if (!isset($_SESSION['id'])){
	header("location: login.html");
}
else {
	$userid = $_SESSION['id'];
	$username1 = isset($_SESSION['adname']) ? $_SESSION['adname'] : "";
	$alusername = isset($_SESSION['alname']) ? $_SESSION['alname'] : "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" conten="text/html; charset=utf-8" />
<title>Update Profile</title>
<link rel="stylesheet" href="css/update_profile.css" />
</head>

<body>
<?php
include_once "connect_database.php";
include_once "setting/updateprofile_navigation.php";
?>
<div>
<br /><br />
<h2>Update Profile</h2>
<br />
<form method="post" name="profile" enctype="multipart/form-data">
<table class="updatetable1" cellspacing="20px" align="center">
  <tr>
    <th>Address:</th>
    <td class="updatetd1"><textarea name="address" cols="40" rows="6"></textarea></td>
  </tr>
  <tr>
    <th>Mobile Number:</th>
    <td class="updatetd1"><input type="text" name="contact" id="mobile" size="38" maxlength="10" pattern="[0-9]{10}"></td>
  </tr>
  <tr>
    <th>Company:</th>
    <td class="updatetd1"><input type="text" name="comp" size="38" /></td>
  </tr>
  <tr>
    <th>Email:</th>
    <td class="updatetd1"><input type="email" name="email" size="38" /></td>
  </tr>
  <tr>
    <th>Session:</th>
    <td>
      <select class="select" name="batch">
        <option>2005-2009</option>
        <!-- Add other options here -->
      </select>
    </td>
  </tr>
  <tr>
    <th>Branch:</th>
    <td>
      <select class="select" name="prog">
        <option>CSE</option>
        <!-- Add other options here -->
      </select>
    </td>
  </tr>
  <tr>
    <th>Profile Picture:</th>
    <td class="updatetd1"><input type="file" name="pp" size="38" /></td>
  </tr>
  <tr>
    <td class="updatetd1" colspan="2" align="right">
      <button class="updatebt" type="submit" name="update" onclick="return check();">Update</button>
    </td>
  </tr>
</table>
</form>
</div>
<br /><br /><br /><br /><br /><br />
<?php
if (isset($_POST['update'])) {
  $gender = $_POST['gender'];
  $address = $_REQUEST['address'];
  $contact = $_REQUEST['contact'];
  $email = $_REQUEST['email'];
  $batch = $_REQUEST['batch'];
  $prog = $_REQUEST['prog'];
  $comp = $_REQUEST['comp'];
  $pp = addslashes(file_get_contents($_FILES['pp']['tmp_name']));

  if (
    $address == "" && $contact == "" && $comp == "" &&
    $email == "" && $batch == "" && $prog == "" && $gender == "" && $pp == false
  ) {
    echo "<script>alert('Empty field. No update made.')</script>";
  } else {
    // The rest of your code for updating the profile
  }
}
?>
</body>
<script>
  function check() {
    var phoneno = /^\d{10}$/;
    var mobile = document.getElementById('mobile');
    if (mobile.value.match(phoneno)) {
      return true;
    } else {
      alert("ENTER VALID MOBILE NUMBER");
      return false;
    }
  }
</script>
</html>
