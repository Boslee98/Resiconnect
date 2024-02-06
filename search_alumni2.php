<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search User</title>
<link rel="stylesheet" href="css/add_job_post.css" />
<?php
session_start();
include_once"connect_database.php";
if (!isset($_SESSION['id'])){
	header("location:login.html");
}
else
{
  $userid=$_SESSION['id'];
  if (strchr("$userid","AD")==true)
	{
    $username1=$_SESSION['adname'];
		include_once"setting/adminsearchlist_navigation.php";
	}
	else
	{	
    $alusername=$_SESSION['alname'];
		include_once"setting/alumnisearchlist_navigation.php";
	}
}
?>
<style>
.dropbtn {
    background-color: white;
    color: #white;
    padding: 5px 116px;
    font-size: 15px;
	border: 2px #cbeeff;
    cursor: pointer;
}

input.i1{
padding: 3px 119px;
    font-size: 20px;
}
	
td {
            color: white;
        }
</style>
<br><br><br>
<body>
<form action="search_result.php" method="post">
<center style="border:hidden; font-size: 25px; color: white;"> Fill in any or all fiels to search:</center>

<table width="710" align="center" style="border:2px hidden;" cellspacing="20">
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Name </th>
<td width="450" style="border:hidden"><input size="45" type="text" value="" name="pid"/></td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px"> </th>
<td width="450" style="border:hidden;font-size:15px">OR</td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Registration Number </th>
<td width="450" style="border:hidden"><input size="45" type="text" value="" name="aid"/></td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px"> </th>
<td width="450" style="border:hidden;font-size:15px">OR</td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Location</th>
<td width="450" style="border:hidden">
		<select class="dropbtn" name="pp" >
        <option></option>
        <option>Gauteng</option>
		<option>Western Cape</option>
		<option>KwaZulu-Natal</option>
		<option>Eastern Cape</option>
		<option>Free State</option>
		<option>Limpopo</option>
		<option>Mpumalanga</option>
		<option>North West</option>
		<option>Northern Cape</option>

			</td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px"> </th>
<td width="450" style="border:hidden;font-size:15px">OR</td>
</tr>
<th align="left" width="450" style="border:hidden;font-size:18px">City</th>
<td width="450" style="border:hidden">
		<select class="dropbtn" name="sp" >
                <option></option>					
				<option>Johannesburg</option>
				<option>Cape Town</option>
				<option>Durban</option>
				<option>Port Elizabeth</option>
				<option>Bloemfontein</option>
				<option>Polokwane</option>
				<option>Nelspruit</option>
				<option>Mahikeng</option>
				<option>Kimberley</option>
				<option>Others</option>

			</td>
</tr>

<td colspan=2 align="center" style="border:hidden"><button type="submit" name="addpayment" >Search</button></td>
</tr>
</table>
</form>

</html>