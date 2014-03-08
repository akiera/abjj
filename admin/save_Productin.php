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

$ponum=$_POST['ponum'];
$invoice_no=$_POST['invoice_no'];
$deliverdate=$_POST['deliverdate'];
$s_date = split("/",$deliverdate);
$finddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";
$qtyin=$_POST['qty'];
$total=$_POST['total'];


//Put insert qty in string for back to product in page.
$string='';
for($a=0;$a<$total;$a++)
{
  $string.=$qtyin[$a];
  $string.=",";
}

//check error
$record=0;
$sqlc = "SELECT * FROM `order` WHERE `po_num` = '$ponum' ORDER BY id";
$resultc = mysql_query($sqlc) or die ('Data po_num cannot be reach. ' . mysql_error());
while($rowc = mysql_fetch_array($resultc))
{
  
  $qty=$rowc['qty'];
  $qty_received=$rowc['qty_received'];
  $qty_left=$qty-$qty_received;
  
  //*********
  if($qtyin[$record]==null)
  {
  //set warning msg 1
  $_SESSION["warningmsg1"] = "!!Please insert the quantity!!";
  header("Location: productIn.php?poNo=$ponum&string=$string&invoice=$invoice_no&dd=$deliverdate");
  exit();
  break;
  }
  //$record++;

  //if qty insert > qty left
  if($qtyin[$record]>$qty_left)
  {
  //set warning msg 1
  $_SESSION["warningmsg1"] = "Invalid quantity insert";
  header("Location: productIn.php?poNo=$ponum&string=$string&invoice=$invoice_no&dd=$deliverdate");
  exit();
  break;
  }
  $record++;
}

//insert record to stock in and update table order
$record=0;
$sqlc = "SELECT * FROM `order` WHERE `po_num` = '$ponum' ORDER BY id";
$resultc = mysql_query($sqlc) or die ('Data po_num cannot be reach. ' . mysql_error());

while($rowc = mysql_fetch_array($resultc))
{
    $order_id=$rowc['id'];
	$order_qty_received=$rowc['qty_received'];
	$order_product=$rowc['product'];
	if($qtyin[$record]!=''||$qtyin[$record]!=0)
	{
	$query412 = "INSERT INTO `stock_in` ( `date_in`,`order_id`,`no_invoice`,`nopo`,`product`,`qty_stock_in`,`person_received`) 
	VALUES ( '$finddate','$order_id','$invoice_no','$ponum','$order_product','".$qtyin[$record]."','".$_SESSION['staff_name']."')";
	$result412 = mysql_query($query412) or die ('Data stock_in cannot access. ' . mysql_error());
    }
	$qtyupdate=$order_qty_received+$qtyin[$record];

	$query1000="UPDATE `order` SET `qty_received` = '$qtyupdate' WHERE `id` = '$order_id'";
    $result1000=mysql_query($query1000) or die ('Data order cannot access. ' . mysql_error());
	
	//**************update record table product
	$sqld = "SELECT * FROM `t_product` WHERE `id_product` = '$order_product' ORDER BY id_product";
	$resultd = mysql_query($sqld) or die ('Data product cannot be reach. ' . mysql_error());
	$rowd = mysql_fetch_array($resultd);

	$current_qty=$rowd['current_qty'];
	$qtyupdate2=$current_qty+$qtyin[$record];

	$query99="UPDATE `t_product` SET `current_qty` = '$qtyupdate2' WHERE `id_product` = '$order_product'";
    $result99=mysql_query($query99) or die ('Data product cannot access. ' . mysql_error());
    $record++;

}

$_SESSION["warningmsg1"] = "Stok berjaya dimasukkan.";

//Insert table stock_in_transaction
$query412 = "INSERT INTO `stock_in_transaction` ( `po`,`invoice`) 
VALUES ( '$ponum','$invoice_no')";
$result412 = mysql_query($query412) or die ('Data stock_in_transaction cannot access. ' . mysql_error());

//update table po_exist, if all product received, not need show in product in page.
$complete="yes";
$sqlc = "SELECT * FROM `order` WHERE `po_num` = '$ponum' ORDER BY id";
$resultc = mysql_query($sqlc) or die ('Data po_num cannot be reach. ' . mysql_error());
while($rowc = mysql_fetch_array($resultc))
{
	$order_qty_received=$rowc['qty_received'];
	$order_qty=$rowc['qty'];
	if($order_qty!=$order_qty_received)
	{
	  $complete="no";
	}
}
if($complete=="yes")
{
  $query1000="UPDATE `po_exist` SET `complete` = '1' WHERE `po_exist` = '$ponum'";
  $result1000=mysql_query($query1000) or die ('Data po_exist cannot access. ' . mysql_error());
  $_SESSION["warningmsg1"].="<br>Stok dalam PO telah habis dimasukkan.";
}

 header("Location: index.php?p=productIn");
 exit();
							 						
?>
