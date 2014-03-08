<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
}

include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['staff_ic'] = $record1["user_ic"];


$query2= mysql_query("SELECT * FROM t_staff WHERE staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record1["user_ic"];


$nama = $_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

$ponumber=$_GET['po'];

?>

	<title>E Mart Solution</title>
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
    </style>
    <body>

   <?
				$sqla = "SELECT * FROM `order` WHERE `po_num` = '$ponumber'";
				$resulta = mysql_query($sqla) or die ('Data po_num cannot be reach. ' . mysql_error());
				$rowa = mysql_fetch_array($resulta);
			    $supplier_id=$rowa['supplier'];
				
				  $sqlb = "SELECT * FROM `t_supplier` WHERE `id_supplier` = '$supplier_id'";
				  $resultb = mysql_query($sqlb) or die ('Data supplier cannot be reach. ' . mysql_error());
				  $rowb = mysql_fetch_array($resultb);	
				
				?>
                <form action="save_Productin.php" method="post">
                  <br />
                  <table width="500" border="0" align="center" class="style7">
                    <tr bgcolor="#E1E1FF">
                      <td colspan="3" bgcolor="#330000"><div align="center" class="style14 style1"><strong>Pembayaran Tempahan</strong></div></td>
                    </tr>
                    <tr>
                      <td width="105">No. PO </td>
                      <td width="5">:</td>
                      <td width="376">PO<? echo $ponumber?></td>
                    </tr>
                    <tr>
                      <td>Nams Syarikat</td>
                      <td>:</td>
                      <td><? echo $rowb['companyname'];?></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><? echo $rowb['supAdd'];?></td>
                    </tr>
                    <tr>
                      <td>No. Tel </td>
                      <td>:</td>
                      <td colspan="3"><? echo $rowb['companyTel'];?></td>
                    </tr>
                    <tr>
                      <td>No. Faks</td>
                      <td>:</td>
                      <td colspan="3"><? echo $rowb['supFax'];?></td>
                    </tr>
                    <?
					  $s_date = split("-",$rowa['order_date']);
					  $orderdate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                    <tr>
                      <td>Tarikh Pesanan</td>
                      <td>:</td>
                      <td colspan="3"><? echo $orderdate;?></td>
                    </tr>
                    <?
					  $s_date = split("-",$rowa['delivery_date']);
					  $deliverydate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3"><table width="100%"  border="1" bordercolor="#996666" cellspacing="0" cellpadding="0" align="center" class="style7">
                          <tr class="common1" bgcolor="#FFFFCC">
                            <td width="18%" height="25" align="center"><div align="center"><strong>Tarikh Stok Masuk</strong></div></td>
                            <td width="17%"><div align="center"><strong>No.Invois 
                            </strong></div></td>
                            <td width="46%"><div align="center"><strong>Butir-butir</strong></div></td>
                            <td width="19%"><div align="center"><strong>Dimasukkan Oleh</strong></div></td>
                          </tr>
                          <?
				$rr=0;
				$sqlc = "SELECT * FROM `stock_in_transaction` WHERE `po` = '$ponumber' ORDER BY id";
				$resultc = mysql_query($sqlc) or die ('Data stock_in_transaction cannot be reach. ' . mysql_error());
				while($rowc = mysql_fetch_array($resultc))
				{
				 $rr++;
				 $invoice=$rowc['invoice'];
				                //get details
							  	$sqld = "SELECT * FROM stock_in WHERE no_invoice ='$invoice'";
				 				$resultd = mysql_query($sqld) or die ('Data stock_in cannot be reach. ' . mysql_error());
			     				$rowd = mysql_fetch_array($resultd);
								$date_in=$rowd['date_in'];
								
					  $s_date = split("-",$date_in);
					  $orderdate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					 
								$person_received=$rowd['person_received'];
				?>
                          <tr valign="top" class="common1">
                            <td width="18%" height="25" align="center" valign="middle"><? echo $date_in;?></td>
                            <td width="17%" align="center" valign="middle"><? echo $invoice;?></td>
                            <td width="46%" valign="middle"><?
							  	$sqldd = "SELECT * FROM stock_in WHERE no_invoice ='$invoice' ORDER BY id";
				 				$resultdd = mysql_query($sqldd) or die ('Data stock_in cannot be reach. ' . mysql_error());
			     				while($rowdd = mysql_fetch_array($resultdd))
								{
								 $product=$rowdd['product'];
								 $qty_stock_in=$rowdd['qty_stock_in'];
								 	$sqlf = "SELECT * FROM t_product WHERE id_product ='$product'";
				   				    $resultf = mysql_query($sqlf) or die ('Data product cannot be reach. ' . mysql_error());
			     				    $rowf = mysql_fetch_array($resultf);
								    $product_name=$rowf['productName'];
									
									echo $product_name;
									echo " - ";
									echo $qty_stock_in;
									echo "<br>";
								}
							  ?>                            </td>
                            <td width="19%" align="center" valign="middle"><? echo $person_received;?></td>
                          </tr>
                          <? }?>
                          <? if($rr==0){?>
                          <tr class="common1">
                            <td colspan="4" height="25" align="center">Tiada Rekod Transaksi</td>
                          </tr>
                          <? }?>
                      </table></td>
                    </tr>
                  </table>
                </form>
                <table width="50%" border="0" align="center">
                </table>
          </div>
        </div>
      </div>
    </div>


</body>
</html>
