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

$id_product=$_POST['idCawangan'];

$query20= "SELECT * FROM t_cawangan WHERE idCawangan ='$idCawangan'"; 
$result20 = mysql_query($query20) or die ('Data Cash Book cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idCawangan");
$_SESSION['idCawangan'] = $record20["idCawangan"];

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
<h3><span class="style1">ADD NEW MINIMART</span></h3>
		<form action="process_cawangan.php" method="post" class="form_container left_label">	
                      							
<ul>
	<li>
	  <div class="form_grid_12">
<label class="field_title">MINI MART ID</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; MB0
                                            <?
						//Select the last cawangan num in table cawangan
						$sqlsupp = "SELECT * FROM t_cawangan ORDER BY id";
				        $resultsupp = mysql_query($sqlsupp) or die ('Data cawangan cannot be reach. ' . mysql_error());
						while($rowsupp = mysql_fetch_array($resultsupp))
						{ $latest_supp = $rowsupp["idCawangan"]; }
						$supID=$latest_supp+1; //add with 1 
						echo $supID;
						//make it hidden to pass value
						?>
                                            <input name="supID" type="hidden" value="<? echo $supID; ?>" />
</span></label>
										</div>
										</li>
                <li>
										<div class="form_grid_12">
											<label class="field_title">Minimart Name</label>
											<div class="form_input">
										<input id="namaCawangan" name="namaCawangan" type="text" value="" maxlength="100" style=" width:200px;"/>
											</div>
										</div>
	</li>
                                        <li>
										<div class="form_grid_12">
										  <label class="field_title">Address</label>
											<div class="form_input">
											  <input name="lokasiCawangan" id="lokasiCawangan" type="text" value="" maxlength="255" class="small"/>
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