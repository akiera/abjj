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

$idPurchase = $_SESSION['idPurchase'];
$statusa = $_POST['statuss'];

$query = "UPDATE t_purchase SET status='$statusa' WHERE idPurchase='$idPurchase'";
$result=mysql_query($query) or die ('Data supplier cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Status data has been updated successfully!');";
	//print "window.location='index.php?p=viewsupplier&idPembekal=$idpembekal'";
	print "</script> ";

?>