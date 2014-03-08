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


$product_id=$_POST['product_id'];
$qty_out=$_POST['qty_out'];
$solddate=$_POST['solddate'];
$s_date = split("/",$solddate);
$finddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";


	$query3 = "SELECT * FROM `t_product` WHERE `id_product`='$product_id'";
	$result3 = mysql_query($query3) or die ('Data product cannot be reach. ' . mysql_error());
	$record3 = mysql_fetch_array($result3);
    $currentqty=$record3["current_qty"];
	$productname=$record3["productName"];
			
	$query4 = "SELECT * FROM `inventory` WHERE `id_product`='$product_id'";
	$result4 = mysql_query($query4) or die ('Data inventory cannot be reach. ' . mysql_error());
	$record4 = mysql_fetch_array($result4);
			
    $jan=$record4["jan"];
	$feb=$record4["feb"];
	$mar=$record4["march"];
	$apr=$record4["april"];
	$may=$record4["may"];
	$jun=$record4["jun"];
	$jul=$record4["july"];
	$aug=$record4["aug"];
	$sep=$record4["sep"];
	$oct=$record4["oct"];
	$nov=$record4["nov"];
	$dec=$record4["dec"];
			
$qty_new = $currentqty - $qty_out;
$sql_stmnt = "UPDATE `t_product` SET `current_qty`='$qty_new' WHERE `id_product`='$product_id'";
$record_result = mysql_query($sql_stmnt) or die ('Data product cannot be reach. ' . mysql_error());


//****************insert into the stock out table
 $sql_stmnt2 = "INSERT INTO `stock_out` (`id_product`,`qty_out`,`date_out`,`person_out`) 
 			VALUES ('$product_id','$qty_out','$finddate','".$_SESSION['staff_name']."')";
 $record_result2 = mysql_query($sql_stmnt2) or die ('Data stock_out cannot be reach. ' . mysql_error());
 

//insert into inventory table
if ($s_date[1]=='01')
{ 
   $new_qty = $jan + $qty_out;
   $query6 = "UPDATE `inventory` SET `jan`='$qty_out' WHERE `id_product`='$product_id'";
   $result6 = mysql_query($query6) or die ('Data inventory cannot be reach. ' . mysql_error());

  //update the total quantity
  $totalqty=$new_qty+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());
} 

if ($s_date[1]=='02')
{
  $new_qty = $feb + $qty_out;
  $query6 = "UPDATE `inventory` SET `feb`='$new_qty' WHERE `id_product`='$product_id'";
  $result6 = mysql_query($query6) or die ('Data inventory cannot be reach. ' . mysql_error());  
  $record6 = mysql_fetch_array($result6);

  //update the total quantity
  $totalqty=$jan+$new_qty+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());
} 

if ($s_date[1]=='03')
{
  $new_qty = $mar + $qty_out;
  $query6 = "UPDATE `inventory` SET `march`='$new_qty' WHERE `id_product`='$product_id'";
  $result6 = mysql_query($query6) or die ('Data inventory cannot be reach. ' . mysql_error()); 
  
  //update the total quantity
  $totalqty=$jan+$feb+$new_qty+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());
} 

if ($s_date[1]=='04')
{
  $new_qty = $apr + $qty_out;
  $query7 = "UPDATE `inventory` SET `april`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  
  
  //update the total quantity
  $totalqty=$jan+$feb+$mar+$new_qty+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());  
} 

if ($s_date[1]=='05')
{
  $new_qty = $may + $qty_out;
  $query7 = "UPDATE `inventory` SET `may`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$new_qty+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='06')
{
  $new_qty = $jun + $qty_out;
  $query7 = "UPDATE `inventory` SET `jun`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$new_qty+$jul+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='07')
{
  $new_qty = $jul + $qty_out;
  $query7 = "UPDATE `inventory` SET `july`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$jun+$new_qty+$aug+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='08')
{
  $new_qty = $aug + $qty_out;
  $query7 = "UPDATE `inventory` SET `aug`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$jun+$jul+$new_qty+$sep+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='09')
{
  $new_qty = $sep + $qty_out;
  $query7 = "UPDATE `inventory` SET `sep`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$new_qty+$oct+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='10')
{
  $new_qty = $oct + $qty_out;
  $query7 = "UPDATE `inventory` SET `oct`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$new_qty+$nov+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='11')
{
  $new_qty = $nov + $qty_out;
  $query7 = "UPDATE `inventory` SET `nov`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$new_qty+$dec;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 
if ($s_date[1]=='12')
{
  $new_qty = $dec + $qty_out;
  $query7 = "UPDATE `inventory` SET `dec`='$new_qty' WHERE `id_product`='$product_id'";
  $result7 = mysql_query($query7) or die ('Data inventory cannot be reach. ' . mysql_error());  

  //update the total quantity
  $totalqty=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$new_qty;
  $query8 = "UPDATE `inventory` SET `total_out`='$totalqty' WHERE `id_product`='$product_id'";
  $result8 = mysql_query($query8) or die ('Data inventory cannot be reach. ' . mysql_error());

} 

echo "<script>alert('Stok Keluar Berjaya!');";
print "window.location='index.php?p=productOut'";
print "</script> ";

?>


