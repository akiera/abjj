<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}

include '../connection/data2.php';

$staffname = $_POST['staffname'];
$staffIC = $_POST['staffIC'];
$staffsex = $_POST['staffsex'];
$staffphone = $_POST['staffphone'];
$staffaddress = $_POST['staffaddress'];
$staffpostcode = $_POST['staffpostcode'];
$stafftown = $_POST['stafftown'];
$staffState = $_POST['staffState'];
$staffposition = $_POST['staffcate'];
$staffemail = $_POST['staffemail'];

$Username = $_POST['Username'];
$Password = $_POST['Password'];



$sql= "SELECT staff_ic FROM t_staff WHERE staff_ic='$staffIC'";
$result = mysql_query($sql) or die ('Data Login Cannot Be Access. ' . mysql_error());
$record = mysql_fetch_array($result);


$sql2= "SELECT user_ic FROM logins WHERE user_ic='$staffIC'";
$result2 = mysql_query($sql2) or die ('Data Staff Cannot Be Access. ' . mysql_error());
$record2 = mysql_fetch_array($result2);
  
if(($record))
{
	include ("add_staff.php");
	echo "<script>alert('The new staff IC number already exist in database!');</script> ";
}


$sql3= "SELECT username FROM logins WHERE username='$Username'";
$result3 = mysql_query($sql3) or die ('Data Login Cannot Be Access. ' . mysql_error());
$record3 = mysql_fetch_array($result3);

if(($record3))
{
    echo "<script>alert('This username already exist in the database!');";
	print "window.location='add_staff.php?staffname=$staffname&staffIC=$staffIC&staffsex=$staffsex&staffphone=$staffphone&staffaddress=$staffaddress&staffpostcode=$staffpostcode&stafftown=$stafftown&staffState=$staffState&staffcate=$staffcate&staffemail=$staffemail&Username=$Username&Password=$Password'";
	print "</script> ";
	
}

else {
if ($staffposition =='Admin')
{
$query = "INSERT INTO t_staff (staff_name, staff_ic, staff_sex, staff_add, staff_post, staff_town, staff_state, staff_tel, staff_email, staff_cat, user_type) VALUES ('$staffname', '$staffIC', '$staffsex', '$staffaddress', '$staffpostcode', '$stafftown', '$staffState', '$staffphone', '$staffemail', '$staffcate', '1')";
$result = mysql_query($query) or die(mysql_error());

$query2 = "INSERT INTO logins (username, password, user_ic, user_type) VALUES ('$Username','$Password','$staffIC', '1')";
$result2 = mysql_query($query2) or die(mysql_error());	

	echo "<script>alert('New ADMIN successfully added to Database!');";
	print "window.location='index.php?p=viewstaff&staff_ic=$staffIC'";
	print "</script> ";
}  

else if ($staffposition =='Staff')
{
$query = "INSERT INTO t_staff (staff_name, staff_ic, staff_sex, staff_add, staff_post, staff_town, staff_state, staff_tel, staff_email, staff_cat, user_type) VALUES ('$staffname', '$staffIC', '$staffsex', '$staffaddress', '$staffpostcode', '$stafftown', '$staffState', '$staffphone', '$staffemail', '$staffposition', '2')";
$result = mysql_query($query) or die(mysql_error());

$query2 = "INSERT INTO logins (username, password, user_ic, user_type) VALUES ('$Username','$Password','$staffIC', '2')";
$result2 = mysql_query($query2) or die(mysql_error());		

	echo "<script>alert('New staff successfully added to Database!');";
	print "window.location='index.php?p=viewstaff&staff_ic=$staffIC'";
	print "</script> ";
}
else if ($staffposition =='Customer')
{
$query = "INSERT INTO t_staff (staff_name, staff_ic, staff_sex, staff_add, staff_post, staff_town, staff_state, staff_tel, staff_email, staff_cat, user_type) VALUES ('$staffname', '$staffIC', '$staffsex', '$staffaddress', '$staffpostcode', '$stafftown', '$staffState', '$staffphone', '$staffemail', '$staffposition', '3')";
$result = mysql_query($query) or die(mysql_error());

$query2 = "INSERT INTO logins (username, password, user_ic, user_type) VALUES ('$Username','$Password','$staffIC', '3')";
$result2 = mysql_query($query2) or die(mysql_error());		

	echo "<script>alert('New customer successfully added to Database!');";
	print "window.location='index.php?p=viewstaff&staff_ic=$staffIC'";
	print "</script> ";
}

else
{
echo "<script type='text/javascript'>
	alert(' Error on programming ');
  </script> ";
  require_once("add_staff.php");
}
}

?>
