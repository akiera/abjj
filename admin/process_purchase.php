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

$txtPurchaseId = $_POST['txtPurchaseId'];
$txtcawangan = $_POST['txtcawangan'];
$txtpembekal = $_POST['txtpembekal'];
$txtInv = $_POST['txtInv'];
//$dateInv=$_POST['dateInv'];
$s_date = split("/",$dateInv);
$finddate="".$s_date[2]."-".$s_date[0]."-".$s_date[1]."";
$txtAmaun = $_POST['txtAmaun'];
$prepared = $_POST['prepared'];
$txtdate= $_POST['txtdate'];

$sql= "SELECT idPurchase FROM t_purchase WHERE idPurchase='$txtPurchaseId'";
$result = mysql_query($sql) or die ('Data of purchase cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("purchase.php");
	echo "<script>alert('The new purchase ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_purchase (idPurchase, cawangan, pembekal, noInv, tarikh, amaun, oleh, time, date2) 
			VALUES ('$txtPurchaseId', '$txtcawangan', '$txtpembekal', '$txtInv', '$finddate', '$txtAmaun', '$prepared', '$time', '$txtdate')";
$result = mysql_query($query) or die(mysql_error());

	echo "<script>alert('Registration for new purchase is success!');";
	print "window.location='index.php?p=viewpurchase&idPurchase=$txtPurchaseId'";
	print "</script> ";
}  

?>
