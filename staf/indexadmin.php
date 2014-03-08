<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='2')   // 1 = user for administrator
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
?>
<html>
<head>
	
	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {font-size: large}
-->
    </style>
<body>
<p align="center" class="style4 style2 style1"><strong>Welcome Manager !!!</strong></p>
<p align="center" class="style4 style2"><strong>View Profile</strong> : <a href='?p=viewstaff&staff_ic=<? echo $_SESSION['staff_ic']; ?>'><? echo $_SESSION['staff_name']; ?></a></p>
<p align="center" class="style4 style2"><strong>Change Password</strong> :<a href="?p=edit_Password&staff_ic=<? echo $_SESSION['staff_ic']; ?>"><img src="../admin/images/ChangePassword.png" alt="Change Password" width="33" height="28" border="0"></a></p>
<p align="center" class="style4 style2"><strong><blink></blink></strong></p>
</body>
</html>
