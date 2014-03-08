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

$string=$_GET['string'];
$s_string = split(",",$string);

?>
<head>
<title>ABJJ Techno Solution</title>
	
<script type="text/javascript" src="../common/js/universal.js"></script>
<script type="text/javascript" src="../common/js/calendar.js"></script>
<script type="text/javascript" src="../common/js/calendarsetup.js"></script>
<script type="text/javascript" src="../common/js/calendar_en.js"></script>
<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
.style4 {color: #000000}
</style>
	
</head>

<body>

                <h3 align="center" class="style12"><span class="style29">Senarai Transaksi Produk Masuk</span></h3>
                <div align="center"></div>
                <!--under reorder level list-->
                <table width="100%" border="1" bordercolor="#996666" cellpadding="0" cellspacing="0" class="">
                  <tr bgcolor="#006633" class="style6">
                    <td width="2%" height="" bgcolor="#330000"><div align="center" class="style31"><span class="style3">No</span>.</div></td>
                    <td width="5%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>ID</strong></div></td>
                    <td width="23%" bgcolor="#330000"><div align="center" class="style31 style1"><strong>Nama Produk</strong></div></td>
                    <td width="5%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>No.Invois </strong></div></td>
                    <td width="9%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>Tarikh Terima</strong></div></td>
                    <td width="7%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>Kuantiti diterima</strong></div></td>
                    <td width="20%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>Pembekal</strong></div></td>
                    <td width="7%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>Kos seunit (RM)</strong></div></td>
                    <td width="7%" bgcolor="#330000"><div align="center" class="style1 style31"><strong>Diterima Dari</strong></div></td>
                  </tr>
                  <!-- to get data from database-->
                  <?php //to get data from table product where current quantity < ROL
					 require_once('../connection/data2.php');
		
					$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
					$maxRows_b = 5;
					$pageNum_b = 0;
					if (isset($HTTP_GET_VARS['pageNum_b'])) {
					  $pageNum_b = $HTTP_GET_VARS['pageNum_b'];
					}
					$startRow_b = $pageNum_b * $maxRows_b;

					mysql_select_db(SQL_DB, $conn);
					$query_b = "SELECT * FROM `stock_in` ORDER BY `date_in`";
					$query_limit_b = sprintf("%s LIMIT %d, %d", $query_b, $startRow_b, $maxRows_b);
					$b = mysql_query($query_limit_b, $conn) or die ('Data stock_in cannot be reach. ' . mysql_error());
					$row_b = mysql_fetch_assoc($b);

					if (isset($HTTP_GET_VARS['totalRows_b'])) {
					  $totalRows_b = $HTTP_GET_VARS['totalRows_b'];			
					} 
					else {
  						$all_b = mysql_query($query_b);
					  	$totalRows_b = mysql_num_rows($all_b);
						}
					$totalPages_b = ceil($totalRows_b/$maxRows_b)-1;

					$queryString_b = "";
					if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
					  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
					  $newParams = array();
					  foreach ($params as $param) {
				    if (stristr($param, "pageNum_b") == false && 
			        stristr($param, "totalRows_b") == false) {
				      array_push($newParams, $param);
    				}
  					}
					  if (count($newParams) != 0) {
				    $queryString_b = "&" . implode("&", $newParams);
  					}
					}
					$queryString_b = sprintf("&totalRows_b=%d%s", $totalRows_b, $queryString_b);
						?>
                  <?php	$i=1; do { ?>
                  <tr bgcolor="#FFFFFF" class="style7">
                    <td align="center"><span class="style32 style4"><? echo $i ?>.</span></td>
                    <td align="center"><span class="style32">PD0<? echo $row_b["product"]; ?></span></td>
                    <? 
		  	$id=$row_b["product"];
		  	$sql2 = "SELECT * FROM `t_product` where `id_product`='$id' ORDER BY `id_product`";
			$result2 = mysql_query($sql2) or die ('Data cannot be reach. ' . mysql_error());
			$record2 = mysql_fetch_array($result2); 
		?>
                    <td align="left"><span class="style32"><? echo $record2['productName']; ?></span></td>
                    <td align="center"><span class="style32"><? echo $row_b["no_invoice"]; ?></span></td>
                    <td align="center"><span class="style32"><? echo $row_b["date_in"]; ?></span></td>
                    <td align="center"><span class="style32"><? echo $row_b["qty_stock_in"]; ?>&nbsp;pcs</span></td>
                    <td align="left"><span class="style32"><? echo $record2["supplier"]; ?></span></td>
                    <td align="center"><span class="style32"><? echo number_format($record2["unitcost"],2,".",","); ?></span></td>
                    <td align="center"><span class="style32"><? echo $row_b["person_received"]; ?></span></td>
                  </tr>
                  <? $i++;} while ($row_b = mysql_fetch_assoc($b));?>
