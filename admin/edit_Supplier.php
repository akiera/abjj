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

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

//$idPembekal=base64_decode($_GET['idPembekal']);
$idpembekal=$_POST['idpembekal'];

$query= "SELECT * FROM t_pembekal WHERE idPembekal ='$idpembekal'"; 
$result = mysql_query($query) or die ('Data Supplier cannot be reached.' . mysql_error());
$record= mysql_fetch_array($result);
session_register("idPembekal");
$_SESSION['idPembekal'] = $record["idPembekal"];

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
<h3><span class="style3">EDIT SUPPLIER</span></h3>
<form action="?p=save_edit_Supplier" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
										  <label class="field_title">ID SUPPLIER</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SP0<span class="style15"><? echo $record["idPembekal"]; ?></span></span></label>
										</div>
										</li>

                <li>
										<div class="form_grid_12">
											<label class="field_title">SUPPLIER NAME</label>
											<div class="form_input">
				  <input name="namaPembekal" type="text" value="<? echo $record["namaPembekal"]; ?>" maxlength="100" style=" width:200px;"/>                							</div><? echo $record["namaPembekal"]; ?>
										</div>
			</li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">SALESMAN NAME</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
												  <input name="alamat" type="text" value="<? echo $record["alamat"]; ?>" maxlength="100" style=" width:200px;"/>
												  <span class="clear"></span>
										  </div></div>
										</div>
    </li>
  </ul>									
									
						<ul>
							<li>
							  <div class="form_grid_12">
								  <div class="form_input">
								    <input type="hidden" name="idPembekal" value="<? echo $record["idPembekal"]; ?>" />
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
