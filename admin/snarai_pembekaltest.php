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
.style3 {
	color: #000000;
	font-weight: bold;
}
.style4 {color: #000000}
.style6 {font-weight: bold}
-->
    </style>
    </head>

<body>

<form action="?p=add_supp" method="post" id="form1">
 <div class="widget_content">
                  <h3>:: Supplier List::</h3>
                 
<!--DWLayoutTable-->
                    <table class="display data_tbl">
                                         <thead>
                        <tr>
                          <th width="47"> No.</th>
                          <th width="131"> ID</th>
                          <th width="296"> Supplier Name </th>
                          <th width="103"> Detail</th>
                        </tr>
                      </thead>

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
					$query_b = "SELECT * FROM `t_pembekal` ORDER BY `id`";
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
                      <td><span class="style28">SP0<? echo $row_b["idPembekal"]; ?></span></td>
                      <td align="center"><div align="left"><span class="style28"><? echo $row_b["namaPembekal"]; ?></span></div></td>
                      <td align="center"><a href='?p=viewsupplier&idPembekal=<? echo $row_b["idPembekal"]; ?>' class="style27">Detail</a></td>
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
          <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, max(0, $pageNum_b - 1), $queryString_b); ?>">Previous</a>
          <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, min($totalPages_b, $pageNum_b + 1), $queryString_b); ?>">Next</a>
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
                <button type="submit" class="btn_small btn_blue">
                <strong><a href="?p=add_supp" target="_self">Add New Supplier</a>
</button></tr>
</body>
</html>
