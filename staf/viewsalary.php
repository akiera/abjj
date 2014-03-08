<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idSalary =$_GET['idSalary'];
$query1= "SELECT * FROM t_salary WHERE idSalary ='$idSalary'"; 
$result1 = mysql_query($query1) or die ('Data Salary cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idSalary");
$_SESSION['idSalary'] = $record1["idSalary"];

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
<h3><span class="style1">VIEW</span> <span class="style1">SALARY</span></h3>
                <form action="?p=edit_salary" method="post" class="form_container left_label">
                  <ul>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ID SALARY</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SR0<span class="style15"><? echo $record1["idSalary"]; ?></span></span></label>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">MINI MART</label>
                        <div class="form_input">
                          <input id="txtButir" name="txtButir" type="text" disabled="disabled" value="<? echo $record1["cawangan"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">MONTH</label>
                        <div class="form_input">
                          <input name="txtButir" type="text" disabled="disabled" value="<? echo $record1["month"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">YEAR</label>
                        <div class="form_input">
                          <input name="txtButir" type="text" disabled="disabled" value="<? echo $record1["year"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">STAFF NAME</label>
                        <div class="form_input">
                          <input name="txtButir" type="text" disabled="disabled" value="<? echo $record1["name"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
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
                        <label class="field_title">ADVANCE</label>
                        <div class="form_input">
                         <input name="txtButir" type="text" disabled="disabled" value="RM <? echo number_format($record1["advance"],2,".",","); ?>" style=" width:100px;" />
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
                      <input type="hidden" name="idSalary" value="<? echo $record1["idSalary"]; ?>" />
                      <div class="form_grid_12">
                        <div class="form_input">
                        <a href='?p=edit_salary&idSalary=<? echo base64_encode($record1["idSalary"]); ?>'>
                          <button type="button" class="btn_small btn_blue"><span>Edit</span></button></a>
                                                <input type="hidden" name="idSalary" value="<? echo $record1["idSalary"]; ?>" />
                                                <a href='delete_salary.php?idSalary=<? echo $record1["idSalary"]; ?>' onClick="return confirm_del()">
                          <button type="button" class="btn_small btn_orange" onClick="return confirm_del()"><span>Delete</span></button></a>
                        </div>
                      </div>
                    </li>
                  </ul>
    </form>
</body>
</html>
