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
function submitsupplier()
{
	if(document.addsup.companyname.value=="") 
	{
		alert("Please fill in company name!");
		login.username.focus();
		return false;
	}
	if (document.login.password.value=="")
	{
		alert('Please insert your password!');
		login.password.focus();
		return false;
	}
}	
</script>
<script language="JavaScript" type="text/JavaScript">
function topage() { 
		window.location="?p=snarai_pembekal";
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
                <form action="process_supplier.php" method="post" id="form1">
                  <table width="460" border="0"  bordercolor="#336699" align="center" class="style6" cellpadding="3" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr>
                      <td colspan="3" bgcolor="#330000"><div align="center" class="style17 style2 style1"><strong>Add New Supplier</strong></div></td>
                    </tr>
                    <tr>
                      <td width="135" height="20"><span class="style18">Supplier Id</span></td>
                      <td width="7"><span class="style18">:&nbsp;</span></td>
                      <td width="300"><span class="style18">SP0
                        <?
						//Select the last supplier num in table supplier
						$sqlsupp = "SELECT * FROM t_pembekal ORDER BY id";
				        $resultsupp = mysql_query($sqlsupp) or die ('Data supplier cannot be reach. ' . mysql_error());
						while($rowsupp = mysql_fetch_array($resultsupp))
						{ $latest_supp = $rowsupp["idPembekal"]; }
						$supID=$latest_supp+1; //add with 1 
						echo $supID;
						//make it hidden to pass value
						?>
                      <input name="supID" type="hidden" value="<? echo $supID; ?>" />
                      </span></td>
                    </tr>
                    <tr>
                      <td height="20"><span class="style18">Supplier Name</span></td>
                      <td><span class="style18">:&nbsp;</span></td>
                      <td><input name="namaPembekal" type="text" size="50" maxlength="50" />                      </td>
                    </tr>
                    <tr>
                      <td height="20"><span class="style18">Address</span></td>
                      <td><span class="style18">:&nbsp;</span></td>
                      <td><span class="style18">
                        <textarea name="alamatPembekal" cols="40" rows="2"></textarea>
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td height="50"><span class="style18"></span></td>
                      <td><span class="style18"></span></td>
                      <td valign="bottom"><span class="style18">
                      <input type="image" name="addsup" value="Tambah" onClick="return submitsupplier()" src="../images/tambah.png" />
                        <input type="image" name="Reset" value="Semula" src="../images/Semula.png" />
                      <input name="button" type="image" onClick="topage()" value="Kembali" src="../images/kembali.png"/>
                      </span></td>
                    </tr>
                  </table>
</form>
                <table width="50%" border="0" align="center">
                </table>
    
  
  </body>
</html>
