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

$idcawangan = $_SESSION['idCawangan'];
$namaCawangan = $_POST['namaCawangan'];
$lokasi = $_POST['lokasi'];

$query = "UPDATE t_cawangan SET namaCawangan='$namaCawangan', lokasi='$lokasi' WHERE idCawangan='$idcawangan'";
$result=mysql_query($query) or die ('Data cawangan cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Branch data has been updated successfully!');";
	print "window.location='index.php?p=viewcawangan&idCawangan=$idcawangan'";
	print "</script> ";

?>