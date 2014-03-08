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
$date = date("dd/mmm/yy" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

$txtCashId = $_POST['txtCashId'];
$txtcawangan = $_POST['txtcawangan'];
$txtbutir = $_POST['txtbutir'];
$txtSlip = $_POST['txtSlip'];
$s_date = split("-",$dateCash);
$finddate="".$s_date[2]."-".$s_date[0]."-".$s_date[1]."";
$txtMasa = $_POST['txtMasa'];
$txtKeluar = $_POST['txtKeluar'];
$prepared = $_POST['prepared'];
$txtdate= $_POST['txtdate'];

$sql= "SELECT idCash FROM t_cashbook WHERE idCash='$txtCashId'";
$result = mysql_query($sql) or die ('Data of Cash Book cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("cash_book.php");
	echo "<script>alert('The Cash Book report ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_cashbook (idCash, cawangan, butir, tarikh, keluar, noslip, masa, oleh, time, date2) 
			VALUES ('$txtCashId', '$txtcawangan', '$txtbutir', '$finddate', '$txtKeluar', '$txtSlip', '$txtMasa', '$prepared', '$time', '$txtdate')";
$result = mysql_query($query) or die(mysql_error());


	echo "<script>alert('New Cash Book is success!!');";
	print "window.location='index.php?p=viewBankIn&idCash=$txtCashId'";
	print "</script> ";
}  

?>