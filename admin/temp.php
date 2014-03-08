<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}

include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['staff_ic'] = $record1["user_ic"];


$query2= mysql_query("SELECT * FROM t_staff WHERE  staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record2["user_ic"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

$supp=$_POST['supp'];
$no=$_POST['no'];
$noPo=$_POST['noPo'];
$category=$_POST['category'];
$id_supplier=$_POST['id_supplier'];
$date=$_POST['date'];
$date=date ("j F Y",time()+(3600*8));
$product=$_POST['product'];
$qty=$_POST['qty'];
$update_session=$_POST['session'];


$query3= mysql_query("SELECT * FROM t_supplier WHERE companyname='$supp'");
$record3 = mysql_fetch_array($query3);

//*******Split date change to valid format to insert to database*****************************
//$s_date = split("/",$deliverdate);
//$finddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";
//Check if got data with same session, delete it.
for($a=0;$a<$no;$a++)
{
	$sqlc = "SELECT * FROM temp_order WHERE session='$update_session'";
	$resultc = mysql_query($sqlc) or die ('Data temp_order cannot be reach. ' . mysql_error());
	while($rowc = mysql_fetch_array($resultc))
	{
		$idc=$rowc['id'];
		$sSql="DELETE FROM `temp_order` WHERE `id`='$idc'";
		$result=mysql_query($sSql) or die ('Data claim cannot access. ' . mysql_error());
	}
}
//Insert the new order records in temp_order
for($a=0;$a<$no;$a++)
{
	$query412 = "INSERT INTO `temp_order` ( `session` , `supplier` , `number_order` , `po_num` , `product` , `qty` ) 
		VALUES ( '$update_session', '".$record3["id_supplier"]."', '$no', '$noPo', '".$product[$a]."', '".$qty[$a]."')";
	$result412 = mysql_query($query412) or die ('Data temp_order cannot access. ' . mysql_error());
}
							 
//redirect to confirm-po.php and pass all value need.							
 header("Location: index.php?p=confirm-po&supp=$supp&no=$no&noPo=$noPo&category=$category&id_supplier=$id_supplier&date=$date&session=$update_session");
 exit();
							
?>

