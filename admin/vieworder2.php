<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
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

$ponumber=$_POST['po'];
if($ponumber=='')
{ $ponumber=$_GET['poNo']; }

$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript" src="../common/js/universal.js"></script>
<script type="text/javascript" src="../common/js/calendar.js"></script>
<script type="text/javascript" src="../common/js/calendarsetup.js"></script>
<script type="text/javascript" src="../common/js/calendar_en.js"></script>
	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
    </style>
</head>

<body>

              
                <table width="50%" border="0" align="center">
                </table>
                		  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E5E5E5" 
					 class="style6">
                            <!--DWLayoutTable-->
                            <tr>
                              <td colspan="2" align="center"><form action="?p=vieworder2" method="post" id="form2">
                                  <table class="style7">
                                    <tr>
                                      <td align='right'>&nbsp;</td>
                                      <td align='right'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td align='right'><select name="po" id="po">
                                          <option value="">--Pilih PO--</option>
                                          <? //////////////////////*******
		$start_date=$_POST['startdate'];
		$s_date = split("/",$startdate);
		$startdate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";
		
		$end_date=$_POST['enddate'];
		$s_date = split("/",$enddate);
		$enddate="".$s_date[2]."-".$s_date[1]."-".$s_date[0]."";

		$sql = "SELECT  DISTINCT `po_num` FROM `order` WHERE (`order_date` BETWEEN '$startdate' AND '$enddate') order by `order_date`";
		$result = mysql_query($sql) or die ('Data stock_in cannot be reached. ' . mysql_error());
		while($row = mysql_fetch_array($result))
		{
		$po=$row['po_num'];

		//$sql2 = "SELECT * FROM `t_product`";
		//$result2 = mysql_query($sql2) or die ('Data product cannot be reach. ' . mysql_error());
		//$row2=mysql_fetch_array($result2);
		//$productname=$row2["productName"];
						
						//***************************
						//$sql = "SELECT  * FROM po_exist ORDER BY id";
						//$result = mysql_query($sql) or die ('Data po_exist cannot be reach. ' . mysql_error());
						//while($row = mysql_fetch_array($result))
						//{
						 // $po=$row['po_exist'];
						?>
                                          <option value="<? echo $po;?>">PO<? echo $po;?></option>
                                          <? }?>
                                      </select></td>
                                      <td align='right'><input name="ss" type="image" id="ss" value="papar PO" src="../images/papar po.png"/></td>
                                  </tr>
                                  </table>
                              </form>
                                  <?
