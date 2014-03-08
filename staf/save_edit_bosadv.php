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
$keluar = $_POST['keluar'];

$query = "UPDATE t_cashbook SET cawangan='$cawangan', tarikh='$tarikh', keluar='$keluar' WHERE idCash='$idCash'";
$result=mysql_query($query) or die ('Data Cash Transfer cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Bos Advance data has been updated successfully!');";
	print "window.location='index.php?p=viewbosadv&idCash=$idCash'";
	print "</script> ";
?>