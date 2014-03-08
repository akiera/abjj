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

?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>ABJJ Techno Solution</title>

<link rel="stylesheet" type="text/css" href="../inc/view.css" media="all">
<script type="text/javascript" src="../inc/view.js"></script>

<script type="text/javascript" src="../common/js/universal.js"></script>
<script type="text/javascript" src="../common/js/calendar.js"></script>
<script type="text/javascript" src="../common/js/calendarsetup.js"></script>
<script type="text/javascript" src="../common/js/calendar_en.js"></script>

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

<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
<!--
.style1 {
	font-size: large;
	font-weight: bold;
	font-family: "Courier New", Courier, monospace;
}
.style2 {color: #000000}
-->
</style>
<body id="main_body" >
	<div id="form_container">
	  <p align="center" class="style1">DAILY REPORT</p>
	  <form id="form_301722" class="appnitro"  method="post" action="process_daily_report.php">
					<div class="form_description">
			
		    </div>						
			<ul >					
			
					<li id="li_1" >
		<label class="description" for="element_1"><span class="style18">ID Daily Report : RD0
        <?
						
						$sqlpro = "SELECT * FROM t_dailyReport ORDER BY idDailyReport";
				        $resultpro = mysql_query($sqlpro) or die ('Data daily report cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idDailyReport"]; }
						$txtdailyReportId=$latest_pro+1; //add with 1 
						echo $txtdailyReportId;
						?>
        <input name="txtdailyReportId" type="hidden" value="<? echo $txtdailyReportId; ?>" />
		</span></label>
		<div></div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Mini Mart</label>
		<div>
		<select class="element select large" id="txtcawangan" name="txtcawangan"> 
			
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
		</div> 
		</li>		<li id="li_3" >
        <label class="description" for="element_3">Date </label>
        <?
					  $s_date = split("-",$rowa['invoice_date']);
					  $invoicedate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
        <input id="txtDate" name="dateDaily" class="element text small" type="text" maxlength="255" value="<?php echo $_GET['dd'];?>" size="20">
		 
                      <button type="submit" id="calendarbutton"><img src="../images/calendar.png" width="16" height="16" border="0"></button>
                    <script type="text/javascript">
				Calendar.setup({
				inputField    : "txtDate",
				button        : "calendarbutton",
				align         : "Tr"
				});
				</script>
		</li>
		<li id="li_5" >
		<label class="description" for="element_5">Sales (RM)</label>
		<div>
		  <input name="txtSales" class="element text medium" id="txtSales" type="text" maxlength="255" value=""/>
		</div>
		</li>
        <div class="form_description">		    </div>
        <li id="li_2" >
		<label for="element_2" class="description style2">		Cash Expenses</label>
		<div></div> 
		</li>	<li id="li_5" >
		<label class="description" for="element_5">Purchase (RM)</label>
		<div>
		  <input name="txtPur" class="element text small" id="txtPur" type="text" maxlength="255" value=""/>
		</div> 
		</li><li id="li_5" >
		<label class="description" for="element_5">Salary (RM)</label>
		<div>
		  <input name="txtSal" class="element text small" id="txtSal" type="text" maxlength="255" value=""/>
		</div> 
		</li><li id="li_5" >
		<label class="description" for="element_5">Others (RM)</label>
		<div>
		  <input name="txtOth" class="element text small" id="txtOth" type="text" maxlength="255" value=""/>
		</div> 
        <div class="form_description">		    </div>
		</li><li id="li_5" >
		<label class="description" for="element_5">		Advance Claims (RM)</label>
		<div>
		  <input name="txtAdv" class="element text small" id="txtAdv" type="text" maxlength="255" value=""/>
		</div> 
		</li><li id="li_5" >
		<label class="description" for="element_5">Cash Bank In (RM)</label>
		<div>
		  <input name="txtBan" class="element text small" id="txtBan" type="text" maxlength="255" value=""/> 
		    <input name="prepared" type="hidden" id="prepared" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />
		</div> 
		</li>
			
					<li class="buttons"></li>
			</ul>
<div id="footer">
			<input type="image" name="productSubmit" id="button" value="Tambah" onClick="return submitproduct()" src="../images/save.png" />
		</div>
	  </form>	
		<div id="footer">
			&nbsp;
		</div>
</div>
	<img id="bottom" src="../inc/bottom.png" alt="">
	</body>
</html>