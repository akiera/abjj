<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}

include '../connection/data2.php';

$txtPurchaseID = $_POST['txtPurchaseID'];
$txtsupplier = $_POST['txtsupplier'];
$txtcawangan = $_POST['txtcawangan'];
$txttarikh = $_POST['txttarikh'];
$txtInv = $_POST['txtInv'];
$txtBayaran = $_POST['txtBayaran'];

//convert % to value
$HC = $txtHoldingCost * $txtUnitCost;


if ($txtweekmonthlt == 'days')
{
	$LT = round(($txtleadtime/365)*12,2);
}
if ($txtweekmonthlt == 'weeks')
{
	$LT = round(($txtleadtime/52)*12,2);
}
if ($txtweekmonthlt == 'months')
{
	$LT = $txtleadtime;
}

if ($txtweekmonthct == 'days')
{
	$CT = round(($txtcycletime/365)*12,2);
}
if ($txtweekmonthct == 'weeks')
{
	$CT = round(($txtcycletime/52)*12,2);
}
if ($txtweekmonthct == 'months')
{
	$CT = $txtcycletime;
}



$sql= "SELECT id_bayar FROM purchase WHERE id_bayar='$txtPurchaseID'";
$result = mysql_query($sql) or die ('Data of product cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("purchase.php");
	echo "<script>alert('The new product ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO purchase (id_bayar,namaCawangan,namaPembekal, noInv, tarikh, bayaran) 
			VALUES ('$txtPurchaseID', '$txtcawangan', '$txtsupplier', '$txtInv', '$txttarikh', '$txtBayaran')";
$result = mysql_query($query) or die(mysql_error());

$query2 = "INSERT INTO inventory (id_product, unitcost) VALUES ('$txtProductID','$txtUnitCost')";
$result2 = mysql_query($query2) or die(mysql_error());

$query222 = "INSERT INTO abc (id_product, unitcost) VALUES ('$txtProductID','$txtUnitCost')";
$result222 = mysql_query($query222) or die(mysql_error());

	echo "<script>alert('Registration for new product is success!');";
	print "window.location='index.php?p=viewproduct&id_product=$txtProductID'";
	print "</script> ";
}  

?>
