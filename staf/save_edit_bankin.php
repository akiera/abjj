<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 1 = user for admin
{
header('Location:../');
exit();
}
include '../connection/data2.php';
$username=$_SESSION['username'];
$userIC=$_SESSION['user_ic'];
$staff_IC =$_SESSION['staff_ic'];

$idCash = $_SESSION['idCash'];
$cawangan = $_POST['cawangan'];
$butir = $_POST['butir'];
$dateCash=$_POST['dateCash'];
$tarikh=$_POST['tarikh'];
$masa = $_POST['masa'];
$keluar = $_POST['keluar'];
$noslip = $_POST['noslip'];


$query = "UPDATE t_cashbook SET cawangan='$cawangan', tarikh='$tarikh', masa='$masa', keluar='$keluar', noslip='$noslip' WHERE idCash='$idCash'";
$result=mysql_query($query) or die ('Data Bank In cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Bank In data has been updated successfully!');";
	print "window.location='index.php?p=viewBankIn&idCash=$idCash'";
	print "</script> ";
?>