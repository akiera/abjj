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

$idpembekal=$_POST['idpembekal'];

$query= "SELECT * FROM t_pembekal WHERE idPembekal ='$idpembekal'"; 
$result = mysql_query($query) or die ('Data supplier cannot be reached.' . mysql_error());
$record= mysql_fetch_array($result);
session_register("idPembekal");
$_SESSION['idPembekal'] = $record["idPembekal"];
?>
<head>

	<title>ABJJ Techno Solution</title>
<script language="JavaScript" type="text/JavaScript">
function topage() { 
		window.location="javascript: history.go(-1)";
	}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
	document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);


</script>
</head>

<body>

                <form action="?p=save_edit_Supplier" method="post" id="form1">
                  <p>&nbsp;</p>
                  <table width="464" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                    <td height="40" colspan="3" bgcolor="#A7C0DC"><div align="center" class="style8"><strong>Edit Supplier</strong></div>						    				</td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="128" height="25">Supplier Id</td>
                      <td width="3"><span class="style15">:</span></td>
                      <td width="319"><span class="style15">SP0<? echo $record["idPembekal"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style16">Supplier Name</td>
                      <td><span class="style15">:</span></td>
                      <td><input name="namaPembekal" type="text" value="<? echo $record["namaPembekal"]; ?>" size="50" maxlength="50" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25">Address</td>
                      <td><span class="style15">:</span></td>
                      <td><span class="style15">
                        <textarea name="alamat" cols="40" rows="2"><? echo $record["alamat"]; ?></textarea>
                      </span></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table width="158" height="30" align="center" class="style6">
                    <tr>
                      <td align="center" width="81"><div align="center">
                        <input type="hidden" name="idPembekal" value="<? echo $record["idPembekal"]; ?>" />
                        <input type="image" name="Submit" value="Save" onClick="return valid()" src="../images/simpan.png" />
                      </div></td>
                      <td align="left" width="61">
                        <input name="button" type="image" onClick="topage()" value="Back" src="../images/kembali.png"/>
                     </td>
                    </tr>
                  </table>
                </form>
                <table width="50%" border="0" align="center">
                </table>
           
              </div>
            </div>
</body>
</html>
