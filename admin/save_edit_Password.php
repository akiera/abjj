<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
}

include '../connection/data2.php';

$staff_IC =$_SESSION['staff_ic'];
$username = $_POST['username'];
$password = $_POST['password'];


$query2= "SELECT * FROM `logins` WHERE `user_ic`='$staff_IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);

$query= "SELECT * FROM `t_staff` WHERE `staff_ic`='$staff_IC'"; 
$result = mysql_query($query) or die ('Data staff cannot be reached.' . mysql_error());
$record = mysql_fetch_array($result);

$category=$record["staff_cat"];

$sql3= "SELECT `username` FROM `logins` WHERE `username`='$username' AND `user_ic`!='$staff_IC'";
$result3 = mysql_query($sql3) or die ('Product login cannot be access. ' . mysql_error());
$record3 = mysql_fetch_array($result3);

if(($record3))
{		
	$username ="username";
	$password = "password";
	

	echo "<script>alert('This username already exist in the database!');</script> ";
	echo"<script>location.href = 'edit_Password.php?staff_ic=$staff_IC';</script>";
}

else{
if($category=='Admin')
{	
$query="UPDATE `logins` SET `user_type`='1', `username`='$username', `password`='$password' WHERE `user_ic`='$staff_IC'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Kata Laluan Berjaya ditukar!');";
	print "window.location='index.php?p=viewstaff&staff_ic=$staff_IC'";
	print "</script> ";
 }
 
 
else if($category=='Staff')
{
	
$query="UPDATE `logins` SET `user_type`='2', `username`='$username', `password`='$password'p WHERE `user_ic`='$staff_IC'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Kata Laluan Berjaya ditukar!!');";
	print "window.location='index.php?p=viewstaff&staff_ic=$staff_IC'";
	print "</script> ";
}
else if($category=='Customer')
{
	
$query="UPDATE `logins` SET `user_type`='3', `username`='$username', `password`='$password'p WHERE `user_ic`='$staff_IC'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Kata Laluan Berjaya ditukar!!');";
	print "window.location='index.php?p=viewstaff&staff_ic=$staff_IC'";
	print "</script> ";
}
}
?>