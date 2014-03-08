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
$_SESSION['user_ic']=$record2["user_ic"];


$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));


?>
	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
    </style>
    </head>
<body>

 
<form action="?p=snarai_pembekal" method="post" id="form1">
  <p align="center">&nbsp;</p>
                  <p align="center"><span class="style29">:: SENARAI PEMBEKAL::</span></p>
                  <p align="center">&nbsp;</p>
  <table width="554" border="1" bordercolor="#996666" cellpadding="0" cellspacing="0" align="center" class="style6">
    <!--DWLayoutTable-->
<tr bgcolor="#006633" class="style7">
                      <td width="38" height="25" align="center" bgcolor="#330000"><span class="style25 style1"><strong>No.</strong></span></td>
      <td width="119" align="center" bgcolor="#330000"><span class="style25 style1"><strong>ID</strong></span></td>
      <td width="313" align="center" bgcolor="#330000"><span class="style1"><strong>Syarikat</strong></span></td>
                     
      <td width="74" align="center" bgcolor="#330000"><span class="style1"><strong>Butir-butir</strong></span></td>
    </tr>
                    <!--Get data from database and display-->
                    <?php
		
					require_once('../connection/data2.php');
		
					$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
					$maxRows_b = 4;
					$pageNum_b = 0;
					if (isset($HTTP_GET_VARS['pageNum_b'])) {
					  $pageNum_b = $HTTP_GET_VARS['pageNum_b'];
					}
					$startRow_b = $pageNum_b * $maxRows_b;

					mysql_select_db(SQL_DB, $conn);
					$query_b = "SELECT * FROM `t_supplier` ORDER BY `id`";
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
                    <tr class="style6" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#FFFFCC'" onMouseOut="this.bgColor='#FFFFFF'">
                      <td height="25" align="center"><span class="style27"><? echo $i; ?></span></td>
                      <td><span class="style28">SP0<? echo $row_b["id_supplier"]; ?></span></td>
                      <td align="center"><span class="style28"><? echo $row_b["companyname"]; ?></span></td>
                     
                      <td align="center"><a href='?p=viewsupplier&id_supplier=<? echo $row_b["id_supplier"]; ?>' class="style27"><img src="../images/preview.png" height="30" border="0" alt="View" /></a></td>
                    </tr>
                    <? $i++;} while ($row_b = mysql_fetch_assoc($b));?>
                  </table>
</form>
                <table width="50%" border="0" align="center">
                <tr>
                    <td width="23%" align="center"><?php if ($pageNum_b > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, 0, $queryString_b); ?>"></a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td width="31%" align="center"><?php if ($pageNum_b > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, max(0, $pageNum_b - 1), $queryString_b); ?>"><img src="../images/back.png" width="52" height="37" border="0" /></a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, min($totalPages_b, $pageNum_b + 1), $queryString_b); ?>"><img src="../images/Next.png" width="49" height="34" border="0" /></a>
                        <?php } // Show if not last page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, $totalPages_b, $queryString_b); ?>"></a>
                        <?php } // Show if not last page ?>
                    </td>
                  </tr>
				</table>
<p>&nbsp;</p>
				<tr>
				<td>&nbsp;</td>
				</tr>
				<tr> 
                <td align="center"> 
				  <div align="center"><a href="?p=add_supp" target="_self"><img src="../images/tambahPembekal.png" alt="Tambah Pembekal Baru" border="0"></a><b>
				    
		          </div>
                </tr>
                </div>
                </div>
                </div>
                </div>
               <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
</body>
</html>
