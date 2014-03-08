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

$idSalary=base64_decode($_GET['idSalary']);

$query = "SELECT * FROM t_salary WHERE idSalary ='$idSalary'"; 
$result = mysql_query($query) or die ('Data Slary cannot be reached.' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idSalary");
$_SESSION['idSalary'] = $record["idSalary"];

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
<h3><span class="style3">EDIT SALARY</span></h3>
<form action="?p=save_edit_salary" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
											<label class="field_title">ID SALARY</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SR0
                                          <span class="style15"><? echo $record["idSalary"]; ?></span></span></label>
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
											<label class="field_title">STAFF NAME</label>
											<div class="form_input">
				  <input name="name" type="text" value="<? echo $record["name"]; ?>" maxlength="100" style=" width:200px;"/>                							</div>
										</div>
			</li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">SALARY (RM)</label>
										  <div class="form_input">
										    <input name="salary" type="text" value="<? echo $record["salary"]; ?>" maxlength="255" class="small"/>
										  </div>
										</div>
										</li>
										<li>
										  <div class="form_grid_12">
                                            <label class="field_title">ADVANCE (RM)</label>
                                            <div class="form_input">
                           <input name="advance" type="text" value="<? echo $record["advance"]; ?>" maxlength="255" class="small"/>
                                            </div>
									      </div>
			</li>
            <li>
										  <div class="form_grid_12">
                                            <label class="field_title">MONTH</label>
                                            <div class="form_input">
                           <input name="month" type="text" value="<? echo $record["month"]; ?>" maxlength="255" class="small"/>
                                            </div>
									      </div>
			</li>
            <li>
										  <div class="form_grid_12">
                                            <label class="field_title">YEAR</label>
                                            <div class="form_input">
                           <input name="year" type="text" value="<? echo $record["year"]; ?>" maxlength="255" class="small"/>
                                            </div>
									      </div>
			</li>
  </ul>									
									
						<ul>
							<li>
							  <div class="form_grid_12">
								  <div class="form_input">
                                  <input type="hidden" name="idCash" value="<? echo $record["idCash"]; ?>" />
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
