<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}

include '../connection/data2.php';

$supID = $_POST['supID'];
$namaCawangan = $_POST['namaCawangan'];
$lokasiCawangan = $_POST['lokasiCawangan'];

$sql= "SELECT idCawangan FROM t_cawangan WHERE idCawangan='$supID'";
$result = mysql_query($sql) or die ('Data of supplier cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("add_cawangan.php");
	echo "<script>alert('The new cawanganr ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_cawangan (idCawangan, namaCawangan, lokasi) VALUES ('$supID', '$namaCawangan', '$lokasiCawangan')";
$result = mysql_query($query) or die(mysql_error());

	echo "<script>alert('Pendaftaran Cawangan Baru Berjaya!!');";
	print "window.location='index.php?p=viewcawangan&idCawangan=$supID'";
	print "</script> ";
}  

?>
