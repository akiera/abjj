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
$_SESSION['staff_ic'] = $record1["user_ic"];

$query2= mysql_query("SELECT * FROM t_staff WHERE staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record1["user_ic"];

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
<h3><span class="style1">ADD NEW USER</span></h3>
<form action="process_staff.php" method="post" class="form_container left_label">	
                      							
<ul>
										
                                         <li>
										<div class="form_grid_12">
											<label class="field_title">FULL NAME</label>
											<div class="form_input">
											  <input name="staffname" type="text" onFocus="1" value="<? echo $_GET['staffname'];?>" maxlength="100" style=" width:200px;"/>
											*</div>
										</div>
			</li>
             <li>
										<div class="form_grid_12">
											<label class="field_title">IC No.</label>
											<div class="form_input">
											  <input name="staffIC" type="text" value="<? echo $_GET['staffIC'];?>"  maxlength="100" style=" width:200px;"/>
											  eg : 870101020000
											</div>
										</div>
			</li>
             <li>
               <div class="form_grid_12">
                 <label class="field_title">SEX</label>
                 <div class="form_input">
                   <select name="staffsex" id="sex" class="chzn-select" style=" width:200px" data-placeholder="Please Select">
                     <option value=""></option>
                     <option value="MALE">MALE</option>
                     <option value="FEMALE">FEMALE</option
                   ></select>
                 </div>
               </div>
             </li>
                <li>
										<div class="form_grid_12">
											<label class="field_title">ADDRESS</label>
											<div class="form_input">
											  <input name="staffaddress" type="text" value="<? echo $_GET['staffaddress'];?>" maxlength="100" style=" width:400px;"/>
											</div>
										</div>
			</li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">POSTCODE</label>
											<div class="form_input">
											  <input name="staffpostcode" type="text" value="<? echo $_GET['staffpostcode'];?>" maxlength="100" style=" width:100px;"/>
											</div>
										</div>
			</li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">TOWN</label>
											<div class="form_input">
											  <input name="stafftown" type="text" value="<? echo $_GET['stafftown'];?> " maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
            <li>
			  <div class="form_grid_12">
				<label class="field_title">STATE</label>
											  <div class="form_input">
                                               <select name="staffState" id="State" class="chzn-select" style=" width:200px" data-placeholder="Please Select State">
											
											 <option value=""></option>
											  <option value="Johor" <? if($_GET['staffState']=="Johor"){?>selected<? }?>>Johor</option>
											  <option value="Kedah" <? if($_GET['staffState']=="Kedah"){?>selected<? }?>>Kedah</option>
											  <option value="Kelantan" <? if($_GET['staffState']=="Kelantan"){?>selected<? }?>>Kelantan</option>
											  <option value="Melaka" <? if($_GET['staffState']=="Melaka"){?>selected<? }?>>Melaka</option>
											  <option value="Negeri Sembilan" <? if($_GET['staffState']=="Negeri Sembilan"){?>selected<? }?>>Negeri Sembilan</option>
											  <option value="Pahang" <? if($_GET['staffState']=="Pahang"){?>selected<? }?>>Pahang</option>
											  <option value="Perak" <? if($_GET['staffState']=="Perak"){?>selected<? }?>>Perak</option>
											  <option value="Perlis" <? if($_GET['staffState']=="Perlis"){?>selected<? }?>>Perlis</option>
											  <option value="Penang" <? if($_GET['staffState']=="Penang"){?>selected<? }?>>Pulau Pinang</option>
											  <option value="Selangor" <? if($_GET['staffState']=="Selangor"){?>selected<? }?>>Selangor</option>
											  <option value="Terengganu" <? if($_GET['staffState']=="Terengganu"){?>selected<? }?>>Terengganu</option>
											  <option value="Wilayah Persekutuan" <? if($_GET['staffState']=="Wilayah Persekutuan"){?>selected<? }?>>Wilayah Persekutuan</option>
											  <option value="Sabah" <? if($_GET['staffState']=="Sabah"){?>selected<? }?>>Sabah</option>
											  <option value="Sarawak" <? if($_GET['staffState']=="Sarawak"){?>selected<? }?>>Sarawak</option>
										    </select>
											</span></div></div>
			</li>
            <li>
              <div class="form_grid_12">
                <label class="field_title">Tel No.</label>
                <div class="form_input">
                  <input name="staffphone" type="text" value="<? echo $_GET['staffphone'];?>"  maxlength="100" style=" width:200px;"/>
                  eg : 012-1234567 </div>
              </div>
            </li>
                                        <li>
                                          <div class="form_grid_12">
                                            <label class="field_title">EMAIL</label>
                                            <div class="form_input">
                                              <input name="staffemail" type="text" value="<? echo $_GET['staffemail'];?>" maxlength="100" style=" width:200px;"/>
                                            </div>
                                          </div>
                                        </li>
										<li>
										  <div class="form_grid_12">
										    <label class="field_title">CATEGORY</label>
										    <div class="form_input">
										      <select name="staffcate" id="staffcate" class="chzn-select" style=" width:200px" data-placeholder="Please Select">
										        <option value=""></option>
										         <option value="Admin" <? if($_GET['staffcate']=="Admin"){?>selected<? }?>>Admin</option>
                          <option value="Staff" <? if($_GET['staffcate']=="Staff"){?>selected<? }?>>Manager</option>
						   
                   >
									          </select>
									        </div>
									      </div>
                                          <li>
	<div align="center" class="style2 style3 style19"><strong>:: Register As System Login :: </strong></div></li>
     <li>
										<div class="form_grid_12">
											<label class="field_title">USERNAME</label>
											<div class="form_input">
											  <input name="Username" type="text" value="<? echo $_GET['Username'];?> " maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
             <li>
										<div class="form_grid_12">
											<label class="field_title">PASSWORD</label>
											<div class="form_input">
											  <input name="Password" type="password" value="<? echo $_GET['Password'];?> " maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
             <li>
										<div class="form_grid_12">
											<label class="field_title">RETYPE PASSWORD</label>
											<div class="form_input">
											  <input name="Password2" type="password" value="<? echo $_GET['Password'];?> " maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>
    									</li>
  </ul>									
									
								<ul>
									<li>
									<div class="form_grid_12">
										<div class="form_input">
											<button type="submit" class="btn_small btn_blue"><span>Submit</span></button>
                                            <button type="reset" class="btn_small btn_orange"><span>Reset</span></button>
										</div>
									</div>
									</li>
								</ul>
</form>
						
</body>