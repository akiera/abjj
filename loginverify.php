<?php
session_start();

$user_name = $_POST["username"];
$userpassword = $_POST["password"];
$verified = VerifyUser ($user_name, $userpassword, $user_type);
$_SESSION["user_type"] = $user_type;
$_SESSION["username"] = $user_name;
?>

<?php
if (!$verified)
{ $to_page = "index.php"
?>
 <script type="text/javascript">
  alert("Your username or password is invalid, Please Re-type your username & password!!! ");
  </script>

	<title>ABJJ techno Solution</title>
    
    <h2 align="center">&nbsp;</h2>
                <p align="center">&nbsp;</p>
                <p align="center" class="style2">LOGIN FAILED. PLEASE TRY AGAIN </p>
                <h2 align="center">Loading previous page... </h2>
                <h2 align="center"><img src="images/loading.gif"></h2>
	
<?php
echo "<meta http-equiv = 'Refresh' content = '2; url = $to_page'>\n";
?>
<?php
}
else if ($user_type==1)
{

?>
<?php
 $to_page = "admin/index.php";
?>

	<title>ABJJ techno Solution</title>
	
    <p align="center" class="style2">&nbsp;</p>
                <p align="center" class="style2">&nbsp;</p>
                <p align="center" class="style2">LOGIN SUCCESSFUL!!</p>
                <h2 align="center">Loading admin page...</h2>
                <h2 align="center"><img src="images/loading.gif"></h2>
                <div class="clear"> </div>
                  
 <?php
		  echo "<meta http-equiv = 'Refresh' content = '2; url = $to_page'>\n";
   ?>

<?php

}
else if ($user_type==2)
{
 $to_page = "staf/index.php";

?>  
	<title>ABJJ techno Solution</title>
	
                <p align="center" class="style2">&nbsp;</p>
                <p align="center" class="style2">&nbsp;</p>
                <p align="center" class="style2">LOGIN SUCCESSFUL!!</p>
    <h2 align="center">Loading Manager Page...</h2>
                <h2 align="center"><img src="images/loading.gif"></h2>
                <div class="clear"> </div>
                            
   <?php
		  echo "<meta http-equiv = 'Refresh' content = '2; url = $to_page'>\n";
   ?>
                 
 <?php
		  echo "<meta http-equiv = 'Refresh' content = '2; url = $to_page'>\n";
   ?>
</body>
   </html>
<?php

}
?>

<?php

function VerifyUser($uname, $upass, &$utype)
{
	   
require_once('connection/data2.php'); 
mysql_select_db(SQL_DB, $conn);
	$query = mysql_query("select * from logins where username = '$uname' and password = '$upass'");

	$record = mysql_fetch_array($query);

	if ($record)
	{
		$utype = $record["user_type"];
		$query="UPDATE logins SET data_2=NOW() WHERE username = '$uname'";
	    mysql_query($query);
		return true;
	}

	return false;
}
?>