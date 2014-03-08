<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
}

include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['username']=$record1["username"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

$IC =$_GET['staff_ic'];
$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);

?>
<head>

<title>ABJJ Techno Solution</title>
<script type="text/javascript" src="js/check_edit_Staff.js"></script>

	
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
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
                <h2 class="style12">&nbsp;</h2>
                <form action="save_edit_Password.php" method="post" id="form1">
                  <table width="300" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#006633" class="style18">
                      <td height="40" colspan="4" align="center" bgcolor="#330000"><span class="style14 style1"><strong>Tukar Kata Laluan</strong></span></td>
                    </tr>
                    <tr>
                      <td height="20" width=""><span class="style19">Nama Pengguna</span></td>
                      <td width="13"><span class="style19">:&nbsp;</span></td>
                      <td><input name="username" type="text" size="15" maxlength="10" value="<? echo $record2["username"];?>" />
                        &nbsp;</td>
                    </tr>
                    <tr>
                      <td height="20"><span class="style19">Kata Laluan</span></td>
                      <td><span class="style19">:&nbsp;</span></td>
                      <td><input name="password" type="password" size="15" maxlength="10" value="<? echo $record2["password"];?>" />
                        &nbsp;</td>
                    </tr>
                    <tr>
                      <td height="20"><span class="style19">Ulang Kata Laluan</span></td>
                      <td><span class="style19">:&nbsp;</span></td>
                      <td><input name="password2" type="password" size="15" maxlength="10" value="<? echo $record2["password"];?>" />
                        &nbsp;</td>
                    </tr>
                    <tr>
                      <td height="50" valign="bottom" align="center" colspan="3"><input name="staff_ic" type="hidden" value="<? echo $IC; ?>" />
                          <input type="image" name="save" value="Simpan" onClick="return check_password()" src="../images/simpan.png" /> 
                        <a href="index.php"> <img src="../images/kembali.png" border="0" align="top" /></a></td>
                    </tr>
                  </table>
                </form>
<table width="50%" border="0" align="center">
                </table>
            
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
</body>
</html>
