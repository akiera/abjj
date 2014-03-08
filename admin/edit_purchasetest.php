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


$idPurchase=base64_decode($_GET['idPurchase']);

$query = "SELECT * FROM t_purchase WHERE idPurchase ='$idPurchase'"; 
$result = mysql_query($query) or die ('Data purchase cannot be reached.' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idPurchase");
$_SESSION['idPurchase'] = $record["idPurchase"];


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
			//window.location="javascript: history.go(-1)";
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

              <form name="form1" method="post" action="?p=save_edit_purchase">
               
                <p>&nbsp;</p>
                <table width="480" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td height="42" colspan="3" bgcolor="#333300"><div align="center" class="style2 style17 style18 style1">Edit Purchase</div></td>
                  </tr>
                  <tr>
                    <td width="141" height="20"><span class="style18">ID Purchase</span></td>
                    <td width="7"><span class="style18">:&nbsp;</span></td>
                    <td width="314"><span class="style18">PD0
                                          
                    <span class="style15"><? echo $record["idPurchase"]; ?></span></span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Mini Mart</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><input name="cawangan" type="text" value="<? echo $record["cawangan"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                   <tr>
                     <td height="20"><span class="style18">Supplier</span></td>
                     <td><span class="style18">:&nbsp;</span></td>
                     <td><input name="pembekal" type="text" value="<? echo $record["pembekal"]; ?>" size="15" maxlength="50" /></td>
                   </tr>
                   <tr>
                    <td height="20"><span class="style18">No. Invoice</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><input name="noInv" type="text" value="<? echo $record["noInv"]; ?>" size="15" maxlength="50" /></td>
                  </tr>
                   <?
					  $s_date = split("-",$rowa['invoice_date']);
					  $invoicedate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                    <td><span class="style31">Date</span></td>
                    <td><span class="style31">:</span></td>
                    <td>
                      <input name="tarikh" type="text" value="<? echo $record["tarikh"]; ?>" size="15" maxlength="50" />
                  
                  <tr>
                    <td height="20">Amount</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="amaun" type="text" value="<? echo $record["amaun"]; ?>" size="15" maxlength="50" /></td>
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
                      <input type="hidden" name="idPayment" value="<? echo $record["idPayment"]; ?>" />
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
