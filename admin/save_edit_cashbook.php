<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for admin
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
$masuk = $_POST['masuk'];
$keluar = $_POST['keluar'];

$query = "UPDATE t_cashbook SET cawangan='$cawangan', butir='$butir', tarikh='$tarikh', masuk='$masuk', keluar='$keluar' WHERE idCash='$idCash'";
$result=mysql_query($query) or die ('Data Cash Book cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Cash Book data has been updated successfully!');";
	print "window.location='index.php?p=viewcashbook&idCash=$idCash'";
	print "</script> ";
?>