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

$id_product=$_POST['idCash'];

$query20= "SELECT * FROM t_dailyReport WHERE idDailyReport ='$idDailyReport'"; 
$result20 = mysql_query($query20) or die ('Data daily report cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idDailyReport");
$_SESSION['idDailyReport'] = $record20["idDailyReport"];

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
<h3><span class="style1">DAILY REPORT</span></h3>
		<form action="process_daily_report.php" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
										  <label class="field_title">ID DAILY REPORT</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; RD0
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
										</div>
										</li>
            <li>
                                          <div class="form_grid_12">
                                            <label class="field_title">MINI MART</label><div class="form_input">
                                            <select name="txtcawangan" multiple class="chzn-select" id-"txtcawangan" style=" width:200px;" tabindex="13" data-placeholder="-Please Select-">
                                               
                                                
                                                <?php
		
		$supp = "SELECT * FROM t_cawangan order by idCawangan";
		$supp2 = mysql_query($supp) or die ('Data cawangan cannot be reach. ' . mysql_error()); 
		
		$i=1;
		while ($supprow = mysql_fetch_array($supp2))
		{	
		 	$cawangan =$supprow["namaCawangan"];
			
	 		?>
            
            <option value=""></option>
                         
            <option value="<? echo $cawangan; ?>"<? if($record20["cawangan"]=="$cawangan"){?>selected<? }?>><? echo $cawangan; ?></option>
                        
                        <? }?>
                                              </select>
                                            </div>
                                          </div>
		    </li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">DATE</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
												  <input id="txtDate" name="dateDaily" class="datepicker"  type="text" maxlength="255" value="" size="20" />
												</div>
					  <span class="clear"></span>
										  </div>
										</div>
									  </li>
                                       <li>
										<div class="form_grid_12">
											<label class="field_title">SALES (RM)</label>
										  <div class="form_input">
											  <input name="txtSales" id="txtSales" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
										</li>
                                         <li>
										<div class="form_grid_12">
											<label class="field_title">PURCHASE (RM)</label>
										  <div class="form_input">
											  <input name="txtPur" id="txtPur" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
                                        </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">SALARY (RM)</label>
										  <div class="form_input">
											  <input name="txtSal" id="txtSal" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
										</li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">OTHERS (RM)</label>
										  <div class="form_input">
											  <input name="txtOth" id="txtOth" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
                                        </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">ADVANCE CLAIMS (RM)</label>
										  <div class="form_input">
											  <input name="txtAdv" id="txtAdv" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
                                        </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">CASH BANK IN (RM)</label>
										  <div class="form_input">
											  <input name="txtBan" id="txtBan type="text" value="" maxlength="255" class="small"/>
									        <input name="prepared" type="hidden" id="prepared" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />
										    <input id="txtdate" name="txtdate" type="hidden" value="<? echo $date; ?>"" maxlength="255" class="small"/>
										  </div>
										</div>
                                        </li>
						</ul>									
									
								<ul>
									<li>
									<div class="form_grid_12">
										<div class="form_input">
											<button type="submit" class="btn_small btn_blue"><span>Save</span></button>
                                            <button type="reset" class="btn_small btn_orange"><span>Reset</span></button>
										</div>
									</div>
									</li>
								</ul>
						  </form>
						
</body>