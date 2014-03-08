<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$idTopup = $_GET['idTopup'];

$query= "DELETE FROM `t_topup` WHERE `idTopup`='$idTopup'"; 
$result = mysql_query($query) or die ('Data Topup Transfer cannot be reach. ' . mysql_error());

	echo "<script>alert('The related Topup Book record has been successfully deleted from database!!');";
	print "window.location='index.php?p=list_topup'";
	print "</script> ";
?>