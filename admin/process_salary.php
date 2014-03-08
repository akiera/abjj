<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}

include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['staff_ic'] = $record1["user_ic"];

$query2= mysql_query("SELECT * FROM t_staff WHERE  staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record2["user_ic"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

$txtSalaryId = $_POST['txtSalaryId'];
$txtcawangan = $_POST['txtcawangan'];
$txtName = $_POST['txtName'];
$txtSalary = $_POST['txtSalary'];
$txtAdvance = $_POST['txtAdvance'];
$txtMonth = $_POST['txtMonth'];
$txtYear = $_POST['txtYear'];
$prepared = $_POST['prepared'];
$txtdate= $_POST['txtdate'];

$sql= "SELECT idSalary FROM t_salary WHERE idSalary='$txtSalaryId'";
$result = mysql_query($sql) or die ('Data of Salary cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("salary.php");
	echo "<script>alert('The Salary report ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_salary (idSalary, cawangan, name, salary, advance, month, year, oleh, time, date2) 
			VALUES ('$txtSalaryId', '$txtcawangan', '$txtName', '$txtSalary', '$txtAdvance', '$txtMonth', '$txtYear', '$prepared', '$time', '$txtdate')";
$result = mysql_query($query) or die(mysql_error());

	echo "<script>alert('New Salary is success!!');";
	print "window.location='index.php?p=viewsalary&idSalary=$txtSalaryId'";
	print "</script> ";
}  
?>