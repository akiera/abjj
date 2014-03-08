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

<body>

<form action="?p=add_staff" method="post" id="form1">
                  <h1 align="center">STAFF LIST </h1>
                  <!--DWLayoutTable-->
                    <table class="display" id="data_tbl_tools">
                                         <thead>
                        <tr>
                          <th width="47"> No.</th>
                          <th width="301"> Name</th>
                          <th width="92"> Phone </th>
                          <th width="103">Position</th>
                          <th width="75"> Detail </th>
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
					$query_b = "SELECT * FROM `t_staff` ORDER BY `staff_name`";
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
                      <td height="25" align="center"><span class="style32"><? echo $i; ?></span></td>
                      <td><span class="style32"><? echo $row_b["staff_name"]; ?></span></td>
                      <td align="center"><span class="style32"><? echo $row_b["staff_tel"]; ?></span></td>
                      <td align="center"><span class="style32"><? echo $row_b["staff_cat"]; ?></span></td>
                      <td align="center"><a href='?p=viewstaff&staff_ic=<? echo $row_b["staff_ic"]; ?>' class="style32">detail</a></td>
                    </tr>
                    <? $i++;} while ($row_b = mysql_fetch_assoc($b));?>
                  </table>
  <div class="form_input">
                      <div align="center">
                        <button type="submit" class="btn_small btn_orange"><span>Add New Staff</span></button>
                        </a> </div>
  </div>
                    
</form>
<tr>
				<td>&nbsp;</td>
</tr>
				         
                <div class="clear"> </div>
           
                <p>&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  <p>&nbsp;</p>
</body>
</html>
