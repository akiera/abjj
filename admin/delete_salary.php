<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$idSalary = $_GET['idSalary'];

$query= "DELETE FROM `t_salary` WHERE `idSalary`='$idSalary'"; 
$result = mysql_query($query) or die ('Data Salary cannot be reach. ' . mysql_error());

	echo "<script>alert('The related Staff Salary record has been successfully deleted from database!!');";
	print "window.location='index.php?p=list_salary'";
	print "</script> ";
?>