<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idPurchase =$_GET['idPurchase'];
$query1= "SELECT * FROM t_purchase WHERE idPurchase ='$idPurchase'"; 
$result1 = mysql_query($query1) or die ('Data purchase cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idPurchase");
$_SESSION['idPurchase'] = $record1["idPurchase"];

$id_product=$_POST['idPayment'];
$query20= "SELECT * FROM t_payment WHERE idPayment ='$idPayment'"; 
$result20 = mysql_query($query20) or die ('Data Payment cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
session_register("idPayment");
$_SESSION['idPayment'] = $record20["idPayment"];

$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>
	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {	font-size: x-large;
	font-weight: bold;
	font-family: "Courier New", Courier, monospace;
}
-->
    </style>
<body> 
    <div id="content">
<h3><span class="style1">PAYMENT</span></h3>
<form action="process_payment.php" method="post" class="form_container left_label">
                  <ul>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ID PAYMENT</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; PY0
                          <?
						
						$sqlpro = "SELECT * FROM t_payment ORDER BY idPayment";
				        $resultpro = mysql_query($sqlpro) or die ('Data Payment cannot be reach. ' . mysql_error());
						while($rowpro = mysql_fetch_array($resultpro))
						{ $latest_pro = $rowpro["idPayment"]; }
						$txtPaymentId=$latest_pro+1; //add with 1 
						echo $txtPaymentId;
						//make it hidden to pass value
						?>
                        </span></label>
                        <span class="style18">
                        <input name="txtPaymentId" type="hidden" value="<? echo $txtPaymentId; ?>" />
                      </span></div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">MINI MART</label>
                        <div class="form_input">
                          <input id="txtcawangan" name="txtcawangan" type="text" value="<? echo $record1["cawangan"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">SUPPLIER</label>
                        <div class="form_input">
                          <input name="txtpembekal" type="text" value="<? echo $record1["pembekal"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">TOTAL RM</label>
                        <div class="form_input">
                         <input id="txtTotal"  name="txtTotal" type="text" value="<? echo $record1["amaun"]; ?>" style=" width:100px;" />
                        </div>
                      </div>
                    </li>
                       <li>
										<div class="form_grid_12">
											<label class="field_title">Chq Date</label>
											<div class="form_input">
												<div class=" form_grid_2 alpha">
												  <input id="txtDate" name="datePayment" class="datepicker"  type="text" maxlength="255" value="" size="20" />
												</div>
					  <span class="clear"></span>
										  </div>
										</div>
				    </li>
                                        
                    <li>
                      <div class="form_grid_12">
											<label class="field_title">Chq No.</label>
										  <div class="form_input">
										    <input name="txtChq" id="txtChq" type="text" value="" maxlength="255" class="small"/>
										  </div>
					  </div>
                    </li>
                      <li>
                      <div class="form_grid_12">
											<label class="field_title">CN.</label>
										  <div class="form_input">
										    <input name="txtCn" id="txtCn" type="text" value="" maxlength="255" class="small"/>
										  </div>
						</div>
                    </li>
                     <li>
                      <div class="form_grid_12">
											<label class="field_title">Status</label>
										  <div class="form_input">
										    <input id="txtStatus"  name="txtStatus" type="text" value="PAID" style=" width:100px;" />
										  </div>
					   </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">PREPARED BY</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp;&nbsp;  <span class="style15"><? echo $record1["oleh"]; ?></span></span></label>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12"><span class="form_input">
                      <input name="prepared" type="hidden" id="prepared" value="<? echo $_SESSION['staff_name']; ?>" size="20" maxlength="50" />
                        </span><span class="form_input">
                        <input id="txtdate" name="txtdate" type="hidden" value="<? echo $date; ?>"" maxlength="255" class="small"/>
                        </span></div>
                    </li>
                  </ul>
                  <ul>
                    <li>
                      <input type="hidden" name="idPurchase" value="<? echo $record1["idPurchase"]; ?>" />
                      <div class="form_grid_12">
										<div class="form_input">
											<button type="submit" class="btn_small btn_blue"><span>Save</span></button>
                                           
										</div>
									</div>
                    </li>
                  </ul>
    </form>
</body>
</html>
