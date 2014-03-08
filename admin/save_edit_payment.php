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

$idPayment = $_SESSION['idPayment'];
$cawangan = $_POST['cawangan'];
$pembekal = $_POST['pembekal'];
$datePayment=$_POST['datePayment'];
$tarikh=$_POST['tarikh'];
$chqNo=$_POST['chqNo'];
$amaunt = $_POST['amaunt'];
$cn = $_POST['cn'];


if(($record))
{
	include ("edit_payment.php");
	echo "<script>alert('The edit payment ID cannot same with the ID in the database!');</script> ";
}

else {

$query = "UPDATE t_payment SET cawangan='$cawangan', pembekal='$pembekal', tarikh='$tarikh', chqNo='$chqNo', amaunt='$amaunt', cn='$cn' WHERE idPayment='$idPayment'";
$result=mysql_query($query) or die ('Data payment cannot be reached. ' . mysql_error());
	
	echo "<script>alert('Payment data has been updated successfully!');";
	print "window.location='index.php?p=viewPayment&idPayment=$idPayment'";
	print "</script> ";
}

?>