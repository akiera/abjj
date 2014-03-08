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

$query20= "SELECT * FROM t_cashbook WHERE idCash ='$idCash'"; 
$result20 = mysql_query($query20) or die ('Data Cash Book cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idCash");
$_SESSION['idCash'] = $record20["idCash"];

$nama=$_SESSION['username'];
$date = date("dd/mm/yy" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));
$butir = 'BANK IN';


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
<h3><span class="style1">BANK IN RECORD</span></h3>
		<form action="process_bankin.php" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
											<label class="field_title">ID BANK IN</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; BI0
        <?
						
						$sqlpro = "SELECT * FROM t_cashbook ORDER BY idCash";
				        $resultpro = mysql_query($sqlpro) or die ('Data Cash Book cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idCash"]; }
						$txtCashId=$latest_pro+1; //add with 1 
						echo $txtCashId;
						
						?>
        <input name="txtCashId" type="hidden" value="<? echo $txtCashId; ?>" />
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
											<label class="field_title">NO SLIP</label>
											<div class="form_input">
											  <input id="txtSlip" name="txtSlip" type="text" value="" maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">DATE</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
                                            
												  <input id="datepicker" name="dateCash" class="datepicker"  type="text" maxlength="" value="" size="" />
												</div>
					  <span class="clear"></span>
										  </div>
										</div>
									  </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">TIME</label>
										  <div class="form_input">
										    <input name="txtMasa" id="txtMasa" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
										</li>
										<li>
										  <div class="form_grid_12">
                                            <label class="field_title">Amount(RM)</label>
                                            <div class="form_input">
                                              <input id="txtKeluar" name="txtKeluar" type="text" value="" maxlength="255" class="small"/>
                                              <input name="prepared" type="hidden" id="prepared" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />
                                              <input id="txtdate" name="txtdate" type="hidden" value="<? echo $date; ?>"" maxlength="255" class="small"/>
                                              <input id="txtbutir" name="txtbutir" type="hidden" value="<? echo $butir; ?>"" maxlength="255" class="small"/>
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