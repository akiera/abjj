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


$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));


?>


	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
-->
    </style>
    </head>

<body>

                <form action="" method="post" id="form1">
                  <p align="center" class="style28">&nbsp; </p>
                  <p align="center" class="style28">&nbsp;</p>
                  <p align="center" class="style28"><strong>:: PURCHASE LIST :: </strong></p>
                  <p align="center" class="style28">&nbsp;</p>
                  <table width="519" border="1" bordercolor="#996666" cellpadding="0" cellspacing="0" align="center" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#336633">
                    <td width="23" height="29" align="center" bgcolor="#330000"><span class="style30"><span class="style3">Id</span>.</span></td>
                      <td width="99" align="center" bgcolor="#330000"><span class="style30 style1"><strong>Mini Mart</strong></span></td>
                      <td width="151" align="center" bgcolor="#330000"><span class="style30 style1"><strong>Supplier</strong></span></td>
                      <td width="89" align="center" bgcolor="#330000"><span class="style30 style1">Date</span></td>
                      <td width="97" align="center" bgcolor="#330000"><span class="style30 style1">Amaunt</span></td>
                      <td width="46" align="center" bgcolor="#330000"><span class="style30 style1">Detail</span></td>
                      <td width="46" align="center" bgcolor="#330000"><span class="style30 style1">Approved</span></td>
                    </tr>
                    <!--Get data from database and display-->
                    <?php
		
					require_once('../connection/data2.php');
		
					$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
					$maxRows_b = 10;
					$pageNum_b = 0;
					if (isset($HTTP_GET_VARS['pageNum_b'])) {
					  $pageNum_b = $HTTP_GET_VARS['pageNum_b'];
					}
					$startRow_b = $pageNum_b * $maxRows_b;

					mysql_select_db(SQL_DB, $conn);
					$query_b = "SELECT * FROM `t_purchase` ORDER BY `id`";
					$query_limit_b = sprintf("%s LIMIT %d, %d", $query_b, $startRow_b, $maxRows_b);
					$b = mysql_query($query_limit_b, $conn) or die ('Data t_purchase cannot be reach. ' . mysql_error());
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
                      <td height="25" align="center"><span class="style32"><? echo $row_b["idPurchase"]; ?></span></td>
                      <td><span class="style32"><? echo $row_b["cawangan"]; ?></span></td>
                      <td><span class="style32"><? echo $row_b["pembekal"]; ?></span></td>
                      <td align="center"><span class="style32"><? echo $row_b["tarikh"]; ?></span></td>
                      <td align="center"><span class="style32"><? echo $row_b["amaun"]; ?></span></td>
                      <td align="center"><a href='?p=viewpurchase&idPurchase=<? echo $row_b["idPurchase"]; ?>' class="style32"><img src="../images/preview.png" height="30" border="0" alt="View" /></a></td>
                           <td align="center"><label>
                             <input type="checkbox" name="approved" id="approved">
                           </label></td>
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
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, max(0, $pageNum_b - 1), $queryString_b); ?>"><img src="../images/previous.png"/></a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, min($totalPages_b, $pageNum_b + 1), $queryString_b); ?>"><img src="../images/Next.png" /></a>
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
				  <div align="center"><br>
				    
		          </div>
                </tr>
           
                <div class="clear"> </div>
           
    </div>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
</body>
</html>
