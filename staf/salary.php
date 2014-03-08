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

$id_product=$_POST['idCash'];

$query20= "SELECT * FROM t_cashbook WHERE idCash ='$idCash'"; 
$result20 = mysql_query($query20) or die ('Data Cash Book cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idCash");
$_SESSION['idCash'] = $record20["idCash"];

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
<h3><span class="style1">STAFF SALARY</span></h3>
		<form action="process_salary.php" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
										  <label class="field_title">ID SALARY</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SR0
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
											<label class="field_title">Month</label>
										  <div class="form_input">
									  <select name="txtMonth" id="txtMonth" class="chzn-select" style=" width:200px" data-placeholder="Please Select Month">
                                        <option value=""></option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="Julai">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                      </select>
									</div>
										</div>
										</li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">Year</label>
										  <div class="form_input">
                              <select name="txtYear" id="txtYear" class="chzn-select" style=" width:200px" data-placeholder="Please Select Year">
                                                <option value=""></option>
                                
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                            </select>
										  </div>
										</div>
										</li>
                <li>
										<div class="form_grid_12">
											<label class="field_title">Staff Name</label>
											<div class="form_input">
											  <input id="txtName" name="txtName" type="text" value="" maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">Salary (RM)</label>
                <div class="form_input">
                  <input name="txtSalary" id="txtSalary" type="text" value="" maxlength="255" class="small"/>
                </div>
              </div>
            </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">Advance (RM)</label>
										  <div class="form_input">
											  <input name="txtAdvance" id="txtAdvance" type="text" value="" maxlength="255" class="small"/>
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