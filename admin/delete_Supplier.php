<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
}

include '../connection/data2.php';

$idPembekal = $_GET['idPembekal'];

$query= "DELETE FROM t_pembekal WHERE idPembekal='$idPembekal'"; 
$result = mysql_query($query) or die ('Data of supplier cannot be reach. ' . mysql_error());

	echo "<script>alert('The related Supplier record has been successfully deleted from database!!!');";
	print "window.location='index.php?p=snarai_pembekal'";
	print "</script> ";
?>

