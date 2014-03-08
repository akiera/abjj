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


$id_product=$_POST['idDailyReport'];

$query20= "SELECT * FROM t_dailyReport WHERE idDailyReport ='$idDailyReport'"; 
$result20 = mysql_query($query20) or die ('Data daily report cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idDailyReport");
$_SESSION['idDailyReport'] = $record20["idDailyReport"];


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

              <form name="form1" method="post" action="new_process_daily_report.php">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <table width="480" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                  <!--DWLayoutTable-->
                  <tr>
                    <td height="42" colspan="3" bgcolor="#9900FF"><div align="center" class="style2 style17 style18 style1">New Daily Report for <strong> EMART, ETECHNO &amp; EDAMAN ONLY</strong></div></td>
                  </tr>
                  <tr>
                    <td width="141" height="20"><span class="style18">ID </span></td>
                    <td width="7"><span class="style18">:&nbsp;</span></td>
                    <td width="314"><span class="style18">RD0
                        <?
						//Select the last PO num in table po_num
						$sqlpro = "SELECT * FROM t_dailyReport ORDER BY idDailyReport";
				        $resultpro = mysql_query($sqlpro) or die ('Data daily report cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idDailyReport"]; }
						$txtdailyReportId=$latest_pro+1; //add with 1 
						echo $txtdailyReportId;
						//make it hidden to pass value
						?>                  
                      <input name="txtdailyReportId" type="hidden" value="<? echo $txtdailyReportId; ?>" />
                    </span></td>
                  </tr>
                  <tr>
                    <td height="20"><span class="style18">Mini Mart</span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td><span class="style18">
                    <select name="txtcawangan" id="txtcawangan">
                      <option value="select" selected>-Please Select-</option>
                        <?php
		
		
		$supp = "SELECT * FROM t_cawangan order by idCawangan";
		$supp2 = mysql_query($supp) or die ('Data cawangan cannot be reach. ' . mysql_error()); 
		
		$i=1;
		while ($supprow = mysql_fetch_array($supp2))
		{	
		 	$cawangan =$supprow["namaCawangan"];
	 		?>
                        <option value="<? echo $cawangan; ?>"<? if($record20["cawangan"]=="$cawangan"){?>selected<? }?>><? echo $cawangan; ?></option>
                        <? }?>
                    </select>
                    </span></td>
                  </tr>
                    <tr>
                    <td height="20"><span class="style18">Sales </span></td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                    <input name="txtSales" type="text" id="txtSales" size="15" maxlength="50" /></td>
                  </tr>
                   <?
					  $s_date = split("-",$rowa['invoice_date']);
					  $invoicedate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
                    <td><span class="style31">Date</span></td>
                    <td><span class="style31">:</span></td>
                    <td><span class="style31">
                      <input type="text" id="txtDate" name="dateDaily" maxlength="50"
			value="<?php echo $_GET['dd'];?>" size="15">
                      <button type="submit" id="calendarbutton"><img src="../images/calendar.png" width="16" height="16" border="0"></button>
                    <script type="text/javascript">
				Calendar.setup({
				inputField    : "txtDate",
				button        : "calendarbutton",
				align         : "Tr"
				});
				</script>
                    &nbsp;</span></td>
                
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
                    <td>RM <input name="txtPur" type="text" id="txtPur" size="15" maxlength="50" />                    </td>
                  </tr>
                  <tr>
                    <td height="20">Salary</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="txtSal" type="text" id="txtSal" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20">Others</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="txtOth" type="text" id="txtOth" size="15" maxlength="50" /></td>
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
                      <input name="txtBf" type="text" id="txtBf" size="15" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td height="20">Advance Claims</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM                     
                     <input name="txtAdv" type="text" id="txtAdv" size="15" maxlength="50" /></td>
                  </tr>
                   <tr>
                    <td height="20">Cash Transfer</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="txtTra" type="text" id="txtTra" size="15" maxlength="50" /></td>
                  </tr>
                   <tr>
                    <td height="20">Cash Bank In</td>
                    <td><span class="style18">:&nbsp;</span></td>
                    <td>RM
                      <input name="txtBan" type="text" id="txtBan" size="15" maxlength="50" /></td>
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
                      <input type="image" name="productSubmit" id="button" value="Tambah" onClick="return submitproduct()" src="../images/save.png" />
                      
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
