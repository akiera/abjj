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

$idCash=base64_decode($_GET['idCash']);

$query = "SELECT * FROM t_cashbook WHERE idCash ='$idCash'"; 
$result = mysql_query($query) or die ('Data Cash Book cannot be reached.' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idCash");
$_SESSION['idCash'] = $record["idCash"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Format date</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#format" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
    });
  });
  </script>
</head>
<body>
 
<p>Date: <input type="text" id="datepicker" size="30" format="yy-mm-yyyy"></p>
 
<p>Format options:<br>
</p>
 
 
</body>
</html>
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
<h3><span class="style3">EDIT BANK IN RECORD</span></h3>
<form action="?p=save_edit_bankin" method="post" class="form_container left_label">	
                      							
<ul>
										<li>
										<div class="form_grid_12">
											<label class="field_title">ID BANK IN</label>
											<label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; BI0
                                          <span class="style15"><? echo $record["idCash"]; ?></span></span></label>
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
                    <label class="field_title">NO SLIP</label>
                    <div class="form_input">
                      <input name="noslip" type="text" value="<? echo $record["noslip"]; ?>" maxlength="100" style=" width:200px;"/>
                    </div>
                  </div>
                </li>
            <li>
										<div class="form_grid_12">
											<label class="field_title">Date</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
												  <input name="tarikh" class="datepicker" type="text" value="<? echo $record["tarikh"]; ?>" size="15" maxlength="50" />
												</div>
					  <span class="clear"></span>
										  </div>
										</div>
    </li>
                                        <li>
										<div class="form_grid_12">
											<label class="field_title">TIME</label>
											<div class="form_input">
											  <input name="masa" type="text" value="<? echo $record["masa"]; ?>" maxlength="255" class="small"/>
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
