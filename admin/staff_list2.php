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



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>DC2 GARAGE</title>
	<link rel="stylesheet" href="../style.css" type="text/css" charset="utf-8" />
	
    <style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 24px; font-weight: bold; }
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; }
.style6 {color: #000000}
-->
    </style>
</head>

<body>

  <div id="outer">
    <div id="wrapper">
      <div id="body-bot">
        <div id="body-top">
          <div id="logo">
            <h1>DC2 GARAGE TARDING </h1>
            <p>We care about your car</p>
          </div>
          <div id="nav">
            <ul>
              <li><a href="../index.php">MAIN PAGE</a></li>
              <li><a href="booking.php" rel="dropmenu_1"><span>ONLINE BOOKING</span></a></li>
			  <li><a href="#" rel="dropmenu_2"><span>KEMASKINI</span></a></li>
              <li><a href="#" rel="dropmenu_3"><span>TRANSACTION</span></a></li>
              <li><a href="#" rel="dropmenu_4"><span>INVENTORY</span></a></li>
              <li><a href="#" rel="dropmenu_5"><span>REPORT</span></a></li>
              <li><a href="../logout.php"><span>LOGOUT</span></a></li>
            </ul>
            <div class="clear"> </div>
          </div>
          <div id="gbox">
            <div id="gbox-top"> </div>
            <div id="gbox-bg">
              <div id="gbox-grd">
                <h2 class="style1">&nbsp;</h2>
                <form action="" method="post" id="form1">
                  <table width="498" border="1" bordercolor="#996666" cellpadding="0" cellspacing="0" align="center" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td width="30" height="25" align="center"><span class="style5">No.</span></td>
                      <td width="250" align="center"><span>Name</span></td>
                      <td width="100" align="center"><span>Phone</span></td>
                      <td width="50" align="center"><span>Position</span></td>
                      <td width="50" align="center"><span>Detail</span></td>
                    </tr>
                    <!--Get data from database and display-->
                    <?php
		
					require_once('../connection/data2.php');
		
					$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
					$maxRows_b = 2;
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
                    <tr class="style7" bgcolor="#FFFFFF" onmouseover="this.bgColor='#FFFFCC'" onmouseout="this.bgColor='#FFFFFF'">
                      <td height="25" align="center"><span class="style6"><? echo $i; ?></span></td>
                      <td><span class="style6"><? echo $row_b["staff_name"]; ?></span></td>
                      <td align="center"><span class="style6"><? echo $row_b["staff_tel"]; ?></span></td>
                      <td align="center"><span class="style6"><? echo $row_b["staff_cat"]; ?></span></td>
                      <td align="center"><a href='viewstaff.php?staff_ic=<? echo $row_b["staff_ic"]; ?>' class="style6"><img src="../images/edit.gif" height="30" border="0" alt="View" /></a></td>
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
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, max(0, $pageNum_b - 1), $queryString_b); ?>"><img src="../images/Previous.gif" border="0" /></a>
                        <?php } // Show if not first page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, min($totalPages_b, $pageNum_b + 1), $queryString_b); ?>"><img src="../images/Next.gif" border="0" /></a>
                        <?php } // Show if not last page ?>
                    </td>
                    <td width="23%" align="center"><?php if ($pageNum_b < $totalPages_b) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_b=%d%s", $currentPage, $totalPages_b, $queryString_b); ?>"></a>
                        <?php } // Show if not last page ?>
                    </td>
                  </tr>
                </table>
                <p class="style2">&nbsp;</p>
                <div class="clear"> </div>
              </div>
            </div>
            <div id="gbox-bot"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div id="copyright">
    &copy; Copyright information goes here. All rights reserved.
  </div>

</body>
</html>
