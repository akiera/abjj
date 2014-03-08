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

$idDailyReport=base64_decode($_GET['idDailyReport']);

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
<h3><span class="style3">EDIT</span>   <span class="style3">DAILY REPORT</span></h3>
<form action="?p=save_edit_daily_report" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
										  <label class="field_title">ID DAILY REPORT</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; CB0 <span class="style15"><? echo $record["idDailyReport"]; ?></span></span></label>
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
                    <label class="field_title">Date</label>
                    <div class="form_input">
                      <div class=" form_grid_2 alpha">
                        <input name="date" type="text" value="<? echo $record["date"]; ?>" size="15" maxlength="50" />
                      </div>
                      <span class="clear"></span> </div>
                  </div>
                </li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">SALES</label>
                <div class="form_input">
                  <input name="sales" type="text" value="<? echo $record["sales"]; ?>" maxlength="255" class="small"/>
                </div>
              </div>
            </li>
            <li>CASH EXPENSES</li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">PURCHASE</label>
                <div class="form_input">
                  <input name="purchase" type="text" value="RM<? echo $record["purchase"]; ?>" maxlength="255" class="small"/>
                </div>
              </div>
            </li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">SALARY</label>
                <div class="form_input">
                  <input name="salary" type="text" value="<? echo $record["salary"]; ?>" maxlength="255" class="small"/>
                </div>
              </div>
            </li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">OTHERS</label>
                <div class="form_input">
                  <input name="others" type="text" value="<? echo $record["others"]; ?>" maxlength="255" class="small"/>
                </div>
              </div>
            </li>
         <li></li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">ADVANCE CLAIM</label>
                <div class="form_input">
                  <input name="advance" type="text" value="<? echo $record["advance"]; ?>" maxlength="255" class="small"/>
                </div>
              </div>
            </li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">CASH BANK IN</label>
                <div class="form_input">
                  <input name="cashBankIn" type="text" value="<? echo $record["cashBankIn"]; ?>" maxlength="255" class="small"/>
                  <input name="prepared2" type="hidden" id="prepared2" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />
                </div>
              </div>
            </li>
										<li>
										  <div class="form_grid_12">
										    <div class="form_input"><span class="style18">
										      <input type="hidden" name="idDailyReport" value="<? echo $record["idDailyReport"]; ?>" />
										    </span>
										      <button type="submit" name="Submit" value="Save" onClick="return valid()" class="btn_small btn_blue"><span>Save</span></button>
									        </div>
									      </div>
										  </div>
			</li>
  </ul>									
									
						<ul>
  </ul>
</form>
        <table width="50%" border="0" align="center">
</table>
            </body>
</html>