</table>
<table width="50%" border="0" align="center">
                  <tr>
                    <td width="23%" align="center"><?php if ($pageNum_b > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, 0, $queryString_b); ?>"></a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td width="31%" align="center"><?php if ($pageNum_b > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, max(0, $pageNum_b - 1), $queryString_b); ?>"><img src="../images/previous.png" border="0" /></a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, min($totalPages_b, $pageNum_b + 1), $queryString_b); ?>"><img src="../images/Next.png" border="0" /></a>
                        <?php } // Show if not last page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, $totalPages_b, $queryString_b); ?>"></a>
                        <?php } // Show if not last page ?>
                    </td>
                  </tr>
                </table>
<table width="537" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E5E5E5" 
				 class="style6">
                  <!--DWLayoutTable-->
                  <tr>
                    <td width="574" colspan="2" align="center"><form action="?p=productIn" method="post" id="form2">
                        <br />
                        <p class="style19">Pilih PO Untuk Produk Masuk</p>
                        <p class="style19">&nbsp;</p>
                      <table class="style7">
                          <tr>
                            <td align='right'><select name="po" id="po">
                                <option value="">- Select PO -</option>
                                <?   //when 1 PO already finish stock in, the PO wont show in the PO list for stock in 
						$sql = "SELECT * FROM po_exist WHERE complete=0 ORDER BY id";
						$result = mysql_query($sql) or die ('Data po_exist cannot be reach. ' . mysql_error());
						while($row = mysql_fetch_array($result))
						{
						  $po=$row['po_exist'];
						?>
                                <option value="<? echo $po;?>">PO<? echo $po;?></option>
                                <? }?>
                            </select></td>
                            <td align='right'><input name="ss" type="image" id="ss" value="Enter" src="../images/hantar.png" /></td>
                          </tr>
                      </table>
                    </form>
                        <?
