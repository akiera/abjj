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
$_SESSION['username']=$record1["username"];


$idDailyReport=$_POST['idDailyReport'];

$query = "SELECT * FROM t_dailyReport WHERE idDailyReport ='$idDailyReport'"; 
$result = mysql_query($query) or die ('Data daily report cannot be reached.' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idDailyReport");
$_SESSION['idDailyReport'] = $record["idDailyReport"];


$nama=$_SESSION['username'];
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
<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-weight: bold}
-->
</style>
</head>

<body>

              <form name="form1" method="post" action="?p=new_save_edit_daily_report">
               
                <p>&nbsp;</p>
                <table width="480" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td height="42" colspan="3" bgcolor="#9900FF"><div align="center" class="style2 style17 style18 style1">Edit Daily Report</div></td>
                  </tr>
                  <tr>
                    <td width="141" height="20"><span class="style18">ID </span></td>
                    <td width="7"><span class="style18">:&nbsp;</span></td>
                    <td width="314"><span class="style18">RD0
                                          
                    <span class="style15"><? echo $record["idDailyReport"]; ?></span></span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Mini Mart</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><input name="cawangan" type="text" value="<? echo $record["cawangan"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                   <tr>
                    <td height="20"><span class="style18">Sales </span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                    <input name="sales" type="text" value="<? echo $record["sales"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                   <?
					  $s_date = split("-",$rowa['invoice_date']);
					  $invoicedate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                    <td><span class="style31">Date</span></td>
                    <td><span class="style31">:</span></td>
                    <td>
                      <input name="date" type="text" value="<? echo $record["date"]; ?>" size="15" maxlength="50" />
                   
                 
                  <tr>
                    <td height="20"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                  </tr>
                   <tr>
                    <td height="20"><strong>Cash Expenses </strong></td>
                    <td><span class="style18">&nbsp;</span></td>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Purchase</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM 
                      <input name="purchase" type="text" value="<? echo $record["purchase"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20">Salary</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="salary" type="text" value="<? echo $record["salary"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20">Others</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="others" type="text" value="<? echo $record["others"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                  </tr>
                   <tr>
                    <td height="20">B/F</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="bf" type="text" value="<? echo $record["bf"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                   <tr>
                    <td height="20">Advance Claims</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="advance" type="text" value="<? echo $record["advance"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20">Cash Transfer</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="cashTransfer" type="text" value="<? echo $record["cashTransfer"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                   <tr>
                    <td height="20">Cash Bank In</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="cashBankIn" type="text" value="<? echo $record["cashBankIn"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><span class="style18">&nbsp;</span></td>
                    <td><input name="prepared" type="hidden" id="prepared" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />                    </td>
                  </tr>
                  <tr>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td><p class="style18">&nbsp;</p></td>
                  </tr>
                  <tr>
                    <td height="30"><span class="style18"></span></td>
                    <td><span class="style18"></span></td>
                    <td valign="bottom"><span class="style18">
                      <input type="hidden" name="idDailyReport" value="<? echo $record["idDailyReport"]; ?>" />
                      <input type="image" name="Submit" value="Save" onClick="return valid()" src="../images/save.png" />
                    </span></td>
                  </tr>
                  <tr>
                    <td colspan="3"><p class="style11 style18">&nbsp;</p></td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
</form>
              <table width="50%" border="0" align="center">
              </table>
            </div>
        </div>
      </div>


</body>
</html>
