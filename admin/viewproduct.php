<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$txtProductID =$_GET['id_product'];
$query1= "SELECT * FROM t_product WHERE id_product ='$txtProductID'"; 
$result1 = mysql_query($query1) or die ('Data product cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("id_product");
$_SESSION['txtProductID'] = $record1["id_product"];

$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>
	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
    </style>
    <body>

  
                <h2 class="style12">&nbsp;</h2>
                <form action="?p=edit_Product" method="post" id="form1">
                  <table width="417" border="0" align="center"  bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bordercolor="#FFFFFF">
                      <td colspan="3" bgcolor="#330000"><div align="center" class="style1">Maklumat Stok</div></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td width="117" height="25" bgcolor="#99FF66"><span class="style18">ID Stok</span></td>
                  
                      <td width="258" bgcolor="#99FF66"><span class="style15">PD0<? echo $record1["id_product"]; ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style18">Nama Produk</span></td>
                    
                      <td bgcolor="#00FFFF"><span class="style15"><? echo $record1["productName"]; ?>&nbsp; </span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style18">Kategori</span></td>
                      
                      <td bgcolor="#99FF66"><span class="style15"><? echo $record1["category"]; ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style18">Pembekal</span></td>
                     
                      <td width="28" bgcolor="#00FFFF"><span class="style15"><? echo $record1["supplier"]; ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style18">Kos Seunit</span></td>
                     
                      <td bgcolor="#99FF66"><span class="style15">RM <? echo number_format($record1["unitcost"],2,".",","); ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style18">Kos Pegangan</span></td>
                      
                      <td bgcolor="#00FFFF"><span class="style15">RM <? echo number_format($record1["holdingcost"],2,".",","); ?></span></td>
                    </tr>
 					<tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style18">Aras Pesanan Semula</span></td>
                
                      <td bgcolor="#99FF66"><? echo $record1["ROL"]; ?></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style18">Masa Lopor</span></td>
                      
                      <? $LT=round((($record1["leadtime"])*52/12),0);?>
                      <td bgcolor="#00FFFF"><span class="style15"><? echo $LT; ?> <? echo $record1["weekmonthlt"]; ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66">Masa Kitaran</td>
                     
                      <? $CT=round((($record1["cycletime"])*52/12),0);?>
                      <td bgcolor="#99FF66"><span class="style15"><? echo $CT; ?> <? echo $record1["weekmonthct"]; ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style18">Harga Jualan </span></td>
                      
                      <td bgcolor="#00FFFF"><span class="style15">RM <? echo number_format($record1["sellingprice"],2,".",","); ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style18">Kuantiti</span></td>
                      
                      <td bgcolor="#99FF66"><span class="style15"><? echo $record1["current_qty"]; ?></span></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table align="center">
                    <tr>
                      <td width="80" height="30" align="center"><input type="hidden" name="id_product" value="<? echo $record1["id_product"]; ?>" />
                          <input type="image" name="productSubmit" value="Edit" onClick="return submit_product()" src="../images/kemaskini.png"/>
                      </td>
                      <td width="80"><a href='delete_Product.php?id_product=<? echo $record1["id_product"]; ?>' onClick="return confirm_del()"><img src="../images/hapus.png" border="0" /></a></td>
                      <td width="80"><a href="?p=product_list"><img src="../images/kembali.png" border="0" align="absmiddle" /></a></td>
                    </tr>
                  </table>
                </form>
                <table width="50%" border="0" align="center">
                </table>
                <p class="style13">&nbsp;</p>
                </div>
      </div>
</body>
</html>
