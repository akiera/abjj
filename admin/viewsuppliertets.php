<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
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
<head>
<title>ABJJ Techno Solution</title>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
          <h2 class="style12">&nbsp;</h2>
<form action="?p=edit_Supplier" method="post" id="form1">
                  <table width="440" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td height="42" colspan="3" bgcolor="#330000"><div align="center" class="style1">Supplier Information</div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="130" height="25" bgcolor="#99FF66"><span class="style15">Supplier ID</span></td>
                      <td width="300" bgcolor="#99FF66"><span class="style14">SP0<? echo $record["idPembekal"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#00FFFF">
                      <td height="25" class="style15">Supplier Name</td>
                      <td><span class="style14"><? echo $record["namaPembekal"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66" class="style15">Salesman Name</td>
                      <td bgcolor="#99FF66"><span class="style14"><? echo $record["alamat"]; ?>&nbsp;</span></td>
                    </tr>
  </table>
  <p>&nbsp;</p>
                  <table width="184" height="30" align="center" class="style6">
                    <tr>
                      <td align="center" width="56"><div align="center">
                          <input type="hidden" name="idpembekal" value="<? echo $record["idPembekal"]; ?>">
                        <input type="image" value='Kemaskini' name='editstaff' src="../images/kemaskini.png">
                      </div></td>
                      <td align="left" width="50"><div align="center">
                          <input type="hidden" name="staff_ic" value="<? echo $record1["staff_ic"]; ?>" />
                      <a href='delete_Supplier.php?idPembekal=<? echo $record["idPembekal"]; ?>' onClick="return confirm_del()"> <img src="../images/hapus.png" border="0" align="middle" /> </a></div></td>
                      <td align="left" width="62"><div align="center"><a href="?p=snarai_pembekal"><img src="../images/kembali.png" border="0" align="absbottom" /></a> </div></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
  <p>&nbsp;</p>
                  
               
<table width="50%" border="0" align="center">
                </table>
              </div>
            </div>
</form>
</body>
</html>
