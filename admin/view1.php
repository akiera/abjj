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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>E Mart</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="topPan">
	<ul>
		<li><a href="">logout</a></li>
		<li class="register"><a href="#" class="register">Admin</a></li>
  </ul>
	<a href="index.html"><img src="images/logo.png" alt="E Mart Solution" width="632" height="101" border="0" class="logo" title="E Mart Solution" /></a>	</div>
 <!--<div id="headerPan">-->
 <!-- <div id="headermiddlePan">-->
  	<div id="menuPan">
		<ul>
			<!--<li class="home">Laman Utama</li>-->
            <li><a href="">Laman Utama</a></li>
			<li><a href="">Pengurusan</a></li>
			<li><a href="#">Transaksi</a></li>
			<li><a href="#">Order</a></li>
		  <li><a href="">Analisa Inventori</a></li>
			<li class="contact"><a href="" class="contact">Laporan</a></li>
		</ul>
	</div>
	</div>
  </div>
<div id="bodyPan">
<form action="edit_Staff.php" method="post" id="form1">
                  <table width="400" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td height="42" colspan="3" bgcolor="#0099CC"><div align="center" class="style7 style6">User  Information</div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="80" height="25"><span class="style15">Name</span></td>
                      <td width="30"><span class="style16">:</span></td>
                      <td width="220"><span class="style16"><? echo $record1["staff_name"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FFFF" class="style15">I<strong>C No.</strong></td>
                      <td bgcolor="#99FFFF"><span class="style16">:</span></td>
                      <td bgcolor="#99FFFF"><span class="style16"><? echo $record1["staff_ic"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style15">Sex</td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_sex"]; ?>&nbsp;</span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FFFF"><span class="style15">Address</span></td>
                      <td bgcolor="#99FFFF"><span class="style16">:</span></td>
                      <td bgcolor="#99FFFF"><span class="style16"><? echo $record1["staff_add"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Postcode</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_post"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FFFF"><span class="style15">Town</span></td>
                      <td bgcolor="#99FFFF"><span class="style16">:</span></td>
                      <td bgcolor="#99FFFF"><span class="style16"><? echo $record1["staff_town"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">State</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_state"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FFFF"><span class="style15">Tel. No.</span></td>
                      <td bgcolor="#99FFFF"><span class="style16">:</span></td>
                      <td bgcolor="#99FFFF"><span class="style16"><? echo $record1["staff_tel"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style15">Email</span></td>
                      <td><span class="style16">:</span></td>
                      <td><span class="style16"><? echo $record1["staff_email"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FFFF"><span class="style15">Position</span></td>
                      <td bgcolor="#99FFFF"><span class="style16">:</span></td>
                      <td bgcolor="#99FFFF"><span class="style16"><? echo $record1["staff_cat"]; ?></span></td>
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
                        <a href='delete_Staff.php?staff_ic=<? echo $record1["staff_ic"]; ?>' onClick="return confirm_del()">
                        <input type="submit" name="button2" id="button" value="Padam" />
                          <span class="style17"></span>                          </a>                      <a href='delete_Staff.php?staff_ic=<? echo $record1["staff_ic"]; ?>' onClick="return confirm_del()"><img src="../images/delete.png" width="24" height="20" border="0" /> </a></div></td>
                      <td align="left" width="62"><div align="center">  <input name="button" type="button" onClick="topage()" value="Back" />
                      </div></td>
                    </tr>
                  </table>
                  <label></label>
                </form>
 
	
<div id="footermainPan">
  <div align="center">Copyright © All Right Reserved 2011 </div>
</div>
</body>
</html>
