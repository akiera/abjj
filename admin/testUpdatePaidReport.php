<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}

include '../connection/data2.php';

if(isset($_POST['Submit'])){

//var_dump($_POST['checkbox']);

$array = $_POST['checkbox'];

//echo count($array);

for($x=0; $x<count($array); $x++){
//echo $array[$x];

$sql = "UPDATE `t_purchase` SET `status` = 'PAID' WHERE `t_purchase`.`id` = $array[$x] LIMIT 1;"; 

mysql_query($sql) or die(mysql_error());

	echo "<script>alert('The related status record has been updated from database!!');";
	print "window.location='index.php?p=payment'";
	print "</script> ";

}





}


?>