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

$txtCashId = $_POST['txtCashId'];
$txtcawangan = $_POST['txtcawangan'];
$txtbutir = $_POST['txtbutir'];
$dateCash = $_POST['dateCash'];
$txtMasuk = $_POST['txtMasuk'];
$prepared = $_POST['prepared'];
$txtdate= $_POST['txtdate'];

$sql= "SELECT idCash FROM t_cashbook WHERE idCash='$txtCashId'";
$result = mysql_query($sql) or die ('Data of Cash Transfer cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("cash_transfer.php");
	echo "<script>alert('The Cash Transfer report ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_cashbook (idCash, cawangan, butir, tarikh, masuk, oleh, date2) 
			VALUES ('$txtCashId', '$txtcawangan', '$txtbutir', STR_TO_DATE('$dateCash','%m/%d/%Y'), '$txtMasuk', '$prepared', '$txtdate')";
$result = mysql_query($query) or die(mysql_error());


	echo "<script>alert('New Cash Transfer is success!!');";
	print "window.location='index.php?p=viewcashtransfer&idCash=$txtCashId'";
	print "</script> ";
}  

?>