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
<h3><span class="style1">ADD NEW SUPPLIER</span></h3>
		<form action="process_supplier.php" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
											<label class="field_title">ID SUPPLIER</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SP0
                                                <?
						//Select the last supplier num in table supplier
						$sqlsupp = "SELECT * FROM t_pembekal ORDER BY id";
				        $resultsupp = mysql_query($sqlsupp) or die ('Data supplier cannot be reach. ' . mysql_error());
						while($rowsupp = mysql_fetch_array($resultsupp))
						{ $latest_supp = $rowsupp["idPembekal"]; }
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
											<label class="field_title">SUPPLIER NAME</label>
											<div class="form_input">
											  <input name="namaPembekal" type="text" maxlength="100" style=" width:200px;"/>
											</div>
										</div>
			</li>        
                <li>
										<div class="form_grid_12">
											<label class="field_title">SALESMAN NAME</label>
											<div class="form_input">
											  <input name="alamatPembekal" type="text" maxlength="100" style=" width:200px;"/>
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