if($ponumber==''){
?>
                              </td>
                            </tr>
                		    <tr valign="top" class="style7">
                              <td colspan="4"><p>&nbsp;</p>
                                  <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p></td>
              		      </tr>
                            <? } else { ?>
                            <tr>
                              <td height="28" colspan="2"><form action="" method="get">
                                  <?
				$sqla = "SELECT * FROM `order` WHERE `po_num` = '$ponumber'";
				$resulta = mysql_query($sqla) or die ('Data po_num cannot be reach. ' . mysql_error());
				$rowa = mysql_fetch_array($resulta);
			    $supplier_id=$rowa['supplier'];
				$staff_id=$rowa['order_by'];
				
				  $sqlb = "SELECT * FROM `t_supplier` WHERE `id_supplier` = '$supplier_id'";
				  $resultb = mysql_query($sqlb) or die ('Data supplier cannot be reach. ' . mysql_error());
				  $rowb = mysql_fetch_array($resultb);	
				  
				  $sqlc = "SELECT * FROM `t_staff` WHERE `staff_ic` = '$staff_id'";
				  $resultc = mysql_query($sqlc) or die ('Data supplier cannot be reach. ' . mysql_error());
				  $rowc = mysql_fetch_array($resultc);	
				  
				
				?>
                                  <table width="500" border="0" align="center" class="style7">
                                    <tr bgcolor="#006633">
                                      <td height="25" colspan="3" bgcolor="#330000" ><div align="center" class="style30 style1"><strong>Pembelian Pesanan</strong></div></td>
                                    </tr>
                                    <tr>
                                      <td width="118"><span class="style40">No. PO </span></td>
                                      <td width="20"><span class="style40">:</span></td>
                                      <td width="464"><span class="style40">PO<? echo $ponumber?></span></td>
                                    </tr>
                                    <tr>
                                      <td>Nama Syarikat</td>
                                      <td><span class="style40">:</span></td>
                                      <td><span class="style40"><? echo $rowb['companyname'];?></span></td>
                                    </tr>
                                    <tr>
                                      <td><span class="style40">Alamat</span></td>
                                      <td><span class="style40">:</span></td>
                                      <td><span class="style40"><? echo $rowb['supAdd'];?>, <? echo $rowb['supPostcode'];?> <? echo $rowb['supTown'];?>, <? echo $rowb['supState'];?> </span></td>
                                    </tr>
                                    <tr>
                                      <td><span class="style40">No. Tel </span></td>
                                      <td><span class="style40">:</span></td>
                                      <td colspan="3"><span class="style40"><? echo $rowb['companyTel'];?></span></td>
                                    </tr>
                                    <tr>
                                      <td><span class="style40">No. Faks</span></td>
                                      <td><span class="style40">:</span></td>
                                      <td colspan="3"><span class="style40"><? echo $rowb['supFax'];?></span></td>
                                    </tr>
                                    <?
					  $s_date = split("-",$rowa['order_date']);
					  $orderdate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                                    <tr>
                                      <td><span class="style40">Tarikh Pesanan</span></td>
                                      <td><span class="style40">:</span></td>
                                      <td colspan="3"><span class="style40"><? echo $orderdate;?></span></td>
                                    </tr>
                                    <?
					  $s_date = split("-",$rowa['delivery_date']);
					  $deliverydate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                                    <tr>
                                      <td><span class="style40">Pesanan dari</span></td>
                                      <td><span class="style40">:</span></td>
                                      <td colspan="3"><span class="style40"><? echo $rowc['staff_name'];?></span></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3"><table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#996666" class="style7 style29">
                                          <tr bgcolor="#006633" class="common1">
                                            <td width="5%" height="25" align="center" bgcolor="#330000"><div align="center" class="style1 style35"><strong>No</strong></div></td>
                                            <td width="13%" bgcolor="#330000" ><div align="center" class="style35 style1"><strong>ID Stok</strong></div></td>
                                            <td width="41%" bgcolor="#330000" ><div align="center" class="style35 style1"><strong>Nama Stok</strong></div></td>
                                            <td width="12%" bgcolor="#330000" ><div align="center" class="style35 style1"><strong>Kuantiti</strong></div></td>
                                            <td width="15%" bgcolor="#330000" ><div align="center" class="style1 style35"><strong>Harga (RM</strong>)</div></td>
                                            <td width="14%" bgcolor="#330000" ><div align="center" class="style35 style1"><strong>Amaun (RM)</strong></div></td>
                                        </tr>
                                          <?
				$record=0;
				$sqlc = "SELECT * FROM `order` WHERE `po_num` = '$ponumber' ORDER BY id";
				$resultc = mysql_query($sqlc) or die ('Data po_num cannot be reach. ' . mysql_error());
				while($rowc = mysql_fetch_array($resultc))
				{
				 $record++;
				 $total+=$rowc['amount'];
				                //get product name
							  	$sqld = "SELECT * FROM t_product WHERE id_product ='".$rowc['product']."'";
				 				$resultd = mysql_query($sqld) or die ('Data product cannot be reach. ' . mysql_error());
			     				$rowd = mysql_fetch_array($resultd);
								$product_name=$rowd['productName'];
								$product_unitcost=$rowd['unitcost'];
								$unit=$rowd['unit'];
				?>
                                          <tr bgcolor="#FFFFFF" class="common1">
                                            <td width="5%" height="25" align="center" valign="middle"><span class="style37"><? echo $record;?></span></td>
                                            <td width="13%" align="center" valign="middle"><span class="style37">PD0<? echo $rowc['product'];?></span></td>
                                            <td width="41%"><span class="style37"><? echo $product_name;?></span></td>
                                            <td width="12%" align="center" valign="middle"><span class="style37"><? echo $rowc['qty'];?>&nbsp;pcs</span></td>
                                            <td width="15%" align="right" valign="middle"><span class="style37"><? echo number_format($product_unitcost, 2, ".", ",");?>&nbsp;</span></td>
                                            <td width="14%" align="right" valign="middle"><span class="style37"><? echo number_format($rowc['amount'], 2, ".", ",");?>&nbsp;&nbsp;</span></td>
                                        </tr>
                                          <? }?>
                                          <tr class="common1">
                                            <td height="25" colspan="4" align="center"><span class="style38"></span></td>
                                            <td align="center" valign="middle"><span class="style38"><strong>Jumlah</strong></span></td>
                                            <td align="right" valign="middle"><span class="style38"><? echo number_format($total, 2, ".", ",");?>&nbsp;&nbsp;</span></td>
                                          </tr>
                                          <tr valign="top">
                                            <td colspan="6"><div align="center"><a href="../admin/po_print.php?noPo=<? echo $ponumber; ?>" target="_blank"> <img src="../images/cetak.png" border="0" align="top" /></a>&nbsp; <a href="?p=vieworder"><img src="../images/kembali.png" border="0" align="top" /></a> </div></td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                  </table>
                              </form></td>
                            </tr>
                            <? }?>
                            <tr>
                              <td height="19" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                		  <p class="style13">&nbsp;</p>
     
</body>
</html>
