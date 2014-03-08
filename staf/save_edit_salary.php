<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 1 = user for admin
{
header('Location:../');
exit();
}
include '../connection/data2.php';
$username=$_SESSION['username'];
$userIC=$_SESSION['user_ic'];
$staff_IC =$_SESSION['staff_ic'];

$idSalary = $_SESSION['idSalary'];
$cawangan = $_POST['cawangan'];
$name = $_POST['name'];
$salary=$_POST['salary'];
$advance=$_POST['advance'];
$month = $_POST['month'];
$year = $_POST['year'];

$query = "UPDATE t_salary SET cawangan='$cawangan', name='$name', salary='$salary', advance='$advance', month='$month', year='$year' WHERE idSalary='$idSalary'";
$result=mysql_query($query) or die ('Data Staff Salary cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Staff Salary data has been updated successfully!');";
	print "window.location='index.php?p=viewsalary&idSalary=$idSalary'";
	print "</script> ";
?>