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
$sales = $_POST['sales'];
$dateDaily=$_POST['dateDaily'];
$date=$_POST['date'];
$purchase = $_POST['purchase'];
$salary = $_POST['salary'];
$others = $_POST['others'];
$bf = $_POST['bf'];
$advance = $_POST['advance'];
$cashTransfer = $_POST['cashTransfer'];
$cashBankIn = $_POST['cashBankIn'];

$query = "UPDATE t_dailyReport SET cawangan='$cawangan', sales='$sales', date='$date', purchase='$purchase', salary='$salary', others='$others', bf='$bf', advance='$advance', cashTransfer='$cashTransfer', cashBankIn='$cashBankIn' WHERE idDailyReport='$idDailyReport'";
$result=mysql_query($query) or die ('Data supplier cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Edit Daily Report data has been updated successfully!');";
	print "window.location='index.php?p=new_viewDailyReport&idDailyReport=$idDailyReport'";
	print "</script> ";

?>