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

$txtdailyReportId = $_POST['txtdailyReportId'];
$txtcawangan = $_POST['txtcawangan'];
$txtSales = $_POST['txtSales'];
$dateDaily=$_POST['dateDaily'];
$s_date = split("/",$dateDaily);
$finddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";
$txtPur = $_POST['txtPur'];
$txtSal = $_POST['txtSal'];
$txtOth = $_POST['txtOth'];
$txtBf = $_POST['txtBf'];
$txtAdv = $_POST['txtAdv'];
$txtTra = $_POST['txtTra'];
$txtBan = $_POST['txtBan'];
$prepared = $_POST['prepared'];



$sql= "SELECT idDailyReport FROM t_dailyReport WHERE idDailyReport='$txtdailyReportId'";
$result = mysql_query($sql) or die ('Data of purchase cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("new_new_daily_report.php");
	echo "<script>alert('The new daily report ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_dailyReport (idDailyReport, cawangan, sales, date, purchase, salary, others, bf, advance, cashTransfer, cashBankIn, oleh) 
			VALUES ('$txtdailyReportId', '$txtcawangan', '$txtSales', '$finddate', '$txtPur', '$txtSal', '$txtOth', '$txtBf', '$txtAdv', '$txtTra', '$txtBan', '$prepared')";
$result = mysql_query($query) or die(mysql_error());


	echo "<script>alert('New Daily Report is success!!');";
	print "window.location='index.php?p=new_viewDailyReport&idDailyReport=$txtdailyReportId'";
	print "</script> ";
}  

?>
