<?php

session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
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


if($_POST['search'])
{
$month = $_POST['month'];
$year = $_POST['year'];
$cawangan = $_POST['cawangan'];
$sql = "Select * from t_salary where month = $month and year = $year and cawangan = '$cawangan'";

}

?><head>
<title>ABJJ MANAGEMENT</title>
</head>
	
<div id="content">
		<div class="grid_container">
					<div class="widget_content">
						<div id="tab1">
							<h3 align="center">SALARY LIST</h3>
					  <form name="searchShop" action="?p=view_list_salary" method="post" class="form_container left_label">                      							
<ul>
										
            <li>
                                          <div class="form_grid_12">
                                            <label class="field_title">MINI MART</label><div class="form_input">
                                              <select name="cawangan" id="cawangan" class="chzn-select" style=" width:200px" data-placeholder="Please Select-">
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
									<label class="field_title">MONTH</label>
									<div class="form_input">
									  <select name="month" id="month" class="chzn-select" style=" width:200px" data-placeholder="Please Select Month">
                                        <option value=""></option>
                                        <option value="JANUARY">JANUARY</option>
                                        <option value="FEBRUARY">FEBRUARY</option>
                                        <option value="MARCH">MARCH</option>
                                        <option value="APRIL">APRIL</option>
                                        <option value="MAY">MAY</option>
                                        <option value="JUNE">JUNE</option>
                                        <option value="JULY">JULY</option>
                                        <option value="AUGUST">AUGUST</option>
                                        <option value="SEPTEMBER">SEPTEMBER</option>
                                        <option value="OCTOBER">OCTOBER</option>
                                        <option value="NOVEMBER">NOVEMBER</option>
                                        <option value="DECEMBER">DECEMBER</option>
                                      </select>
									</div>
								</div>
			</li>
                                          <li>
                                          <div class="form_grid_12">
                                            <label class="field_title">YEAR</label>
                                            <div class="form_input">
                              <select name="year" id="year" class="chzn-select" style=" width:200px" data-placeholder="Please Select Year">
                                                <option value=""></option>
                                                                                           
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                 <option value="2016">2017</option>
                                              </select>
                                            </div>
                                          </div>
                                        </li>
										
						</ul>									
									
								<ul>
									<li>
									<div class="form_grid_12">
										<div class="form_input">
											<button type="submit" class="btn_small btn_blue"><span>View List</span></button>
										</div>
									</div>
									</li>
								</ul>
						  </form>
						</div>
						
					</div>
				</div>
	</div>
</div>
</body>
</html>