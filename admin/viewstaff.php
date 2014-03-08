<?php
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}
require_once('../connection/data2.php'); 

$IC =$_GET['staff_ic'];
$query1= "SELECT * FROM t_staff WHERE staff_ic ='$IC'"; 
$result1 = mysql_query($query1) or die ('Data Staff cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("staff_ic");
$_SESSION['IC'] = $record1["staff_ic"];

$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);



$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

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
<style type="text/css">
<!--
.style2 {color: #000000}
-->
</style>
</head>

<body>

                <h2 class="style12">&nbsp;</h2>
<form action="?p=edit_Staff" method="post" id="form1">
                  <table width="400" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style6">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#669966">
                      <td height="42" colspan="3" bordercolor="#000000" bgcolor="#000000"><div align="center" class="style6 style7 style2"><strong>User  Information</strong></div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="80" height="25" bgcolor="#99FF66"><span class="style15">Name :</span></td>
                      <td width="220" bgcolor="#99FF66"><span class="style16"><? echo $record1["staff_name"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF" class="style15">IC No. :</td>
                      <td bgcolor="#00FFFF"><span class="style16"><? echo $record1["staff_ic"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66" class="style15">Sex :</td>
                      <td bgcolor="#99FF66"><span class="style16"><? echo $record1["staff_sex"]; ?>&nbsp;</span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style15">Address :</span></td>
                      <td bgcolor="#00FFFF"><span class="style16"><? echo $record1["staff_add"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style15">Postcode :</span></td>
                      <td bgcolor="#99FF66"><span class="style16"><? echo $record1["staff_post"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style15">Town :</span></td>
                      <td bgcolor="#00FFFF"><span class="style16"><? echo $record1["staff_town"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style15">State :</span></td>
                      <td bgcolor="#99FF66"><span class="style16"><? echo $record1["staff_state"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style15">Tel. No. :</span></td>
                      <td bgcolor="#00FFFF"><span class="style16"><? echo $record1["staff_tel"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#99FF66"><span class="style15">Email :</span></td>
                      <td bgcolor="#99FF66"><span class="style16"><? echo $record1["staff_email"]; ?></span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="25" bgcolor="#00FFFF"><span class="style15">Position :</span></td>
                      <td bgcolor="#00FFFF"><span class="style16"><? echo $record1["staff_cat"]; ?></span></td>
                    </tr>
                    <tr> </tr>
                    
                  </table>
  <p>&nbsp;</p>
                  
                  
							
									<div align="center" class="form_input">
									  <button type="image" class="btn_small btn_blue" value='Edit' name='editstaff'><span>Edit</span></button>
                                        <input type="hidden" name="staff_ic" value="<? echo $record1["staff_ic"]; ?>" />
                                         <a href='delete_Staff.php?staff_ic=<? echo $record1["staff_ic"]; ?>' onClick="return confirm_del()">
									  <button type="button" class="btn_small btn_blue"><span>Delete</span></button>
									</div>								
                  </form>
                <table width="50%" border="0" align="center">
                </table>
        
     
      
 

</body>
</html>
