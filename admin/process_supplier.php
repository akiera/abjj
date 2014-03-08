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
$namaPembekal = $_POST['namaPembekal'];
$alamatPembekal = $_POST['alamatPembekal'];


$sql= "SELECT idPembekal FROM t_pembekal WHERE idPembekal='$supID'";
$result = mysql_query($sql) or die ('Data of supplier cannot be access. ' . mysql_error());
$record = mysql_fetch_array($result);

if(($record))
{
	include ("add_supp.php");
	echo "<script>alert('The new supplier ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "INSERT INTO t_pembekal (idPembekal, namaPembekal, alamat) VALUES ('$supID', '$namaPembekal', '$alamatPembekal')";
$result = mysql_query($query) or die(mysql_error());

	echo "<script>alert('Registration for new supplier is success!!');";
	print "window.location='index.php?p=viewsupplier&idPembekal=$supID'";
	print "</script> ";
}  

?>
