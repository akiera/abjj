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

$id_product=$_POST['idPurchase'];

$query20= "SELECT * FROM t_purchase WHERE idPurchase ='$idPurchase'"; 
$result20 = mysql_query($query20) or die ('Data purchase cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idPurchase");
$_SESSION['idPurchase'] = $record20["idPurchase"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?><head>
<title>ABJJ MANAGEMENT</title>
<style type="text/css">
<!--
.style1 {
	font-size: x-large;
	font-weight: bold;
	font-family: "Courier New", Courier, monospace;
}
-->
</style>
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
	<div id="form_container">
	  <p align="center" class="style1">Purchase </p>
	  <form id="form_301722" class="appnitro"  method="post" action="process_purchase.php">
					<div class="form_description">
			
			<p></p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1"><span class="style18">ID Purchase : PD0
        <?
						
						$sqlpro = "SELECT * FROM t_purchase ORDER BY id";
				        $resultpro = mysql_query($sqlpro) or die ('Data purchase cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idPurchase"]; }
						$txtPurchaseId=$latest_pro+1; //add with 1 
						echo $txtPurchaseId;
						//make it hidden to pass value
						?>
        <input name="txtPurchaseId" type="hidden" value="<? echo $txtPurchaseId; ?>" />
		</span></label>
		<div></div> 
		</li>		
			  <li id="li_6" >
		<label class="description" for="element_6">Mini Mart </label>
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
		</li>		
			  <li id="li_7" >
		<label class="description" for="element_7">Supplier </label>
		<div>
		<select class="element select medium" id="txtpembekal" name="txtpembekal"> 
			
                      <option value="select" selected>-Please Select-</option>
                        <?php
		
		$supp = "SELECT * FROM t_pembekal order by idPembekal";
		$supp2 = mysql_query($supp) or die ('Data pembekal cannot be reach. ' . mysql_error()); 
		
		$i=1;
		while ($supprow = mysql_fetch_array($supp2))
		{	
		 	$pembekal =$supprow["namaPembekal"];
	 		?>
                        <option value="<? echo $pembekal; ?>"<? if($record20["pembekal"]=="$pembekal"){?>selected<? }?>><? echo $pembekal; ?></option>
                        <? }?>
          </select>
		</div> 
		</li>		
			  <li id="li_2" >
		<label class="description" for="element_2">Inv No. </label>
		<div>
			<input id="txtInv" name="txtInv" class="small" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
			  <li id="li_3" >
        <label class="description" for="element_3">Date </label>
        <?
					  $s_date = split("-",$rowa['invoice_date']);
					  $invoicedate="".$s_date[2]."/".$s_date[1]."/".$s_date[0]."";
					  ?>
        <input id="txtDate" name="dateInv" class="element text small" type="text" maxlength="255" value="<?php echo $_GET['dd'];?>" size="20">
		 
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
		<label class="description" for="element_5">Amount (RM) </label>
		<div>
		  <input name="txtAmaun" class="element text small" type="text" maxlength="255" value=""/> 
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