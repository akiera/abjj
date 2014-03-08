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
$_SESSION['username']=$record1["username"];


$id_product=$_POST['id_product'];

$query20= "SELECT * FROM t_product WHERE id_product ='$id_product'"; 
$result20 = mysql_query($query20) or die ('Data product cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("id_product");
$_SESSION['id_product'] = $record20["id_product"];


$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>

<head>
	<title>ABJJ Techno Solution</title>
<script type="text/javascript" src="js/check_edit_Staff.js"></script>
<script language="JavaScript" type="text/JavaScript">
function topage() { 
		window.location="javascript: history.go(-1)";
	}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
	document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);


</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>

                <h2 class="style12">&nbsp;</h2>
                <form action="save_edit_Product.php" method="post" id="form1">
                  <table width="450" border="0" align="center"  bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td colspan="3" bgcolor="#330000"><div align="center" class="style16 style1" ><strong>Kemaskini Stok</strong></div></td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td width="142" height="20"><span class="style15">ID Stok</span></td>
                      <td width="7"><span class="style15">:&nbsp;</span></td>
                      <td width="287"><span class="style15">PD0<? echo $record20["id_product"];?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Nama Stok</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><input name="txtProductName" type="text" id="txtproductName" 
						value="<? echo $record20["productName"];?>" size="40" />                      </td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Kategori Produk</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><span class="style15">
                        <select name="txtcategory"  id="txtcategory">
                          <option value="<? echo $record20["category"];?>" selected="selected"><? echo $record20["category"];?> </option>
                             <option value="Makanan">Makanan </option>
                        <option value="Minuman">Minuman </option>
                        <option value="Alat Tulis">Alat tulis </option>
                        <option value="Bateri">Bateri </option>
                        <option value="Ubat">Ubat </option>
                        </select>
                      </span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Pembekal</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><span class="style15">
                        <select name="txtsupplier" id="txtsupplier">
                          <?php
		
		$supp = "SELECT * FROM t_supplier order by id_supplier";
		$supp2 = mysql_query($supp) or die ('Data supplier cannot be reach. ' . mysql_error()); 
		
		$i=1;
		while ($supprow = mysql_fetch_array($supp2))
		{	
		 	$company =$supprow["companyname"];
	 		?>
                          <option value="<? echo $company; ?>"<? if($record20["supplier"]=="$company"){?>selected<? }?>><? echo $company; ?></option>
                          <? }?>
                        </select>
                      </span> </td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Kos Seunit (RM)</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><input name="txtUnitCost" type="text" 
						value="<? echo number_format($record20["unitcost"],2,".",","); ?>" size="6" maxlength="6" />                      </td>
                    </tr>
                    <? 
		$hc=($record20["holdingcost"])/($record20["unitcost"]); 
		$hc_percent= ($record20["holdingcost"])/($record20["unitcost"])*100;
		//$hc=number_format($hc,1,".",","); print $hc;
	?>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Kos Pegangan</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><select name="txtHoldingCost" class="style10 style15" id="HC">
                          <option value="0" <? if($hc==0){?>selected<? }?>>0%</option>
                          <option value="0.05" <? $hc=number_format($hc,2,".",","); if($hc==0.05){?>selected<? }?>>5%</option>
                          <option value="0.1" <? $hc=number_format($hc,1,".",","); if($hc==0.1){?>selected<? }?>>10%</option>
                          <option value="0.15" <? $hc=number_format($hc,2,".",","); if($hc==0.15){?>selected<? }?>>15%</option>
                          <option value="0.2" <? $hc=number_format($hc,1,".",","); if($hc==0.2){?>selected<? }?>>20%</option>
                        </select>                      </td>
                    </tr>
 <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Aras Layanan Semula</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><input name="txtROL" type="text" size="6" maxlength="6" value="<? echo $record20["ROL"]; ?>" /></td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Masa Lopor</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><span class="style15">
                      <? $LT=round((($record20["leadtime"])*52/12),0);?>
                        <input name="txtleadtime" type="text" size="2" maxlength="3" 
						value="<? echo $LT; ?>" />
                        <select name="txtweekmonthlt" >
                          <option value="days" <? if($record20["weekmonthlt"]=="days"){?>selected<? }?>>hari</option>
                          <option value="weeks" <? if($record20["weekmonthlt"]=="weeks"){?>selected<? }?>>minggu</option>
                          <option value="months" <? if($record20["weekmonthlt"]=="months"){?>selected<? }?>>bulan</option>
                      </select>
                      </span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Masa Kitaran</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><span class="style15">
                      <? $CT=round((($record20["cycletime"])*52/12),0);?>
                        <input name="txtcycletime" type="text" size="2" maxlength="3" value="<? echo $CT ?>" />
                        <select name="txtweekmonthct" >
                          <option value="days" <? if($record20["weekmonthct"]=="days"){?>selected<? }?>>hari</option>
                          <option value="weeks" <? if($record20["weekmonthct"]=="weeks"){?>selected<? }?>>minggu</option>
                          <option value="months" <? if($record20["weekmonthct"]=="months"){?>selected<? }?>>bulan</option>
                      </select>
                      </span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Harga Jualan (RM)</span></td>
                      <td><span class="style15">:</span></td>
                      <td><input name="txtSellingPrice" type="text" 
						value="<? echo number_format($record20["sellingprice"],2,".",","); ?>" size="6" maxlength="6" />                      </td>
                    </tr>
                    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <td height="20"><span class="style15">Kuantiti</span></td>
                      <td><span class="style15">:&nbsp;</span></td>
                      <td><input name="txtQuantity" type="text"
						 value="<? echo $record20["current_qty"]; ?>" size="6" maxlength="6" />                      </td>
                    </tr>
                  </table>
                  <p align="center"><span class="style15">
                    <input type="hidden" name="idproduct" value="<? echo $record20["id_product"]; ?>" />
                    <input type="image" name="productSubmit" value="Save" onClick="return valid()" src="../images/simpan.png"/>
                    <input name="button" type="image" onClick="topage()" value="&lt;--Back" src="../images/kembali.png" />
                  </span></p>
                </form>
                <table width="50%" border="0" align="center">
                </table>
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
