<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}

include '../connection/data2.php';
$staff_ic=$_SESSION['IC'];

$query1= "SELECT * FROM t_staff WHERE staff_ic ='$IC'"; 
$result1 = mysql_query($query1) or die ('Data Staff cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("staff_ic");

$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);

$nama=$_SESSION['username'];
?>

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
               <form name="form1" method="post" action="?p=save_edit_Staff">
                  <table width="400" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td height="38" colspan="3" bgcolor="#330000"><div align="center" class="style14 style7 style1"><strong>Maklumat Pengguna</strong></div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="80" height="25"><span class="style16">Nama</span></td>
                      <td width="30"><span class="style17">:</span></td>
                      <td width="220"><input name="staffname" type="text" value="<? echo $record1["staff_name"]; ?>" size="40" maxlength="40" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#FFFFFF" class="style16">No. IC</td>
                      <td><span class="style17">:</span></td>
                      <td><input name="staffic" type="text" value="<? echo $record1["staff_ic"]; ?>" size="15" maxlength="12" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" class="style16">Jantina</td>
                      <td><span class="style17">:</span></td>
                      <td><span class="style17">
                        <select name="staffsex" id="sex">
                          <option value="Male" <? if($record1["staff_sex"]=="Male"){?>selected<? }?>>Lelaki</option>
                          <option value="Female" <? if($record1["staff_sex"]=="Female"){?>selected<? }?>>Perempuan</option>
                        </select>
                      </span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25">Alamat</td>
                      <td><span class="style17">:</span></td>
                      <td><span class="style17">
                        <textarea name="staffadd" cols="40" rows="2"><? echo $record1["staff_add"]; ?></textarea>
                      </span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style16">Poskod</span></td>
                      <td><span class="style17">:</span></td>
                      <td><input name="staffpostcode" type="text" value="<? echo $record1["staff_post"]; ?>" size="15" maxlength="5" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25">Bandar</td>
                      <td><span class="style17">:</span></td>
                      <td><input name="stafftown" type="text" value="<? echo $record1["staff_town"]; ?>" size="40" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25">Negeri</td>
                      <td><span class="style17">:</span></td>
                      <td><select name="staffstate" class="style17" id="staffState">
                        <option value="Kedah" <? if($record1["staff_state"]=="Kedah"){?>selected<? }?>>Kedah</option>
                        <option value="Kelantan" <? if($record1["staff_state"]=="Kelantan"){?>selected<? }?>>Kelantan</option>
                        <option value="Melaka" <? if($record1["staff_state"]=="Melaka"){?>selected<? }?>>Melaka</option>
                        <option value="Negeri Sembilan" <? if($record1["staff_state"]=="Negeri Sembilan"){?>selected<? }?>>Negeri Sembilan</option>
                        <option value="Pahang" <? if($record1["staff_state"]=="Pahang"){?>selected<? }?>>Pahang</option>
                        <option value="Perak" <? if($record1["staff_state"]=="Perak"){?>selected<? }?>>Perak</option>
                        <option value="Perlis" <? if($record1["staff_state"]=="Perlis"){?>selected<? }?>>Perlis</option>
                        <option value="Penang" <? if($record1["staff_state"]=="Pulau Pinang"){?>selected<? }?>>Pulau Pinang</option>
                        <option value="Johor" <? if($record1["staff_state"]=="Johor"){?>selected<? }?>>Johor</option>
                        <option value="Sabah" <? if($record1["staff_state"]=="Sabah"){?>selected<? }?>>Sabah</option>
                        <option value="Sarawak" <? if($record1["staff_state"]=="Sarawak"){?>selected<? }?>>Sarawak</option>
                        <option value="Selangor" <? if($record1["staff_state"]=="Selangor"){?>selected<? }?>>Selangor</option>
                        <option value="Terengganu" <? if($record1["staff_state"]=="Terengganu"){?>selected<? }?>>Terengganu</option>
                        <option value="Wilayah Persekutuan" <? if($record1["staff_state"]=="Wilayah Persekutuan"){?>selected<? }?>>Wilayah Persekutuan</option>
                      </select></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25">No. Tel</td>
                      <td><span class="style17">:</span></td>
                      <td><input name="stafftel" type="text" value="<? echo $record1["staff_tel"]; ?>" size="15" maxlength="11" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25"><span class="style16">Emel</span></td>
                      <td><span class="style17">:</span></td>
                      <td><input name="staffemail" type="text" value="<? echo $record1["staff_email"]; ?>" size="30" maxlength="30" /></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25">Bahagian</td>
                      <td><span class="style17">:</span></td>
                      <td><span class="style17">
                        <select name="staffcate" id="position">
                          <option value="Admin" <? if($record1["staff_cat"]=="Admin"){?>selected<? }?>>Admin</option>
                          <option value="Staff" <? if($record1["staff_cat"]=="Staff"){?>selected<? }?>>Staff</option>
						   <option value="Customer" <? if($record1["staff_cat"]=="Customer"){?>selected<? }?>>Customer</option>
                        </select>
                      </span></td>
                    </tr>
                    <tr> </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table width="184" height="30" align="center" class="style6">
                    <tr>
                      <td align="center" width="98"><div align="center">
                        <input type="hidden" name="staff_ic" value="<? echo $record1["staff_ic"]; ?>"><input name="Submit" type="image" value="Simpan" onClick="return verify_staff()" src="../images/simpan.png" >
                      </div></td>
                      
                      <td align="left" width="74"><input type="image" onClick="topage()" value="Kembali" src="../images/kembali.png"></td>
                    </tr>
                  </table>
                </form>
                <table width="50%" border="0" align="center">
                </table>
                
      
  </div>
  
 </body>
</html>
