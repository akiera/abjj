<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../../index.php";
header($url);
}

include '../connection/data2.php';

$idCawangan = $_GET['idCawangan'];

$query= "DELETE FROM `t_cawangan` WHERE `idCawangan`='$idCawangan'"; 
$result = mysql_query($query) or die ('Data product cannot be reach. ' . mysql_error());


	echo "<script>alert('The related branch record has been successfully deleted from database!!');";
	print "window.location='index.php?p=snarai_cawangan'";
	print "</script> ";
?>