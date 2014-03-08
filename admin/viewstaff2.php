<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}
include '../connection/data2.php';

$IC =$_GET['staff_ic'];
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

	<title>DC2 GARAGE</title>
	<link rel="stylesheet" href="../style.css" type="text/css" charset="utf-8" />
	    <style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 24px; font-weight: bold; }
.style3 {font-size: 14px}
-->
    </style>
	
	<style media="all" type="text/css">@import "menu_style.css";
	</style>
	
    <style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 24px; font-weight: bold; }
.style6 {color: #000000}
.style7 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #000000;
}
.style9 {color: #000000; font-weight: bold; }
.style11 {color: #000000; font-weight: bold; font-size: 14px; }
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
					<div class="nav-wrapper">
			<div class="nav-left"></div>
			<div class="nav">
				<ul id="navigation">
			   		<li class="active">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">Home</span>
							<span class="menu-right"></span>
						</a>
					</li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">Blog</span>
							<span class="menu-right"></span>
						</a>
	            	   	<div class="sub">
			   				<ul>
			   					<li>
									<a href="index2.php">Archives</a>
								</li>
			   					<li>
									<a href="#">Categories</a>
								</li>
			   					<li>
									<a href="#">Top-rated Posts</a>
								</li>
			   					<li>
									<a href="#">Most-viewed Entries</a>
								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
					</li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">Development</span>
							<span class="menu-right"></span>
						</a>
			   			<div class="sub">
			   				<ul>
			   					<li>
									<a href="#">Wordpress Themes</a>
									</li>
			   					<li>
									<a href="#">Wordpress Plugins</a>
								</li>
			   					<li>
									<a href="#">Mac OS X</a>
								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
			   		</li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">Tutorials</span>
							<span class="menu-right"></span>
						</a>
	            	   	<div class="sub">
			   				<ul>
			   					<li>
									<a href="#">Photoshop</a>
								</li>
			   					<li>
									<a href="#">Illustrator</a>
								</li>
			   					<li>
									<a href="#">Css, Html</a>
								</li>
								<li>
									<a href="#">Post Your Tutorial!</a>
								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
					</li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">Gallery</span>
							<span class="menu-right"></span>
						</a>
	            	   	<div class="sub">
			   				<ul>
			   					<li>
									<a href="#">Personal Photos</a>
								</li>
			   					<li>
									<a href="#">My Friends</a>
								</li>
			   					<li>
									<a href="#">Tech</a>
								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
					</li>
			   		<li class="">
						<a href="#">
							<span class="menu-left"></span>
							<span class="menu-mid">Portfolio</span>
							<span class="menu-right"></span>
						</a>
	            	   	<div class="sub">
			   				<ul>
			   					<li>
									<a href="#">My Works</a>
								</li>
			   				</ul>
			   				<div class="btm-bg"></div>
			   			</div>
					</li>
			   		<li class="last">
						<a href="">
							<span class="menu-left"></span>
							<span class="menu-mid">Contact</span>
							<span class="menu-right"></span>
						</a>
			   		</li>
			   	</ul>

            </ul>
            <div class="clear"> </div>
          </div>
          <div id="gbox">
            <div id="gbox-top"> </div>
            <div id="gbox-bg">
              <div id="gbox-grd">
                <h2 class="style1">&nbsp;</h2>
                <form action="edit_Staff.php" method="post" id="form1">
                  <table width="400" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td colspan="3"><div align="center" class="style7 style6">Staff Information</div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="80" height="25"><span class="style11">Name</span></td>
                      <td width="30"><span class="style6">:</span></td>
                      <td width="220"><span class="style6"><? echo $record1["staff_name"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style11">I<strong>C No.</strong></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_ic"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style11">Sex</td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_sex"]; ?>&nbsp;</span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">Address</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_add"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">Postcode</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_post"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">Town</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_town"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">State</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_state"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">Tel. No.</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_tel"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">Email</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_email"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style11">Position</span></td>
                      <td><span class="style6">:</span></td>
                      <td><span class="style6"><? echo $record1["staff_cat"]; ?></span></td>
                    </tr>
                    <tr>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table align="center" class="style6">
                    <tr>
                      <td align="center" width="80"><div align="center">
                        <input type="submit" value='Edit' name='editstaff' />
                      </div></td>
                      <td align="left" width="82"><div align="center">
                        <input type="hidden" name="staff_ic" value="<? echo $record1["staff_ic"]; ?>" />
                        <a href='delete_Staff.php?staff_ic=<? echo $record1["staff_ic"]; ?>' onclick="return confirm_del()"> <img src="../images/delete.png" width="24" height="20" border="0" /> </a></div></td>
                      <td align="left" width="118"><div align="center"><a href="../admin/staff_list.php"><img src="../images/previous.gif" width="32" height="22" border="0" align="absmiddle" /></a> </div></td>
                    </tr>
                  </table>
                </form>
                <table width="50%" border="0" align="center">
                
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
