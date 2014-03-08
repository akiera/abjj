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

?>
	<title>E Mart Solution</title>
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
    </style>
    </head>

<body>

  
                <h2 align="center" class="style12"><span class="style29">:: Senarai Stok::</span></h2>
                <p align="center" class="style29">&nbsp;</p>
                <form action="" method="post" id="form1">
                  <table width="771" border="1" bordercolor="#996666" cellpadding="0" cellspacing="0" align="center" class="">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#006633" class="style24">
                      <td width="20" height="35" align="center" bgcolor="#330000"><span class="style35"><strong><span class="style1">No</span></strong></span></td>
                      <td width="121" align="center" bgcolor="#330000"><span class="style35 style1"><strong>ID Stok</strong></span></td>
                      <td width="119" align="center" bgcolor="#330000"><span class="style35 style1"><strong>Butiran Stok</strong></span></td>
					    <td width="79" align="center" bgcolor="#330000"><span class="style35 style1"><strong>Kategori</strong></span></td>
                      <td width="74" align="center" bgcolor="#330000"><span class="style35 style1"><strong>Pembekal</strong></span></td>
                      <td width="137" align="center" bgcolor="#330000"><span class="style35 style1"><strong>Harga Jual (RM)</strong></span></td>
                      <td width="104" align="center" bgcolor="#330000"><span class="style35 style1"><strong>Stok Semasa</strong></span></td>
                      <td width="99" align="center" bgcolor="#330000"><span class="style35 style1"><strong>Butir-butir</strong></span></td>
                    </tr>
                    <!--Get data from database and display-->
                    <?php
if (isset($_POST['keyword']))
{
					$keyword=$_POST['keyword'];

  					require_once('../connection/data2.php');
		
					$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
					$maxRows_b = 3;
					$pageNum_b = 0;
					if (isset($HTTP_GET_VARS['pageNum_b'])) {
					  $pageNum_b = $HTTP_GET_VARS['pageNum_b'];
					}
					$startRow_b = $pageNum_b * $maxRows_b;

					mysql_select_db(SQL_DB, $conn);
					$query_b = "SELECT * FROM t_product WHERE productName like '%$keyword%' || id_product like '%$keyword%' || supplier like '%$keyword%' || sellingprice like '%$keyword%' || current_qty like '%$keyword%' ORDER BY id";
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
                    <tr>
                      <td colspan="7" align="right"><span class="style37">
                        <script type="text/javascript">loadTimer();</script>
                      </span></td>
                    </tr>
                    <?php	$i=1; do { ?>
                    <tr class="style24" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#FFFFCC'" onMouseOut="this.bgColor='#FFFFFF'">
                      <td height="25" align="center"><span class="style37"><? echo $i; ?></span></td>
                      <td align="center"><span class="style37">PD0<? echo $row_b["id_product"]; ?></span></td>
                      <td><span class="style37">&nbsp;&nbsp;<? echo $row_b["productName"]; ?></span></td>
					       <td align="left"><span class="style37"><? echo $row_b["category"]; ?></span></td>
                      <td align="left"><span class="style37"><? echo $row_b["supplier"]; ?></span></td>
                      <td align="center"><span class="style37"><? echo number_format($row_b["sellingprice"],2,".",","); ?></span></td>
                      <td align="center"><span class="style37"><? echo $row_b["current_qty"]; ?></span></td>
                      <td align="center"><a href='?p=viewproduct&id_product=<? echo $row_b["id_product"]; ?>' class="style37"><img src="../images/preview.png" height="30" border="0" alt="View" /></a></td>
                    </tr>
                    <? $i++;} while ($row_b = mysql_fetch_assoc($b));?>
                    <?php
if ($i<1)
{
	echo "<script>alert('There is no result for your search!');";
	print "window.location='product_list.php'";
	print "</script> ";
}			
}
else
{
					require_once('../connection/data2.php');
		
					$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
					$maxRows_b = 4;
					$pageNum_b = 0;
					if (isset($HTTP_GET_VARS['pageNum_b'])) {
					  $pageNum_b = $HTTP_GET_VARS['pageNum_b'];
					}
					$startRow_b = $pageNum_b * $maxRows_b;

					mysql_select_db(SQL_DB, $conn);
					$query_b = "SELECT * FROM `t_product` ORDER BY `id`";
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
                    <tr class="style24" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#FFFFCC'" onMouseOut="this.bgColor='#FFFFFF'">
                      <td height="25" align="center"><span class="style37"><? echo $i; ?></span></td>
                      <td align="center"><span class="style37">PD0<? echo $row_b["id_product"]; ?></span></td>
                      <td><span class="style37">&nbsp;&nbsp;<? echo $row_b["productName"]; ?></span></td>
				      <td align="left"><span class="style37"><? echo $row_b["category"]; ?></span></td>
                      <td align="left"><span class="style37"><? echo $row_b["supplier"]; ?></span></td>
                      <td align="center"><span class="style37"><? echo number_format($row_b["sellingprice"],2,".",","); ?></span></td>
                      <td align="center"><span class="style37"><? echo $row_b["current_qty"]; ?></span></td>
                      <td align="center"><a href='?p=viewproduct&id_product=<? echo $row_b["id_product"]; ?>' class="style37"><img src="../images/preview.png" height="30" border="0" alt="View" /></a></td>
                    </tr>
                    <? $i++;} while ($row_b = mysql_fetch_assoc($b));?>
                    <? } ?>
                  </table>
</form>
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
				<tr>
				<td> <p class="style13">&nbsp;</p></td>
				</tr>
				<tr> 
                <td align="center"> 
				  <div align="center"><a href="?p=tambah_produk" target="_self"><img src="../images/tambahItem.png" alt="Tambah Produk baru" align="top" border="0"></a><br>
				    
		          </div>
                </tr>
           
          
          </div>
        </div>
      </div>
    </div>
  

</body>
</html>
