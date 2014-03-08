<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$username=$_SESSION['username'];
$user_ic=$_SESSION['user_ic'];
$staff_ic =$_SESSION['staff_ic'];

$txtProductID =$_SESSION['id_product'];

//$txtProductID = $_POST['idproduct'];
$txtProductName = $_POST['txtProductName'];
$txtcategory = $_POST['txtcategory'];
$txtsupplier = $_POST['txtsupplier'];
$txtUnitCost = $_POST['txtUnitCost'];
$txtHoldingCost = $_POST['txtHoldingCost'];
$txtROL = $_POST['txtROL'];
$txtleadtime = $_POST['txtleadtime'];
$txtcycletime = $_POST['txtcycletime'];
$txtweekmonthlt = $_POST['txtweekmonthlt'];
$txtweekmonthct = $_POST['txtweekmonthct'];
$txtSellingPrice = $_POST['txtSellingPrice'];
$txtQuantity = $_POST['txtQuantity'];

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




$query = "UPDATE t_product SET productName='$txtProductName', category='$txtcategory', 
supplier='$txtsupplier', unitcost='$txtUnitCost', holdingcost='$HC', ROL='$txtROL', 
leadtime='$LT', cycletime='$CT', sellingprice='$txtSellingPrice', weekmonthlt='$txtweekmonthlt', 
weekmonthct='$txtweekmonthct', current_qty='$txtQuantity' WHERE id_product='$txtProductID'";
$result=mysql_query($query) or die ('Data product cannot be reached. ' . mysql_error());
	

	echo "<script>alert('Details of selected Product has beeen updated successfully!');";
	print "window.location='index.php?p=viewproduct&id_product=$txtProductID'";
	print "</script> ";

?>