<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$idPayment = $_GET['idPayment'];

$query= "DELETE FROM `t_payment` WHERE `idPayment`='$idPayment'"; 
$result = mysql_query($query) or die ('Data payment cannot be reach. ' . mysql_error());


	echo "<script>alert('The related payment record has been successfully deleted from database!!');";
	print "window.location='index.php?p=list_payment'";
	print "</script> ";
?>