<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idCash =$_GET['idCash'];
$query1= "SELECT * FROM t_cashbook WHERE idCash ='$idCash'"; 
$result1 = mysql_query($query1) or die ('Data Cash Book cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idCash");
$_SESSION['idCash'] = $record1["idCash"];

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
<h3><span class="style1">VIEW</span> <span class="style1">CASH BOOK</span></h3>
                <form action="?p=edit_cashbook" method="post" class="form_container left_label">
                  <ul>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ID CASH BOOK</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; CB0
                        <span class="style15"><? echo $record1["idCash"]; ?></span></span></label>
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
                        <label class="field_title">PARTICULARS</label>
                        <div class="form_input">
                          <input name="txtButir" type="text" disabled="disabled" value="<? echo $record1["butir"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">Date</label>
                        <div class="form_input">
                          <div class=" form_grid_2 alpha">
                         <input name="dateCash" type="text" disabled="disabled" maxlength="255" value="<? echo $record1["tarikh"]; ?>" size="20" />
                          </div>
                          <span class="clear"></span> </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">AMOUNT IN</label>
                        <div class="form_input">
                         <input name="txtButir" type="text" disabled="disabled" value="RM <? echo number_format($record1["masuk"],2,".",","); ?>" style=" width:100px;" />
                        </div>
                      </div>
                    </li>
                    <li><div class="form_grid_12">
                        <label class="field_title">AMOUNT OUT</label>
                        <div class="form_input">
                          <input name="txtButir3" type="text" disabled="disabled" value="RM <? echo number_format($record1["keluar"],2,".",","); ?>" style=" width:100px;" />
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
                        <label class="field_title">DATE KEY IN</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; &nbsp;<span class="style15"><? echo $record1["date2"]; ?></span></span></label>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">TIME KEY IN</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp;&nbsp;  <span class="style15"><? echo $record1["time"]; ?></span></span></label></div>
                    </li>
                    </ul>
                  <ul>
                    <li>
                      <input type="hidden" name="idCash2" value="<? echo $record1["idCash"]; ?>" />
                      <div class="form_grid_12">
                        <div class="form_input">
                        <a href='?p=edit_cashbook&idCash=<? echo base64_encode($record1["idCash"]); ?>'>
                          <button type="button" class="btn_small btn_blue"><span>Edit</span></button></a>
                                                <input type="hidden" name="idCash" value="<? echo $record1["idCash"]; ?>" />
                                                <a href='delete_cashbook.php?idCash=<? echo $record1["idCash"]; ?>' onClick="return confirm_del()">
                          <button type="button" class="btn_small btn_orange" onClick="return confirm_del()"><span>Delete</span></button></a>
                        </div>
                      </div>
                    </li>
                  </ul>
    </form>
</body>
</html>
