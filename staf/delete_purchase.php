<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$idPurchase = $_GET['idPurchase'];

$query= "DELETE FROM `t_purchase` WHERE `idPurchase`='$idPurchase'"; 
$result = mysql_query($query) or die ('Data product cannot be reach. ' . mysql_error());


	echo "<script>alert('The related purchase record has been successfully deleted from database!!');";
	print "window.location='index.php?p=list_purchase'";
	print "</script> ";
?>