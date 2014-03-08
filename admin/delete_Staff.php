<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
}

include '../connection/data2.php';

$staff_ic = $_GET['staff_ic'];

$query= "DELETE FROM t_staff WHERE staff_ic='$staff_ic'"; 
$result = mysql_query($query) or die ('Data of staff cannot be reach. ' . mysql_error());

$query2= "DELETE FROM logins WHERE user_ic='$staff_ic'"; 
$result2 = mysql_query($query2) or die ('Data of login cannot be reach. ' . mysql_error());

	echo "<script>alert('The related staff record has been successfully deleted from database!');";
	print "window.location='index.php?p=staff_list'";
	print "</script> ";
?>

