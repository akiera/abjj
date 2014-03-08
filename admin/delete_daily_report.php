<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$idDailyReport = $_GET['idDailyReport'];

$query= "DELETE FROM `t_dailyReport` WHERE `idDailyReport`='$idDailyReport'"; 
$result = mysql_query($query) or die ('Data daily report cannot be reach. ' . mysql_error());


	echo "<script>alert('The related daily report record has been successfully deleted from database!!');";
	print "window.location='index.php?p=list_daily_report'";
	print "</script> ";
?>