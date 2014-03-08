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

$id_product=$_POST['idSalary'];

$query20= "SELECT * FROM t_salary WHERE idSalary ='$idSalary'"; 
$result20 = mysql_query($query20) or die ('Data Salary cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idSalary");
$_SESSION['idSalary'] = $record20["idSalary"];

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
-->
</style>
<body id="main_body" >
	
	<img id="top" src="../inc/top.png" alt="">
	<div id="form_container">
	  <p align="center" class="style1">Salary </p>
<form id="form_301722" class="appnitro"  method="post" action="process_salary.php">
					<div class="form_description">
			
			<p></p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1"><span class="style18">ID Salary : SR0
        <?
						
						$sqlpro = "SELECT * FROM t_salary ORDER BY idSalary";
				        $resultpro = mysql_query($sqlpro) or die ('Data Salary cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idSalary"]; }
						$txtSalaryId=$latest_pro+1; //add with 1 
						echo $txtSalaryId;
						//make it hidden to pass value
						?>
        <input name="txtSalaryId" type="hidden" value="<? echo $txtSalaryId; ?>" />
		</span></label>
		<div></div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Mini mart</label>
		<div>
		<select class="element select medium" id="txtcawangan" name="txtcawangan"> 
			
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
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Staff Name</label>
		<div>
			<input id="txtName" name="txtName" class="element text small" type="text" maxlength="255" value=""/> 
		</div> 
		</li> <li id="li_2" >
		<label class="description" for="element_2">Salary</label>
		<div>
			<input id="txtSalary" name="txtSalary" class="element text small" type="text" maxlength="255" value=""/> 
		</div> 
		</li>	<li id="li_2" >
		<label class="description" for="element_2">Advance</label>
		<div>
			<input id="txtAdvance" name="txtAdvance" class="element text small" type="text" maxlength="255" value=""/> 
		</div> 
		</li>	<li id="li_2" >
		<label class="description" for="element_2">Month</label>
		<div>
		  <select class="element select small" id="txtMonth" name="txtMonth">
                          <option value="">Please select</option>
                          <option value="January">Jan</option>
                          <option value="February">Feb</option>
                          <option value="March">Mac</option>
                          <option value="April">Apr</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                          <option value="Julr">July</option>
                          <option value="August">Aug</option>
                          <option value="September">Sept</option>
                          <option value="October">Oct</option>
                          <option value="November">Nov</option>
                          <option value="December">Dec</option>
                        </select>
		  
            <input name="prepared" type="hidden" id="prepared" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />

		</div> 
		</li>	<li id="li_2" >
		<label class="description" for="element_2">Year</label>
		<select class="element select small" id="txtYear" name="txtYear">
                          <option value="">Please select</option>
                          <option value="2013">2013</option>
                          <option value="2014">2014</option>
                          <option value="2015">2015</option>
                          <option value="2016">2016</option>
                          <option value="2017">2017</option>
                        </select>					
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