if($ponumber==''){
?>
                        <? if($_SESSION["warningmsg1"]!=''){ ?>
                        <div align="center">
                      <font color="#FF0000"> <? echo $_SESSION["warningmsg1"]; }?>
                        <? $_SESSION["warningmsg1"]=''; ?>
                    </td>
                  </tr>
                  <tbody>
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
                  </tbody>
                  <tbody>
                    <tr>
                      <td height="28" colspan="2"><form action="save_Productin.php" method="post" id="form1">
                          <?
				$sqla = "SELECT * FROM `order` WHERE `po_num` = '$ponumber'";
				$resulta = mysql_query($sqla) or die ('Data po_num cannot be reach. ' . mysql_error());
				$rowa = mysql_fetch_array($resulta);
			    $supplier_id=$rowa['supplier'];
				
				  $sqlb = "SELECT * FROM `t_supplier` WHERE `id_supplier` = '$supplier_id'";
				  $resultb = mysql_query($sqlb) or die ('Data supplier cannot be reach. ' . mysql_error());
				  $rowb = mysql_fetch_array($resultb);	
				
				?>
                          <? if($_SESSION["warningmsg1"]!=''){ ?>
                          <div align="center"><font color="#FF0000"> <? echo $_SESSION["warningmsg1"]; }?>
                                <? $_SESSION["warningmsg1"]=''; ?>
                          </font> </div>
                        <table width="500" border="0" align="center">
                            <tr bgcolor="#006633">
                              <td colspan="3" bgcolor="#330000"><div align="center" class="style13 style9 style1"><strong>Pesanan Pembelian</strong></div></td>
                          </tr>
                            <tr class="style7">
                              <td width="110" class="style22"> Nombor PO</td>
                              <td width="3"><span class="style33">:</span></td>
                              <td width="373"><span class="style33">PO<? echo $ponumber?></span></td>
                            </tr>
                            <tr class="style7">
                              <td width="110"><span class="style33">No. Invois</span></td>
                              <td width="3"><span class="style33">:</span></td>
                              <td width="373"><input name="invoice_no" type="text" value="<? echo $_GET['invoice'];?>" /></td>
                            </tr>
                            <tr class="style7">
                              <td><span class="style33">Nama Syarikat </span></td>
                              <td><span class="style33">:</span></td>
                              <td><span class="style33"><? echo $rowb['companyname'];?></span></td>
                            </tr>
                            <tr class="style7">
                              <td><span class="style33">Alamat</span></td>
                              <td><span class="style33">:</span></td>
                              <td><span class="style33"><? echo $rowb['supAdd'];?></span></td>
                            </tr>
                            <tr class="style7">
                              <td><span class="style33">No. Telefon </span></td>
                              <td><span class="style33">:</span></td>
                              <td colspan="3"><span class="style33"><? echo $rowb['companyTel'];?></span></td>
                            </tr>
                            <tr class="style7">
                              <td><span class="style33">No. faks </span></td>
                              <td><span class="style33">:</span></td>
                              <td colspan="3"><span class="style33"><? echo $rowb['supFax'];?></span></td>
                            </tr>
                            <?
					  $s_date = split("-",$rowa['order_date']);
					  $orderdate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                            <tr class="style7">
                              <td><span class="style33">Tarikh Tempahan </span></td>
                              <td><span class="style33">:</span></td>
                              <td colspan="3"><span class="style33"><? echo $orderdate;?></span></td>
                            </tr>
                            <?
					  $s_date = split("-",$rowa['delivery_date']);
					  $deliverydate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                            <tr class="style7">
                              <td>Tarikh Terima</td>
                              <td><span class="style33">:</span></td>
                              <td><span class="style33">
                              <input type="text" id="txtsdeliverdate" name="deliverdate" maxlength="50"
			value="<?php echo $_GET['dd'];?>" size="20">
			<button type="submit" id="calendarbutton"><img src="../images/calendar.gif" width="16" height="16" border="0"></button>
				<script type="text/javascript">
				Calendar.setup({
				inputField    : "txtsdeliverdate",
				button        : "calendarbutton",
				align         : "Tr"
				});
				</script>
                              </span></td>
                            </tr>
                            <tr>
                              <td><span class="style32"></span></td>
                              <td><span class="style32"></span></td>
                              <td colspan="3"><span class="style32"></span></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#996666" class="style33">
                              <tr class="common1" bgcolor="#006633">
                                    <td width="5%"  align="center" bgcolor="#330000"><div align="center" class="style6 style1"><strong>No.</strong></div></td>
                                    <td width="15%" bgcolor="#330000"><div align="center" class="style6 style1"><strong>Id 
                                    Product</strong></div></td>
                                    <td width="35%" bgcolor="#330000"><div align="center" class="style6 style1"><strong>Name</strong></div></td>
                                    <td width="14%" bgcolor="#330000"><div align="center" class="style6 style1"><strong>Quantity 
                                    Order</strong></div></td>
                                    <td width="14%" bgcolor="#330000"><div align="center" class="style6 style1"><strong>Quantity 
                                    Received </strong></div></td>
                                    <td width="15%" bgcolor="#330000"><div align="center" class="style6 style1"><strong>Stock 
                                    In</strong></div></td>
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
								$product_id=$rowd['id_product'];								
								$product_name=$rowd['productName'];
								$product_unitcost=$rowd['unitcost'];
				?>
                                  <tr bgcolor="#FFFFFF" class="common1">
                                    <td align="center"><? echo $record;?></td>
                                    <td align="center" >PD0<? echo $rowc['product'];?></td>
                                    <td><? echo $product_name;?></td>
                                    <td align="center" ><? echo $rowc['qty'];?></td>
                                    <td align="center" ><? echo $rowc['qty_received'];?></td>
                                    <td align="center" ><? if ($rowc['qty']==$rowc['qty_received']) { ?>
                                        <input name="qty[]" type="text" size="4" value="0" />
                                      <? } else {?>
                                      <input name="qty[]" type="text" size="4" value="<? echo $s_string[($record-1)];?>" />
                                      <? }?>
                                      &nbsp;</td>
                                  </tr>
                                  <? }?>
                                  <tr valign="bottom">
                                    <td colspan="6" height="40"><div align="center">
                                        <input name="total" type="hidden" value="<? echo $record?>" />
                                        <input name="ponum" type="hidden" value="<? echo $ponumber?>" />
                                      <input type="image" name="Submit" value="Submit" onClick=" return checkpo()" src="../images/hantar.png"/>
                                      <a href="?p=productIn"><img src="../images/kembali.png" border="0" align="top" /></a>                                      &nbsp;<a href="?p=view-transaction&po=<? echo $ponumber?>" target="_blank">View Transaction</a></div></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table>
                      </form></td>
                    </tr>
                    <? }?>
                  </tbody>
</table>
              <p>
              
</body>
</html>
