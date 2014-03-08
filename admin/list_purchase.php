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
$month2 = $_POST['month2'];
$tahun = $_POST['tahun'];
$cawangan = $_POST['cawangan'];
$sql = "Select * from t_purchase where month2(date) = $month2 and tahun(date) = $tahun and cawangan = '$cawangan'";

$res = mysql_query($sql) or die(mysql_error());

while($row = mysql_fetch_array($res)){

echo $row['cawangan'] . " - " . $row['tarikh'] . " - " . $row['pembekal'];
echo "<BR>";

}
}

?><head>
<title>ABJJ MANAGEMENT</title>
</head>
	
<div id="content">
		<div class="grid_container">
					<div class="widget_content">
						<div id="tab1">
							<h3 align="center">PURCHASE LIST</h3>
					  <form name="searchShop" action="?p=view_list_purchase" method="post" class="form_container left_label">                      							
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
									  <select name="month2" id="month2" class="chzn-select" style=" width:200px" data-placeholder="Please Select Month">
                                        <option value=""></option>
                                        <option value="1">January</option>
                                        <option value="2">Februry</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">Jun</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                      </select>
									</div>
								</div>
			</li>
                                          <li>
                                          <div class="form_grid_12">
                                            <label class="field_title">YEAR</label>
                                            <div class="form_input">
                              <select name="tahun" id="tahun" class="chzn-select" style=" width:200px" data-placeholder="Please Select Year">
                                                <option value=""></option>
                                                <option value="2011">2011</option>
                                                <option value="2012">2012</option>
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
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