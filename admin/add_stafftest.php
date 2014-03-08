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
$_SESSION['staff_ic'] = $record1["user_ic"];

$query2= mysql_query("SELECT * FROM t_staff WHERE staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record1["user_ic"];

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>



<html>
<head>

<title>ABJJ Techno Solution</title>

	
<script language="JavaScript" type="text/JavaScript">
function topage() { 
		window.location="staff_list.php";
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
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
-->
</style>
</head>

<body>


                <h2 class="style12">&nbsp;</h2>
                <form action="process_staff.php" method="post" id="form1">
                  <table width="453" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr>
                      <td colspan="3" bgcolor="#330000"><div align="center" class="style17 style1 style2">Add New User </div></td>
                    </tr>
                    <tr>
                      <td width="110" height="20" class="style32">Name</td>
                      <td width="7"><span class="style30">:&nbsp;</span></td>
                      <td width="318"><input name="staffname" type="text" onFocus="1" value="<? echo $_GET['staffname'];?>" size="40" maxlength="40" />
                      *</td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">IC No.&nbsp;</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                      <input name="staffIC" type="text" size="15" maxlength="12" value="<? echo $_GET['staffIC'];?>" />
                      </span><span class="style32">                      eg.: 870928085104</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Sex</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                        <select name="staffsex" id="sex">
                          <option value="select">-Select-</option>
                          <option value="Male" <? if($_GET['staffsex']=="Male"){?>selected<? }?>>Male</option>
                          <option value="Female" <? if($_GET['staffsex']=="Female"){?>selected<? }?>>Female</option>
                        </select>
                      </span> </td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Address</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td valign="middle"><span class="style30">
                        <textarea name="staffaddress" cols="40" rows="2" ><? echo $_GET['staffaddress'];?></textarea>
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Postcode</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                      <input name="staffpostcode" type="text" size="20" maxlength="5" value="<? echo $_GET['staffpostcode'];?>" />
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Town</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                      <input name="stafftown" type="text" size="40" value="<? echo $_GET['stafftown'];?>" />
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">State</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                        <select name="staffState" id="State">
                          <option value="select">-Please Select-</option>
                          <option value="Johor" <? if($_GET['staffState']=="Johor"){?>selected<? }?>>Johor</option>
                          <option value="Kedah" <? if($_GET['staffState']=="Kedah"){?>selected<? }?>>Kedah</option>
                          <option value="Kelantan" <? if($_GET['staffState']=="Kelantan"){?>selected<? }?>>Kelantan</option>
                          <option value="Melaka" <? if($_GET['staffState']=="Melaka"){?>selected<? }?>>Melaka</option>
                          <option value="Negeri Sembilan" <? if($_GET['staffState']=="Negeri Sembilan"){?>selected<? }?>>Negeri Sembilan</option>
                          <option value="Pahang" <? if($_GET['staffState']=="Pahang"){?>selected<? }?>>Pahang</option>
                          <option value="Perak" <? if($_GET['staffState']=="Perak"){?>selected<? }?>>Perak</option>
                          <option value="Perlis" <? if($_GET['staffState']=="Perlis"){?>selected<? }?>>Perlis</option>
                          <option value="Penang" <? if($_GET['staffState']=="Penang"){?>selected<? }?>>Pulau Pinang</option>
                          <option value="Selangor" <? if($_GET['staffState']=="Selangor"){?>selected<? }?>>Selangor</option>
                          <option value="Terengganu" <? if($_GET['staffState']=="Terengganu"){?>selected<? }?>>Terengganu</option>
                          <option value="Wilayah Persekutuan" <? if($_GET['staffState']=="Wilayah Persekutuan"){?>selected<? }?>>Wilayah Persekutuan</option>
                          <option value="Sabah" <? if($_GET['staffState']=="Sabah"){?>selected<? }?>>Sabah</option>
                          <option value="Sarawak" <? if($_GET['staffState']=="Sarawak"){?>selected<? }?>>Sarawak</option>
                        </select>
                      </span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Tel. No.</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                      <input name="staffphone" type="text" size="15" maxlength="11" value="<? echo $_GET['staffphone'];?>" />
                      </span><span class="style32">eg.: 012-1234567&nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Email&nbsp;</td>
                      <td><span class="style30">:</span></td>
                      <td><span class="style30">
                      <input name="staffemail" type="text" value="<? echo $_GET['staffemail'];?>" size="30" maxlength="30" />
                      </span><span class="style32">eg.:name@yahoo.com</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Category</td>
                      <td><span class="style30">:&nbsp;</span></td>
                      <td><span class="style30">
                        <select name="staffcate" id="position">
                          <option value="select">-Select-</option>
                          <option value="Admin" <? if($_GET['staffcate']=="Admin"){?>selected<? }?>>Admin</option>
                          <option value="Staff" <? if($_GET['staffcate']=="Staff"){?>selected<? }?>>Staff</option>
						   <option value="Customer" <? if($_GET['staffcate']=="Customer"){?>selected<? }?>>Customer</option>
                        </select>
                      </span> </td>
                    </tr>
                    <tr> </tr>
                  </table>
                  <div align="center" class="style2 style3 style19"><strong>:: Register As System Login :: </strong></div>
                  <table width="421" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr>
                      <td width="115" height="20" class="style32">Username</td>
                      <td width="8"><span class="style32">:&nbsp;</span></td>
                      <td width="318"><span class="style32">
                        <input name="Username" type="text" size="20" maxlength="15" value="<? echo $_GET['Username'];?>" />
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="style32">Password</td>
                      <td><span class="style32">:&nbsp;</span></td>
                      <td><span class="style32">
                        <input name="Password" type="password" size="20" maxlength="10" value="<? echo $_GET['Password'];?>" />
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="20"><span class="style32">Retype Password</span></td>
                      <td><span class="style32">:&nbsp;</span></td>
                      <td><span class="style32">
                      <input name="Password2" type="password" size="20" maxlength="10" value="<? echo $_GET['Password'];?>" />
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="50"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td>&nbsp;</td>
                      <td valign="bottom"><input type="submit" name="Submit" value="Submit" onClick="return verify_staff()" />
                          <input type="reset" name="Reset" value="Reset" />
                          <input name="button" type="button" onClick="topage()" value=" Back" /></td>
                    </tr>
                    <tr>
                      <td colspan="3"><p class="style16">&nbsp;</p></td>
                    </tr>
                  </table>
                </form>
                <table width="50%" border="0" align="center">
                </table>
        
          </div>
        </div>
   

</body>
</html>
