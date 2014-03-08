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

$txtPaymentId = $_POST['txtPaymentId'];
$txtcawangan = $_POST['txtcawangan'];
$txtpembekal = $_POST['txtpembekal'];
$datePayment=$_POST['datePayment'];
$s_date = split("/",$datePayment);
$finddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";
$txtChq = $_POST['txtChq'];
$txtTotal = $_POST['txtTotal'];
$txtCn = $_POST['txtCn'];
$prepared = $_POST['prepared'];

$sql= "SELECT idPayment FROM t_payment WHERE idPayment='$txtPaymentId'";
$result = mysql_query($sql) or die ('Data of purchase cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("payment.php");
	echo "<script>alert('The payment ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_payment (idPayment, cawangan, pembekal, tarikh, chqNo, amaunt, cn, oleh) 
			VALUES ('$txtPaymentId', '$txtcawangan', '$txtpembekal', '$finddate', '$txtChq', '$txtTotal', '$txtCn', '$prepared')";
$result = mysql_query($query) or die(mysql_error());

	echo "<script>alert('New Payment is success!!');";
	print "window.location='index.php?p=viewPayment&idPayment=$txtPaymentId'";
	print "</script> ";
}  
?>
