<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 1 = user for administrator
{
header('Location:../');
exit();
}

include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['username']=$record1["username"];

$id_product=$_POST['idTopup'];

$query20= "SELECT * FROM t_topup WHERE idTopup ='$idTopup'"; 
$result20 = mysql_query($query20) or die ('Data Topup Book cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idTopup");
$_SESSION['idTopup'] = $record20["idTopup"];

$nama=$_SESSION['username'];
$date = date('d/m/Y h:i:s a', time());

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
<h3><span class="style1">TOPUP BOOK</span></h3>
		<form action="process_topupbook.php" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
											<label class="field_title">ID TOPUP BOOK</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; BI0
        <?
						
						$sqlpro = "SELECT * FROM t_topup ORDER BY idTopup";
				        $resultpro = mysql_query($sqlpro) or die ('Data Topup Book cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idTopup"]; }
						$txtTopupId=$latest_pro+1; //add with 1 
						echo $txtTopupId;
						
						?>
        <input name="txtTopupId" type="hidden" value="<? echo $txtTopupId; ?>" />
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
											<label class="field_title">PARTICULARS</label>
											<div class="form_input">
											  <input id="txtButir" name="txtButir" type="text" value="" maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">DATE</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
												  <input id="dateCash" name="dateCash" class="datepicker"  type="text" maxlength="255" value="" size="20" />
												</div>
					  <span class="clear"></span>
										  </div>
										</div>
									  </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">AMOUNT IN (RM)</label>
										  <div class="form_input">
										    <input name="txtMasuk" id="txtMasuk" type="text" value="" maxlength="255" class="small"/>
										  </div>
										</div>
										</li>
                                       
										<li>
										  <div class="form_grid_12">
                                            <label class="field_title">AMOUNT OUT(RM)</label>
                                            <div class="form_input">
                                              <input id="txtKeluar" name="txtKeluar" type="text" value="" maxlength="255" class="small"/>
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








