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

$idTopup=base64_decode($_GET['idTopup']);

$query = "SELECT * FROM t_topup WHERE idTopup ='$idTopup'"; 
$result = mysql_query($query) or die ('Data Topup cannot be reached.' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idTopup");
$_SESSION['idTopup'] = $record["idTopup"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>
<html>
<head>	
	<title>ABJJ Techno Solution</title>
<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {font-size: x-large;
	font-weight: bold;
	font-family: "Courier New", Courier, monospace;
}
-->
</style>
</head>
<h3><span class="style3">EDIT TOPUP TRANSFER</span></h3>
<form action="?p=save_edit_topup" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
											<label class="field_title">ID TOPUP</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; TF0
                                          <span class="style15"><? echo $record["idTopup"]; ?></span></span></label>
										</div>
										</li>
            <li>
                                          <div class="form_grid_12">
                                            <label class="field_title">MINI MART</label><div class="form_input">
                                       
                                            <select name="cawangan" multiple class="chzn-select" style=" width:200px;" tabindex="13"><option value="<? echo $record["cawangan"]; ?>" selected><? echo $record["cawangan"]; ?></option>                                              
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
				  <input name="butir" type="text" value="<? echo $record["butir"]; ?>" maxlength="100" style=" width:200px;"/>                							</div>
										</div>
			</li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">Date</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
												  <input name="tarikh" type="text" value="<? echo $record["tarikh"]; ?>" size="15" maxlength="50" />
												</div>
					  <span class="clear"></span>
										  </div>
										</div>
    </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">Amount In (RM)</label>
										  <div class="form_input">
					<input name="masuk" type="text" value="<? echo $record["masuk"]; ?>" maxlength="255" class="small"/>
										  </div>
										</div>
										</li>
										<li>
										  <div class="form_grid_12">
                                            <label class="field_title">Amount Out (RM)</label>
                                            <div class="form_input">
                           <input name="keluar" type="text" value="<? echo $record["keluar"]; ?>" maxlength="255" class="small"/>
                                            </div>
									      </div>
			</li>
  </ul>									
									
						<ul>
							<li>
							  <div class="form_grid_12">
								  <div class="form_input">
                                  <input type="hidden" name="idTopup" value="<? echo $record["idTopup"]; ?>" />
				  <button type="submit" name="Submit" value="Save" onClick="return valid()" class="btn_small btn_blue"><span>Save</span></button>
						        </div>
							  </div>
							</li>
						</ul>
</form>
        <table width="50%" border="0" align="center">
              </table>
            </body>
</html>
