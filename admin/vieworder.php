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

$nama = $_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="../common/js/universal.js"></script>
<script type="text/javascript" src="../common/js/calendar.js"></script>
<script type="text/javascript" src="../common/js/calendarsetup.js"></script>
<script type="text/javascript" src="../common/js/calendar_en.js"></script>
	<title>ABJJ Techno Solution</title>

<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
</style>
	<style media="all" type="text/css">
	@import "menu_style.css";    .style12 {font-size: 24px}
.style12 {font-size: 24px}
.style13 {font-size: 24px; font-weight: bold; }
.style13 {font-size: 24px; font-weight: bold; }
    .style17 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #990000;
}
.style17 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #990000;
}
.style18 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #990033;
}
.style21 {
	color: #000000;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
    .style23 {font-family: Georgia, "Times New Roman", Times, serif; font-size: 14px; color: #990033; }
.style24 {font-family: Georgia, "Times New Roman", Times, serif}
    </style>
</head>

<body>

                <h2 class="style12">&nbsp;</h2>
              
                <table width="50%" border="0" align="center">
                </table>
                <table width="516" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
                  <tr bgcolor="#F2F0DC">
                    <td colspan="3" align="center" class="style18"></font></td>
                  </tr>
                  <form action="?p=vieworder2" method="post" id="report">
                    <input name="category" value="Date" type="hidden" />
                    <tr bgcolor="#F2F0DC" height="15">
                      <td colspan="3"><font color="#FFFFFF">&nbsp;</font></td>
                    </tr>
                    <tr bgcolor="#F2F0DC">
                      <td colspan="3" align="center" class="style17"><span class="style21">Sila pilih tarikh untuk memaparkan Pembelian Pesanan (PO)</span></td>
                    </tr>
                    <tr bgcolor="#F2F0DC" height="15">
                      <td colspan="3" class="style10">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="142" align="right" bgcolor="#F2F0DC" class="style23">Dari</td>
                      <td width="11" bgcolor="#F2F0DC"><span class="style24"></span></td>
                      <td width="363" bgcolor="#F2F0DC" class="style10 style24"><input type="text" id="txtstartdate" name="startdate" maxlength="50"
			value="<?php echo $startdate; ?>" size="20" />
                          <button type="submit" id="calendarbutton1"><img src="../images/calendar.gif" width="16" height="16" border="0" /></button>
                      <script type="text/javascript">
				Calendar.setup({
				inputField    : "txtstartdate",
				button        : "calendarbutton1",
				align         : "Tr"
				});
				  </script></td>
                    </tr>
                    <tr bgcolor="#F2F0DC" height="15">
                      <td colspan="3" class="style10">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="142" align="right" bgcolor="#F2F0DC" class="style23">Hingga</td>
                      <td width="11" bgcolor="#F2F0DC"><span class="style24"></span></td>
                      <td width="363" bgcolor="#F2F0DC" class="style10 style24"><input type="text" id="txtenddate" name="enddate" maxlength="50"
			value="<?php echo $enddate; ?>" size="20" />
                          <button type="submit" id="calendarbutton2"><img src="../images/calendar.gif" width="16" height="16" border="0" /></button>
                      <script type="text/javascript">
				Calendar.setup({
				inputField    : "txtenddate",
				button        : "calendarbutton2",
				align         : "Tr"
				});
				  </script></td>
                    </tr>
                    <tr bgcolor="#F2F0DC" height="15">
                      <td colspan="3" class="style10">&nbsp;</td>
                    </tr>
                    <tr bgcolor="#F2F0DC">
                      <td colspan="3" align="center"><input name="Submit" type="image" id="button" onClick="return check_date()" value="Papar" src="../images/papar.png" />
                      </span></td>
                      
                    </tr>
                  </form>
                  <tr bgcolor="#F2F0DC" height="15">
                    <td colspan="3" class="style10"><font color="#FFFFFF">&nbsp;</font></td>
                  </tr>
                  <tr bgcolor="#F2F0DC" height="25">
                    <td colspan="3" align="center" background="../../images/BawahTambahPekerja.jpg" class="style10"></td>
                  </tr>
</table>
<p class="style13">&nbsp;</p>
   
</body>
</html>
