<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}
require_once('../connection/data2.php'); 

$IC =$_GET['staff_ic'];
$bookd =$_GET['bdate'];

$query1= "SELECT * FROM t_staff WHERE staff_ic ='$IC'"; 
$result1 = mysql_query($query1) or die ('Data Staff cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("staff_ic");
$_SESSION['IC'] = $record1["staff_ic"];

$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);



$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>DC2 GARAGE | USER</title>
	<link rel="stylesheet" href="../style.css" type="text/css" charset="utf-8" />
	<style media="all" type="text/css">
	@import "menu_style.css";.style6 {color: #000000}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #FFFFFF;
}
    .style12 {font-size: 24px}
.style12 {font-size: 24px}
.style13 {font-size: 24px; font-weight: bold; }
.style13 {font-size: 24px; font-weight: bold; }
    .style15 {color: #000000; font-weight: bold; font-size: 14px; font-family: Georgia, "Times New Roman", Times, serif; }
.style16 {font-family: Georgia, "Times New Roman", Times, serif}
    </style>
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
</head>

<body>

  <div id="outer">
    <div id="wrapper">
      <div id="body-bot">
        <div id="body-top">
          <div id="logo">
            <h1>DC2 GARAGE TRADING </h1>
            <p>We care about your car</p>
          </div>
		  
		  <div class="wrapper1">
	<div class="wrapper">
		<div class="nav-wrapper">
			<div class="nav-left"></div>
			<div class="nav">
				<ul id="navigation">
			<ul id="navigation">
			   		<li class="active">
						<a href="index.php">
							<span class="menu-left"></span>
							<span class="menu-mid"> HOME ||</span>
							<span class="menu-right"></span>						</a>					</li>
			    <li class="">
						<a href="bookdate.php">
							<span class="menu-left"></span>
							<span class="menu-mid">BOOKING ||</span>
							<span class="menu-right"></span>
						</a>
	            	
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">MANAGEMENT ||</span>
							<span class="menu-right"></span>						</a>
			   			<div class="sub">
			   				<ul>
			   					<li>
									<a href="staff_list.php">User</a>							  </li>
			   					<li>
									<a href="supplier_list.php">Supplier</a>								</li>
			   					<li>
									<a href="product_list.php">Product</a>								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
			   		</li>
			   		<li class=""> <a href="#"> <span class="menu-left"></span> <span class="menu-mid">TRANSACTION ||</span> <span class="menu-right"></span> </a>
                        <div class="sub">
                          <ul>
                            <li> <a href="productIn.php">Product In</a> </li>
                            <li> <a href="productOut.php">Product Out</a> </li>
                            <li> <a href="order.php">Order Product</a> </li>
                            <li> <a href="vieworder.php">View Order</a> </li>
                          </ul>
                          <div class="btm-bg"></div>
                        </div>
		   		    </li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">INVENTORY ||</span>
							<span class="menu-right"></span>						</a>
	            	   	<div class="sub">
			   				<ul>
			   					<li>
									<a href="inventory/PeriodicReview.php">SSB Analysis</a>								</li>
			   					<li>
									<a href="inventory/analysis_abc.php">ABC Analysis</a>								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
					</li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">REPORT ||</span>
							<span class="menu-right"></span>						</a>
	            	   	<div class="sub">
			   				<ul>
			   					<li>
									<a href="../report/cate_staff.php">User List Report</a>								</li>
								<li>
									<a href="../report/cate_supplier.php">Supplier List Report</a>								</li>
								<li>
									<a href="../report/cate_product.php">Product List Report</a>								</li>
								<li>
								
									<a href="../report/cate_product_in.php">Product In Report</a>								</li>
								<li>
									<a href="../report/cate_product_out.php">Product Out Report</a>								</li>
								<li>
								<a href="../report/cate_booking.php">Booking Report</a>								</li>
								<li>
									<a href="../report/cate_monthlysales.php">Monthly Sales Report</a>								</li>
								<li>
									<a href="../report/cate_yearlysales.php">Yearly Sales Report</a>								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
					</li>
					<li class="last">
						<a href="logout.php">
							<span class="menu-left"></span>
							<span class="menu-mid">LOGOUT </span>
							<span class="menu-right"></span>						</a>					</li>
			   	</ul>			   	</ul>
			</div>
			<div class="nav-right"></div>
		</div>
		<div class="content-bottom"></div>
	</div>
</div>
          <div id="nav">
            
			
		  
		  
            <div class="clear"> </div>
          </div>
          <div id="gbox">
            <div id="gbox-top"> </div>
            <div id="gbox-bg">
              <div id="gbox-grd">
                <h2 class="style12">&nbsp;</h2>
                <form action="edit_Staff.php" method="post" id="form1">
                  <table width="400" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td height="42" colspan="3" bgcolor="#006633"><div align="center" class="style7 style6">User  Information</div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="80" height="25"><span class="style15">Name</span></td>
                      <td width="30"><span class="style16">:</span></td>
                      <td width="220"><span class="style16"><? echo $record1["staff_name"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style15">I<strong>C No.</strong></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_ic"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style15">Sex</td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_sex"]; ?>&nbsp;</span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Address</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_add"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Postcode</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_post"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Town</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_town"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">State</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_state"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Tel. No.</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_tel"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Email</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_email"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Position</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_cat"]; ?></span></td>
                    </tr>
                    <tr> </tr>
					  <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Car Model </span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? 
$record=0;					  
$query3= "SELECT * FROM book_info WHERE book_by='$IC' AND b_date='$bookd' "; 
$result3 = mysql_query($query3) or die ('Data login cannot be reached.' . mysql_error());
while($record4 = mysql_fetch_array($result3))
				{
				 				$record++;


					  echo $record4["model"]; ?>(<? echo $record4["ctype"];
					  
					  }?>)</span></td>
                    </tr>
                    <tr> </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table width="184" height="30" align="center" class="style6">
                    <tr>
                      <td align="center" width="56"><div align="center">
                        <input type="submit" value='Edit' name='editstaff' />
                      </div></td>
                      <td align="left" width="50"><div align="center">
                          <input type="hidden" name="staff_ic" value="<? echo $record1["staff_ic"]; ?>" />
                      <a href='delete_Staff.php?staff_ic=<? echo $record1["staff_ic"]; ?>' onclick="return confirm_del()"> <img src="../images/delete.png" width="24" height="20" border="0" /> </a></div></td>
                      <td align="left" width="62"><div align="center">  <input name="button" type="button" onclick="topage()" value="Back" /> </div></td>
                    </tr>
                  </table>
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
  
  <div id="copyright">
    &copy; Copyright information goes here. All rights reserved.
  </div>

</body>
</html>
