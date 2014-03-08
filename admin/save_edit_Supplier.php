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
$userIC=$_SESSION['user_ic'];
$staff_IC =$_SESSION['staff_ic'];

$idpembekal = $_SESSION['idPembekal'];
$namaPembekal = $_POST['namaPembekal'];
$alamat = $_POST['alamat'];

$query = "UPDATE t_pembekal SET namaPembekal='$namaPembekal', alamat='$alamat' WHERE idPembekal='$idpembekal'";
$result=mysql_query($query) or die ('Data supplier cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Supplier data has been updated successfully!');";
	print "window.location='index.php?p=viewsupplier&idPembekal=$idpembekal'";
	print "</script> ";

?>