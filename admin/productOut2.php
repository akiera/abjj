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
$solddate=$_POST['solddate'];
$product=$_POST['product'];
$qty=$_POST['qty'];
$update_session=$_POST['session'];
$qty_out=$_POST['qty_out'];
$id_product=$_POST['id_product'];



?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="../common/js/universal.js"></script>
<script type="text/javascript" src="../common/js/calendar.js"></script>
<script type="text/javascript" src="../common/js/calendarsetup.js"></script>
<script type="text/javascript" src="../common/js/calendar_en.js"></script>
	<title>E Mart Solution</title>


<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
    </style>
	<style media="all" type="text/css">
	@import "menu_style.css";    .style12 {font-size: 24px}
.style12 {font-size: 24px}
.style13 {font-size: 24px; font-weight: bold; }
.style13 {font-size: 24px; font-weight: bold; }
.style24 {font-family: Georgia, "Times New Roman", Times, serif}
    .style14 {    font-size: 18px;
	color: #FF0000;
}
.style39 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style40 {font-weight: bold; color: #FFFFFF;}
.style41 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.style42 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; }
.style43 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; }
    </style>
	<script language="JavaScript" type="text/JavaScript">
function doBlink() {
// Blink, Blink, Blink...
var blink = document.all.tags("BLINK")
for (var i=0; i < blink.length; i++)
blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
}
function startBlink() {
// Make sure it is IE4
if (document.all)
setInterval("doBlink()",1000)
}
window.onload = startBlink;
</script>
</head>

<body>

         
                <h2 class="style12">&nbsp;</h2>
              
                <table width="50%" border="0" align="center">
                </table><form name="?p=productOut" method="post" action="save_Product_Out.php">
                <table border="0" align="center" class="style7">
                  <?php
                      			//get product name
							  	$sqlc = "SELECT * FROM t_product WHERE id_product ='$id_product'";
				 				$resultc = mysql_query($sqlc) or die ('Data product cannot be reach. ' . mysql_error());
			     				$rowc = mysql_fetch_array($resultc);
								$product_id=$rowc['id_product'];
								$product_name=$rowc['productName'];
								$product_unitcost=$rowc['unitcost'];
								//$amount=$product_qty*$product_unitcost;
								//$total+=$amount;
								?>
                  <? if($rowc['current_qty']<$qty_out){?>
                  <tr class="style14">
                    <td height="25" colspan="4"><div align="center"><blink><span class="style24">*Stok semasa untuk produk <? echo $product_name; ?> tidak mencukupi.</span></blink><span class="style24"></font></span></div></td>
                  </tr> <? }?>
                  <tr class="style7">
                    <td height="25" colspan="4" bgcolor="#330000"><div align="center" class="style39"><span class="style40"> Maklumat Produk keluar</span></div></td>
                  </tr>
                 
                  <tr class="style7">
                    <td width="130" height="25"><span class="style41">&nbsp;
                    </th>                    
                      </span></td>
                    <td width="120"><span class="style42">ID Produk </span></td>
                    <td width="15"><span class="style43">:</span></td>
                    <td width="215"><span class="style43">PD0<? echo $product_id; ?></span></td>
                  </tr>
                  <tr class="style7">
                    <td width="130" height="25"><span class="style41">&nbsp;
                    </th>                    
                      </span></td>
                    <td width="120"><span class="style42">Nama Produk  </span></td>
                    <td width="15"><span class="style43">:</span></td>
                    <td width="215"><span class="style43"><? echo $product_name; ?></span></td>
                  </tr>
                  <tr>
                    <td width="130" height="25"><span class="style41">&nbsp;
                    </th>                    
                      </span></td>
                    <td><span class="style42">Pembekal</span></td>
                    <td><span class="style43">:</span></td>
                    <td width="215"><span class="style43"><? echo $rowc['supplier']; ?></span></td>
                  </tr>
                  <tr>
                    <td width="130" height="25"><span class="style41">&nbsp;
                    </th>                    
                      </span></td>
                    <td><div align="left" class="style42">Kos Seunit</div></td>
                    <td width="15"><span class="style43">:</span></td>
                    <td width="215"><span class="style43">RM <? echo number_format($rowc['unitcost'], 2, ".", ",");?></span></td>
                  </tr>
                  <? if($rowc['current_qty']<$qty_out){
					  
						echo "<script type='text/javascript'>alert('Kuantiti semasa untuk stok ini tidak mencukupi. Sila buat pesanan!');</script>";?>
                  <tr class="style7">
                    <td height="25"><span class="style41"><font color="#FF0000">&nbsp;
                      </th>
                    </font> </span></td>
                    <td><div align="left" class="style41"><font color="#FF0000"><blink>Kuantiti Semasa</blink></font></div></td>
                    <td width="15"><span class="style39"><font color="#FF0000">:</font></span></td>
                    <td width="215"><span class="style39"><font color="#FF0000"><blink><? echo $rowc['current_qty']; ?></blink>&nbsp;</font></span></td>
                  </tr>
                  <? }else{ ?>
                  <tr class="style7">
                    <td height="25"><span class="style42">&nbsp;
                    </th>                    
                      </span></td>
                    <td><div align="left" class="style42">Kuantiti Semasa</div></td>
                    <td width="15"><span class="style43">:</span></td>
                    <td width="215"><span class="style43"><? echo $rowc['current_qty']; ?>&nbsp;</span></td>
                  </tr>
                  <? }?>
                  <tr>
                    <td height="25"><span class="style42">&nbsp;
                    </th>                    
                      </span></td>
                    <td><div align="left" class="style42">Kuantiti Keluar</div></td>
                    <td width="15"><span class="style43">:</span></td>
                    <td width="215"><span class="style43"><? echo $qty_out; ?></span></td>
                  </tr>
                  <tr class="style7">
                    <td height="25"><span class="style42">&nbsp;
                    </th>                    
                      </span></td>
                    <td><div align="left" class="style42">Tarikh Keluar</div></td>
                    <td width="15"><span class="style43">:</span></td>
                    <td width="215"><span class="style43"><? echo $solddate; ?></span></td>
                  </tr>
                  <tr>
                    <td colspan="4" align="center" height="60"><strong>
                      <input name="product_id" type="hidden" value="<? echo $product_id?>" />
                        <input name="qty_out" type="hidden" value="<? echo $qty_out?>" />
                        <input name="solddate" type="hidden" value="<? echo $solddate; ?>" />
                        <? if($qty_out<=$rowc['current_qty']){?>
                        <input type="image" name="confirm" value="Confirm" src="../images/ok.png" />
                        <? }?>
                        <a href="?p=productOut&category=<? echo $category?>&amp;id_product=<? echo $id_product?>&amp;qtypro=<? echo $qty_out; ?>&amp;datesold=<? echo $solddate; ?>"> <img src="../images/kembali.png" border="0" align="top" /></a> </strong></td>
                  </tr>
                </table>
                </form>
                <p class="style13">&nbsp;</p>
                <div class="clear"> </div>
              </div>
            </div>
            <div id="gbox-bot"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
</html>
