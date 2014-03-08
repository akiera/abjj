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

$idTopup = $_SESSION['idTopup'];
$cawangan = $_POST['cawangan'];
$butir = $_POST['butir'];
$dateCash=$_POST['dateCash'];
$tarikh=$_POST['tarikh'];
$masuk = $_POST['masuk'];
$keluar = $_POST['keluar'];

$query = "UPDATE t_topup SET cawangan='$cawangan', butir='$butir', tarikh='$tarikh', masuk='$masuk', keluar='$keluar' WHERE idTopup='$idTopup'";
$result=mysql_query($query) or die ('Data Topup Book cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Topup Book data has been updated successfully!');";
	print "window.location='index.php?p=viewtopupbook&idTopup=$idTopup'";
	print "</script> ";
?>