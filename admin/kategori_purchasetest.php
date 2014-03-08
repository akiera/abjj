<?php

session_start();
if (!(session_is_registered("username")))
{session_unset();
session_destroy();
$url= "Location: ../";
header($url);
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


if($_POST['search'])
{
$month = $_POST['month'];
$tahun = $_POST['tahun'];
$cawangan = $_POST['cawangan'];
$sql = "Select * from t_purchase where month(tarikh) = $month and tahun(tarikh) = $tahun and cawangan = '$cawangan'";

$res = mysql_query($sql) or die(mysql_error());

while($row = mysql_fetch_array($res)){

echo $row['cawangan'] . " - " . $row['tarikh'] . " - " . $row['pembekal'];
echo "<BR>";

}
}

?>
<html>
<head>
	<title>ABJJ Techno Solution</title>

</head>

<body>
  
                <h2 class="style1">&nbsp;</h2>
                <p class="style1">&nbsp;</p>
                <p class="style1">&nbsp;</p>
<p align="center" class="style3 style17"><strong>PURCHASE REPORT</strong></p>
<table width="450" border="0" align="center" cellpadding="0" cellspacing="0" >

              
              
<form name="searchShop" method="post" action="all_purchase_report.php" target="_blank">
                      <td width="180" class="style10 style18 style24"> Mini Mart</td>
                      <td width="15"><span class="style26">:</span></td>
  <td width="400"><p>
                        <select name="cawangan" class="style10" id="cawangan">
                         <?php 

						$sql = 'SELECT * FROM `t_cawangan` LIMIT 0, 30 '; 

						$res = mysql_query($sql) or die(mysql_error());

						echo "<option>Please select</option>";
						while($row = mysql_fetch_array($res)){

						echo "<option value=\"".$row['namaCawangan']."\">".$row['namaCawangan']."</option>";

						}

						?>
                        </select>
  </td>
                 
                  </tr>
                  
                  
  <td width="180" class="style18 style10"><span class="style24">Month</span></td>
                      <td width="15"><span class="style26">:</span></td>
                      <td class="style16" width="401"><p>
                        <select name="month" id="month" class="style10">
                          <option value="">Please select</option>
                          <option value="1">Jan</option>
                          <option value="2">Feb</option>
                          <option value="3">Mac</option>
                          <option value="4">Apr</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">Aug</option>
                          <option value="9">Sept</option>
                          <option value="10">Oct</option>
                          <option value="11">Nov</option>
                          <option value="12">Dec</option>
                        </select>
                        </tr>
                    
  <td width="180" class="style18 style10"><span class="style24">Year</span></td>
                      <td width="15"><span class="style26">:</span></td>
                      <td class="style16" width="401"><p>
                          <select name="tahun" id="tahun" class="style10">
                          <option value="">Please select</option>
                          <option value="2010">2010</option>
                          <option value="2011">2011</option>
                          <option value="2012">2012</option>
                          <option value="2013">2013</option>
                          <option value="2014">2014</option>
                          <option value="2014">2015</option>
                          <option value="2014">2016</option>
                          </select>
  <td width="180" class="style18 style10"><span class="style24"></span></td>
                      <td width="15"><span class="style26"></span></td>
                      <td class="style16" width="401"><p>
                      </tr>
                                    
                      <td align="center" colspan="3" class="style16">
                        <p><br />
                          <input type="image" src="../images/paparLaporan.png" name="search" value="Search" />
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
</form>
</body>
</html>
