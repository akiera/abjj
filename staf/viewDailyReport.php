<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idDailyReport =$_GET['idDailyReport'];
$query1= "SELECT * FROM t_dailyReport WHERE idDailyReport ='$idDailyReport'"; 
$result1 = mysql_query($query1) or die ('Data daily report cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idDailyReport");
$_SESSION['idDailyReport'] = $record1["idDailyReport"];

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
<h3><span class="style1">VIEW </span> <span class="style1">Daily Report</span></h3>
                <form action="?p=edit_daily_report" method="post" class="form_container left_label">
                  <ul>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ID DAILY REPORT</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; RD0<span class="style15"><? echo $record1["idDailyReport"]; ?></span></span></label>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">MINI MART</label>
                        <div class="form_input">
                          <input id="txtButir2" name="txtButir2" type="text" disabled="disabled" value="<? echo $record1["cawangan"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">Date</label>
                        <div class="form_input">
                          <div class=" form_grid_2 alpha">
                         <input name="dateDaily" type="text" disabled="disabled" maxlength="255" value="<? echo $record1["date"]; ?>" size="20" />
                          </div>
                          <span class="clear"></span> </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">SALES</label>
                        <div class="form_input">
                         <input name="txtButir" type="text" disabled="disabled" value="RM <? echo number_format($record1["sales"],2,".",","); ?>" style=" width:100px;" />
                        </div>
                      </div>
                    </li>
                    <li><strong>Cash Expenses</strong></li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">PURCHASE</label>
                        <div class="form_input">
                          <div class=" form_grid_2 alpha">
                            <input name="txtButir4" type="text" disabled="disabled" value="RM <? echo number_format($record1["purchase"],2,".",","); ?>" style=" width:100px;" />
                          </div>
                          <span class="clear"></span> </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">SALARY</label>
                        <div class="form_input">
                         <input name="txtButir" type="text" disabled="disabled" value="RM <? echo number_format($record1["salary"],2,".",","); ?>" style=" width:100px;" />
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">OTHERS</label>
                        <div class="form_input">
                          <input name="txtButir5" type="text" disabled="disabled" value="RM <? echo number_format($record1["others"],2,".",","); ?>" style=" width:100px;" />
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title"><strong>TOTAL</strong></label>
                        <div class="form_input"><strong>
                          RM 
                          <? $total=$record1["purchase"]+$record1["salary"]+$record1["others"];			
			   				echo number_format($total,2, ".", ",");
						?>
                        </strong></div>
                      </div>
                    </li>
                    <li></li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ADVANCE CLAIMS</label>
                        <div class="form_input">
                          <input name="txtButir6" type="text" disabled="disabled" value="RM <? echo number_format($record1["advance"],2,".",","); ?>" style=" width:100px;" />
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <strong>
                        <label class="field_title">CASH TRANSFER</label>
                        </strong>
                        <div class="form_input"><strong>
                          RM <? $cashTransfer=$record1["sales"]-$total;			
			   				echo number_format($cashTransfer,2, ".", ",");
						?>
                        </strong></div>
                      </div>
                    </li>
                    <li><div class="form_grid_12">
                        <label class="field_title">CASH BANK IN</label>
                        <div class="form_input">
                          <input name="txtButir3" type="text" disabled="disabled" value="RM <? echo number_format($record1["cashBankIn"],2,".",","); ?>" style=" width:100px;" />
                        </div>
                      </div>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">PREPARED BY</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp;&nbsp;  <span class="style15"><? echo $record1["oleh"]; ?></span></span></label>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">DATE AND TIME KEY IN</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; &nbsp;<span class="style15"><? echo $record1["date2"]; ?></span></span></label>
                      </div>
                    </li>
                  </ul>
                  <ul>
                    <li>
                      <input type="hidden" name="idDailyReport" value="<? echo $record1["idDailyReport"]; ?>" />
                      <div class="form_grid_12">
                        <div class="form_input">
                        <a href='?p=edit_daily_report&idDailyReport=<? echo base64_encode($record1["idDailyReport"]); ?>'>
                          <button type="button" class="btn_small btn_blue"><span>Edit</span></button></a>
                        <input type="hidden" name="idDailyReport" value="<? echo $record1["idDailyReport"]; ?>" />
                        <a href='delete_daily_report.php?idDailyReport=<? echo $record1["idDailyReport"]; ?>' onClick="return confirm_del()">
                          <button type="button" class="btn_small btn_orange" onClick="return confirm_del()"><span>Delete</span></button></a>
                        </div>
                      </div>
                    </li>
                  </ul>
    </form>
</body>
</html>
