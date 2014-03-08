<?php 
session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../index.php";
header($url);
}

include '../connection/data2.php';
$query1= mysql_query("SELECT * FROM logins WHERE username='". $_SESSION['username']."'");
$record1 = mysql_fetch_array($query1);
session_register("username");
$_SESSION['staff_ic'] = $record1["user_ic"];


$query2= mysql_query("SELECT * FROM t_staff WHERE  staff_ic='". $_SESSION['staff_ic']."'");
$record2 = mysql_fetch_array($query2);
session_register("staff_name");
$_SESSION['staff_name']=$record2["staff_name"];
session_register("user_ic");
$_SESSION['user_ic']=$record2["user_ic"];


$nama=$_SESSION['username'];
$date = date("d-m-Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

$month2 = $_POST['month2'];

$tahun = $_POST['tahun'];
$cawangan = $_POST['cawangan'];

$report_date = date("Y M d");
?>

<?php
    
    if($month2=="01")
    	$bulan1="JANUARI";
    elseif($month2=="02")
    	$bulan1="FEBRUARI";
    elseif($month2=="03")
    	$bulan1="MAC";
    elseif($month2=="04")
    	$bulan1="APRIL";
    elseif($month2=="05")
    	$bulan1="MEI";
    elseif($month2=="06")
    	$bulan1="JUN";
    elseif($month2=="07")
    	$bulan1="JULAI";
    elseif($month2=="08")
    	$bulan1="OGOS";
    elseif($month2=="09")
    	$bulan1="SEPTEMBER";
    elseif($month2=="10")
    	$bulan1="OKTOBER";
    elseif($month2=="11")
    	$bulan1="NOVEMBER";
    else
    	$bulan1="DISEMBER";
    	
  
  ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ABJJ Techno Solution</title>
<style type="text/css">
<!--
.style1 {
	font-size: medium;
	font-weight: bold;
}
.style2 {font-size: medium}
-->
</style>
</head>

<body>
<form id="form1" method="post" action="?p=bank_in">
  <tr>
  <td width="640"  bkground="" style="bkground-repeat:no-repeat; bkground-position:center " >
    <p align="center" class="style1">Mini Mart <? echo $cawangan = $_POST['cawangan']; ?></p>
    <p align="center"><span class="style2"><strong>BANK IN RECORD LIST FOR</strong> <strong><?php echo $bulan1; ?>&nbsp;<? echo $tahun = $_POST['tahun']; ?></strong></span></p>
    <table class="display" id="data_tbl_tools">
      <thead>
        <tr>
          <th width="35"> No. </th>
          <th width="115"> Particulars</th>
          <th width="94"> Date </th>
          <th width="80"> Time</th>
          <th width="75"> Amount </th>
          <th width="59">No. Slip</th>
          <th width="56"> Detail</th>
        </tr>
      </thead>
       <?php 
		        
		$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir = 'BANK IN' ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Cash Book cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
      <tr class="">
        <td align="center"><? echo $i; ?></td>
        <td align="left"><? echo $record["butir"];?></td>
        <td align="center"><? echo $record["tarikh"];?></td>
        <td align="center"><? echo $record["masa"];?></td>
        <td align="left"><div align="right"><? echo $record["keluar"]; $totalAmaun+=$record["keluar"];?></div></td>
        <td align="center"><? echo $record["noslip"];?></td>
        <td bgcolor="#99FFFF"><div align="center"><a href='?p=viewbankin&idCash=<? echo $record["idCash"]; ?>' class="style27">Detail</a></div></td>
      </tr>
      <?
		 	$i++;
		}
?>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>  </th>
          <th> Total Amount</th>
          <th></th>
          <th>&nbsp;</th>
          <th align="right"><strong><? echo number_format($totalAmaun,2, ".", ",");?></strong></th>
          <th>&nbsp;</th>
          <th></th>
        </tr>
    </table>
    <div class="form_input">
      <div align="center">
        <button type="submit" class="btn_small btn_orange"><span>New Bank In</span></button>
        </a> </div>
    </div>
  <tr>
  
  <tr>
        </body>
</html>
