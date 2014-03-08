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
	<title>E Mart Solution</title>
	
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
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>

              <form name="form1" method="post" action="process_product.php">
                <p>&nbsp;</p>
                <table width="480" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td height="42" colspan="3" bgcolor="#330000"><div align="center" class="style2 style17 style18 style1">Tambah Produk Baru </div></td>
                  </tr>
                  <tr>
                    <td width="141" height="20"><span class="style18">ID Stok</span></td>
                    <td width="7"><span class="style18">:&nbsp;</span></td>
                    <td width="314"><span class="style18">PD0
                      <?
						//Select the last PO num in table po_num
						$sqlpro = "SELECT * FROM t_product ORDER BY id";
				        $resultpro = mysql_query($sqlpro) or die ('Data product cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["id_product"]; }
						$txtProductID=$latest_pro+1; //add with 1 
						echo $txtProductID;
						//make it hidden to pass value
						?>
                    <input name="txtProductID" type="hidden" value="<? echo $txtProductID; ?>" />
                    </span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Nama Stok</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><input name="txtProductName" type="text" id="txtProductName" size="50" maxlength="100" />                    </td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Kategori</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
                      <select name="txtcategory"  id="txtcategory">
                        <option value="select" selected>-Sila Pilih-</option>
                         <option value="Makanan">Makanan </option> 
                        <option value="Minuman">Minuman </option>
                        <option value="Alat Tulis">Alat tulis </option>
                        <option value="Bateri">Bateri </option>
                        <option value="Ubat">Ubat </option>			
                      </select>
                    </span> </td>
                  </tr>

                  <tr>
                    <td height="20"><span class="style18">Pembekal</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
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
                    </span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Kos Seunit (RM)</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
                      <input name="txtUnitCost" type="text" size="15" maxlength="15" />
                      &nbsp;</span></td>
                  </tr>
				  
                  <tr>
                    <td height="20"><span class="style18">Kos Pegangan</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><select name="txtHoldingCost" class="style10 style18" id="HC">
                        <option value="select">-Sila Pilih-</option>
                        <option value="0">0 %</option>
                        <option value="0.05">5 %</option>
                        <option value="0.1">10 %</option>
                        <option value="0.15">15 %</option>
                        <option value="0.2">20 %</option>
                      </select>                    </td>
                  </tr>
				   <tr>
                    <td height="20"><span class="style18">Aras Pesanan Semula</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
                      <input name="txtROL" type="text" size="15" maxlength="5" />
                     &nbsp;</span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Masa Lopor</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
                      <input name="txtleadtime" type="text" size="3" maxlength="3" />
                      <select name="txtweekmonthlt" >
                        <option value="Pilih">-Pilih-</option>
                        <option value="hari">hari</option>
                        <option value="minggu">minggu</option>
                        <option value="bulan">bulan</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Masa Kitaran</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
                      <input name="txtcycletime" type="text" size="3" maxlength="3" />
                      <select name="txtweekmonthct" >
                        <option value="pilih">-Pilih-</option>
                        <option value="hari">hari</option>
                        <option value="minggu">minggu</option>
                        <option value="bulan">bulan</option>
                      </select>
                      &nbsp;</span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Harga Jualan (RM)</span></td>
                    <td><span class="style18">:</span></td>
                    <td><input name="txtSellingPrice" type="text" size="15" maxlength="15" />                    </td>
                  </tr>
                  <tr>
                    <td><span class="style18"></span></td>
                    <td><span class="style18"></span></td>
                    <td><p class="style18">&nbsp;</p>
                    </td>
                  </tr>
                  <tr>
                    <td height="30"><span class="style18"></span></td>
                    <td><span class="style18"></span></td>
                    <td valign="bottom"><span class="style18">
                      <input type="image" name="productSubmit" id="button" value="Tambah" onClick="return submitproduct()" src="../images/tambah.png" />
                      <input type="image" name="productReset" value="Reset" src="../images/semula.png" />
                      <input name="button" type="image" id="button" onClick="topage()" value="Back" src="../images/kembali.png"/>
                    </span></td>
                  </tr>
                  <tr>
                    <td colspan="3"><p class="style11 style18">&nbsp;</p></td>
                  </tr>
                </table>
              </form>
              <table width="50%" border="0" align="center">
              </table>
            </div>
        </div>
      </div>


</body>
</html>
