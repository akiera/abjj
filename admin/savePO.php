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

?>

<?
$pono=$_POST['pono'];
//$deliverydate=$_POST['deliverydate'];
//$s_date = split("/",$deliverydate);
//$finddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";
$session=$_POST['session'];
$orderdate = date("Y-m-d" ,time()+(3600*8));

//retrive data from temp_order
$sqlb = "SELECT * FROM temp_order WHERE session='$session' AND product!='' AND qty!='' ORDER BY id";
$resultb = mysql_query($sqlb) or die ('Data temp_order cannot be reach. ' . mysql_error());
while($rowb = mysql_fetch_array($resultb))
{
	$product_id=$rowb['product'];
	$product_qty=$rowb['qty'];
	$supplier=$rowb['supplier'];
	//get amount of each product
	$sqlc = "SELECT * FROM t_product WHERE id_product ='$product_id'";
	$resultc = mysql_query($sqlc) or die ('Data product cannot be reach. ' . mysql_error());
	$rowc = mysql_fetch_array($resultc);
	$product_unitcost=$rowc['unitcost'];
	$amount=$product_qty*$product_unitcost;
	
	//insert to confirm this order to table order
	$query412 = "INSERT INTO `order` ( `order_by` , `po_num` , `order_date`  , `product` , `qty`, `amount`, `supplier`) 
	VALUES ( '".$_SESSION['staff_ic']."', '$pono', '$orderdate', '$product_id', '$product_qty', '$amount', '$supplier')";
    $result412 = mysql_query($query412) or die ('Data order cannot access. ' . mysql_error());
	
}
//insert to table po_num
$query41 = "INSERT INTO `po_num` ( `po`) 
VALUES ( '$pono')";
$result41 = mysql_query($query41) or die ('Data po_num cannot access. ' . mysql_error());
//insert to table po_exist
$query41 = "INSERT INTO `po_exist` ( `po_exist`) 
VALUES ( '$pono')";
$result41 = mysql_query($query41) or die ('Data po_exist cannot access. ' . mysql_error());
	

//after insert all record, delete record in temp_order
$sqlb = "SELECT * FROM temp_order WHERE session='$session'";
$resultb = mysql_query($sqlb) or die ('Data temp_order cannot be reach. ' . mysql_error());
while($rowb = mysql_fetch_array($resultb))
{
  $order_id=$rowb['id'];
  $sSql="DELETE FROM `temp_order` WHERE `id`='$order_id'";
  $result=mysql_query($sSql) or die ('Data claim cannot access. ' . mysql_error());
}

	echo "<script>alert('New PO successfully added!');";
	print "window.location='?p=vieworder2&poNo=$pono'";
	print "</script> ";

?>