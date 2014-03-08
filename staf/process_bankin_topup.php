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

$txtTopupId = $_POST['txtTopupId'];
$txtcawangan = $_POST['txtcawangan'];
$txtbutir = $_POST['txtbutir'];
$txtSlip = $_POST['txtSlip'];
$dateCash = $_POST['dateCash'];
$txtKeluar = $_POST['txtKeluar'];
$txtMasa = $_POST['txtMasa'];
$prepared = $_POST['prepared'];
$txtdate= $_POST['txtdate'];

$sql= "SELECT idTopup FROM t_topup WHERE idTopup='$txtTopupId'";
$result = mysql_query($sql) or die ('Data of Topup Book cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("bankin_topup.php");
	echo "<script>alert('The Bank In record ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_topup (idTopup, cawangan, butir, tarikh, keluar, noslip, masa, oleh, date2) 
			VALUES ('$txtTopupId', '$txtcawangan', '$txtbutir', STR_TO_DATE('$dateCash','%m/%d/%Y'), '$txtKeluar', '$txtSlip', '$txtMasa', '$prepared', '$txtdate')";
$result = mysql_query($query) or die(mysql_error());

	echo "<script>alert('New Bank In Record is success!!');";
	print "window.location='index.php?p=viewBankInTopup&idTopup=$txtTopupId'";
	print "</script> ";
}  

?>