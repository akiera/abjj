<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$id_product =$_GET['id_product']; 
$sizeorder=$_GET['sizeorder'];
$rol=$_GET['rol'];
$productname=$_GET['productname'];
$tsl=$_GET['tsl'];


$query3 = "UPDATE t_product SET rol='$rol' WHERE id_product='$id_product'";
$result3=mysql_query($query3) or die ('Data product cannot be reached. ' . mysql_error());


$sql22= "SELECT * FROM forecast_data WHERE id_product='$id_product'";
$result22 = mysql_query($sql22) or die ('Data of product cannot be access. ' . mysql_error());
$record22 = mysql_fetch_array($result22);
if(!$record22)
{
 if($sizeorder!='')
 {
 $query412 = "INSERT INTO `forecast_data` ( `id_product` , `productname` , `rol` , `sizeorderssb`, `tsl`) 
	VALUES ( '$id_product', '$productname', '$rol', '$sizeorder', '$tsl')";
 $result412 = mysql_query($query412) or die ('Data sales cannot access. ' . mysql_error());
 echo "<script>";
 print "window.location='index.php?p=PeriodicReview'";
	print "</script> ";
 }
}
else
{
  if($sizeorder!='')
  {
  $query = "UPDATE forecast_data SET id_product='$id_product', productname='$productname', rol='$rol', sizeorderssb='$sizeorder', tsl='$tsl' WHERE id_product='$id_product'";
  $result=mysql_query($query) or die ('Data forecast_data cannot be reached. ' . mysql_error());
  echo "<script>";
  print "window.location='index.php?p=PeriodicReview'";
	print "</script> ";
  }
}
echo "<script>";
  print "window.location='index.php?p=PeriodicReview'";
	print "</script> ";


?>
