<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 2 = user for staff
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idPembekal = $_GET['idPembekal'];
$query2= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record2 = mysql_fetch_array($query2);
session_register("username");
$_SESSION['username']=$record2["username"];

$sql = "SELECT * FROM t_pembekal WHERE idPembekal='$idPembekal'"; 
$result = mysql_query($sql) or die ('Data of supplier cannot be reached. ' . mysql_error());
$record = mysql_fetch_array($result);
session_register("idPembekal");
$_SESSION['idPembekal'] = $record["idPembekal"];

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
<h3><span class="style1">SUPPLIER INFORMATION</span></h3>
<form action="../admin/?p=edit_Supplier" method="post" class="form_container left_label">
                  <ul>
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">ID SUPPLIER</label>
                        <label class="description" for="element_1"><span class="style18">&nbsp;&nbsp; SP0<span class="style14"><? echo $record["idPembekal"]; ?></span></span></label>
                      </div>
                    </li>                    
                    <li>
                      <div class="form_grid_12">
                        <label class="field_title">SUPPLIER NAME</label>
                        <div class="form_input">
                          <input name="namaPembekal" type="text" disabled="disabled" value="<? echo $record["namaPembekal"]; ?>" maxlength="100" style=" width:200px;"/>
                        </div>
                      </div>
                    </li>
                     <li>
                      <div class="form_grid_12">
                        <label class="field_title">SALESMAN NAME</label>
                        <div class="form_input">
                          <input name="txtButir" type="text" disabled="disabled" value="<? echo $record["alamat"]; ?>" maxlength="100" style=" width:200px;"/>
                        <span class="style14"></span></div>
                      </div>
                    </li>                   
    </ul>
  <ul>
    <li>
                      <input type="hidden" name="idpembekal" value="<? echo $record["idPembekal"]; ?>">
      <div class="form_grid_12">
          <div class="form_input">
            <a href='../admin/?p=edit_Supplier&idPembekal=<? echo base64_encode($record1["idPembekal"]); ?>'>
           
                                  <input type="hidden" name="idPembekal" value="<? echo $record["idPembekal"]; ?>" />
                                  <a href='delete_Supplier.php?idPembekal=<? echo $record["idPembekal"]; ?>' onClick="return confirm_del()">
            <button type="button" class="btn_small btn_orange" onClick="return confirm_del()"><span>Delete</span></button></a>
          </div>
      </div>
    </li>
  </ul>
  </form>
</body>
</html>
