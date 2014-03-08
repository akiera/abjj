<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for admin
{
header('Location:../');
exit();
}

include '../connection/data2.php';

$username=$_SESSION['username'];
$userIC=$_SESSION['user_ic'];
$staff_IC =$_SESSION['staff_ic'];

$idDailyReport = $_SESSION['idDailyReport'];
$cawangan = $_POST['cawangan'];
$dateDaily=$_POST['dateDaily'];
$date=$_POST['date'];
$sales = $_POST['sales'];
$purchase = $_POST['purchase'];
$salary = $_POST['salary'];
$others = $_POST['others'];
$advance = $_POST['advance'];
$cashBankIn = $_POST['cashBankIn'];

$query = "UPDATE t_dailyReport SET cawangan='$cawangan', date='$date', sales='$sales', purchase='$purchase', salary='$salary', others='$others', advance='$advance', cashBankIn='$cashBankIn' WHERE idDailyReport='$idDailyReport'";
$result=mysql_query($query) or die ('Data supplier cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Daily Report data has been updated successfully!');";
	print "window.location='index.php?p=viewDailyReport&idDailyReport=$idDailyReport'";
	print "</script> ";

?>