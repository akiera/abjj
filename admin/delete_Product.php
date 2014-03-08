<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$id_product = $_GET['id_product'];

$query= "DELETE FROM `t_product` WHERE `id_product`='$id_product'"; 
$result = mysql_query($query) or die ('Data product cannot be reach. ' . mysql_error());

$query2= "DELETE FROM `inventory` WHERE `id_product`='$id_product'"; 
$result2 = mysql_query($query2) or die ('Data inventory cannot be reach. ' . mysql_error());

	echo "<script>alert('Stok Ini Berjaya Dihapuskan!!');";
	print "window.location='index.php?p=product_list'";
	print "</script> ";
?>