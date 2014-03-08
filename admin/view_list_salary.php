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

$month = $_POST['month'];

$year = $_POST['year'];
$cawangan = $_POST['cawangan'];

$report_date = date("Y M d");
?>

<?php
    
    if($month=="JANUARY")
    	$bulan1="JANUARY";
    elseif($month=="FEBRUARY")
    	$bulan1="FEBRUARY";
    elseif($month=="MARCH")
    	$bulan1="MARCH";
    elseif($month=="APRIL")
    	$bulan1="APRIL";
    elseif($month=="MAY")
    	$bulan1="MAY";
    elseif($month=="JUNE")
    	$bulan1="JUNE";
    elseif($month=="JULY")
    	$bulan1="JULY";
    elseif($month=="AUGUST")
    	$bulan1="AUGUST";
    elseif($month=="SEPTEMBER")
    	$bulan1="SEPTEMBER";
    elseif($month=="OCTOBER")
    	$bulan1="OCTOBER";
    elseif($month=="11")
    	$bulan1="NOVEMBER";
    else
    	$bulan1="DECEMBER";
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
<form id="form1" method="post" action="?p=salary">
  <tr>
  <td width="640"  bkground="" style="bkground-repeat:no-repeat; bkground-position:center " >
    <p align="center" class="style1"><? echo $cawangan = $_POST['cawangan']; ?></p>
    <p align="center"><span class="style2"><strong>SALARY LIST FOR</strong> <strong><?php echo $bulan1; ?>&nbsp;<? echo $year; ?></strong></span></p>
    <table class="display" id="data_tbl_tools">
      <thead>
        <tr>
          <th width="35"> No. </th>
          <th width="182"> Staff Name</th>
          <th width="70"> Salary </th>
          <th width="67"> Advance</th>
          <th width="73">Total </th>
          <th width="91"> Detail</th>
        </tr>
      </thead>
       <?php 
		        
		$sql = "SELECT * FROM t_salary WHERE cawangan='$cawangan' and month = '$month' and year = '$year' ORDER BY idSalary";
		$result = mysql_query($sql) or die ('Data salary cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
      <tr class="">
        <td align="center"><? echo $i; ?></td>
        <td align="left"><? echo $record["name"];?></td>
        <td align="center"><? echo $record["salary"];?></td>
        <td align="center"><? echo $record["advance"];$totalAmaun=$record["salary"]+$record["advance"];?></td>
        <td align="left"><div align="right"><? echo $totalAmaun;$totalAmaunt+=$totalAmaun;?></div></td       
        ><td bgcolor="#99FFFF"><div align="center"><a href='?p=viewsalary&idSalary=<? echo $record["idSalary"]; ?>' class="style27">Detail</a></div></td>
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
          <th align="right"><strong><? echo number_format($totalAmaunt,2, ".", ",");?></strong></th>
          <th></th>
        </tr>
    </table>
    <div class="form_input">
      <div align="center">
        <button type="submit" class="btn_small btn_orange"><span>New Salary</span></button>
        </a> </div>
    </div>
  <tr>
  
  <tr>
        </body>
</html>
