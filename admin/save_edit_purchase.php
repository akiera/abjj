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

$idPurchase = $_SESSION['idPurchase'];
$cawangan = $_POST['cawangan'];
$pembekal = $_POST['pembekal'];
$noInv = $_POST['noInv'];
$datePurchase=$_POST['datePurchase'];
$tarikh=$_POST['tarikh'];
$amaun = $_POST['amaun'];

$query = "UPDATE t_purchase SET cawangan='$cawangan', pembekal='$pembekal', noInv='$noInv', tarikh='$tarikh', amaun='$amaun' WHERE idPurchase='$idPurchase'";
$result=mysql_query($query) or die ('Data supplier cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Purchase data has been updated successfully!');";
	print "window.location='index.php?p=viewpurchase&idPurchase=$idPurchase'";
	print "</script> ";

?>