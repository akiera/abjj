<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idCawangan = $_GET['idCawangan'];
$query2= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record2 = mysql_fetch_array($query2);
session_register("username");
$_SESSION['username']=$record2["username"];

$sql = "SELECT * FROM t_cawangan WHERE idCawangan='$idCawangan'"; 
$result = mysql_query($sql) or die ('Data of minimart cannot be reached. ' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idCawangan");
$_SESSION['idCawangan'] = $record["idCawangan"];

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
<h3><span class="style1">MINIMART INFORMATION</span></h3>
<form action="?p=edit_Cawangan" method="post" class="form_container left_label">
                  <ul>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ID MINIMART</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SP0<span class="style14"><? echo $record["idCawangan"]; ?></span></span></label>
                      </div>
                    </li>                    
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">MINIMART NAME</label>
                        <div class="form_input">
                          <input name="namaCawangan" type="text" disabled="disabled" value="<? echo $record["namaCawangan"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">LOCATION</label>
                        <div class="form_input">
                          <input name="txtButir" type="text" disabled="disabled" value="<? echo $record["lokasi"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>                   
    </ul>
  <ul>
    <li>
                      <input type="hidden" name="idcawangan" value="<? echo $record["idCawangan"]; ?>">
      <div class="form_grid_12">
          <div class="form_input">
            <a href='?p=edit_Cawangan&idCawangan=<? echo base64_encode($record1["idCawangan"]); ?>'>
            <button type="button" class="btn_small btn_blue"><span>Edit</span></button></a>
                                  <input type="hidden" name="idCawangan" value="<? echo $record["idCawangan"]; ?>" />
                                  <a href='delete_Cawangan.php?idCawangan=<? echo $record["idCawangan"]; ?>' onClick="return confirm_del()">
            <button type="button" class="btn_small btn_orange" onClick="return confirm_del()"><span>Delete</span></button></a>
          </div>
      </div>
    </li>
  </ul>
  </form>
</body>
</html>
