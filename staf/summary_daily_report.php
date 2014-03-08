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

$category=$_POST['category'];

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

<html>
<head>
<title>ABJJ Techno Solution</title>

<style type="text/css">
<!--
	
.style7 {
	color: #000000; 
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 11px; 
	}

.style8 {
	color: #000000; 
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 11px; 
	}
	
.style9 {
	color: #000000; 
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 11px; font-weight: bold;
	}
	

.style22 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13PX; font-weight: bold;}
.style35 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: normal; }
.style40 {font-size: 14px;
	font-weight: bold;
}
.style41 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<table width="730" align="center">
<tr>
<td><br>
		<table align="center" width="730">
        <!--DWLayoutTable-->
        <tr > 
          <td width="118" rowspan="6"><img src="../images/logoABJJ.jpg" width="278" height="146" longdesc="../images/logo.JPG"></td>
          <td width="616"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="1"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><span class="style40">ABJJ Techno Solution</span></td>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style41">1-12, Blok C, Jln Pulai Perdana 11/7,</span></td> 
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style41">Tmn Sri Pulai Perdana, </span></td> 
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style41">81110 Johor Bahru, Johor.</span></td> 
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="right" class="style7">Date:<span class="style7"><? echo $date ?></span></td>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <TR> 
          <TD colspan="3">________________________________________________________________________________________</TD>
          <td>&nbsp;</td>
        </TR>
      </table>
		
		
      <table align="center" width="730">
        <!--DWLayoutTable-->
        <TR class="style22"> 
          <td width="732" align="center"><p><strong><? echo $cawangan = $_POST['cawangan']; ?></strong></p>
          <p>SUMMARY OF  DAILY REPORT FOR <strong><?php echo $bulan1; ?></strong> <strong>&nbsp;<? echo $tahun = $_POST['tahun']; ?></strong></p></TD>		  
        </TR>
		<tr class="style22">
          <td width="732" align="center">
		  
		  </td>
	    </tr>
      </table>
</td></tr>

<tr>
<td>
		<table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
        <tr class="style9"> 
          <td width="24" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="78" align="center" rowspan="2" bgcolor="#00CCCC"> Date</td>
          <td width="59" rowspan="2" align="center" bgcolor="#00CCCC">Sales</td>
          <td colspan="4" align="center" bgcolor="#00CCCC">Cash Expenses (RM)</td>
          <td width="80" rowspan="2" align="center" bgcolor="#00CCCC">Advance Claims (RM)</td>
          <td width="92" rowspan="2" align="center" bgcolor="#00CCCC">Cash Transfer (RM)</td>
          <td width="81" rowspan="2" align="center" bgcolor="#00CCCC">Cash Bank In(RM)</td>
         </tr>
        
        <tr class="style9"> 
          <td width="65" align="center" bgcolor="#00CCCC">Purchase</td>
          <td width="68" align="center" bgcolor="#00CCCC">Salary</td>
          <td width="80" align="center" bgcolor="#00CCCC">Others</td>
          <td width="74" align="center" bgcolor="#00CCCC">Total</td>
          </tr>
		<tr>
		  <td colspan="10" height="15"><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
        
		 <?php 
		        
		$sql = "SELECT * FROM t_dailyReport WHERE cawangan='$cawangan' and month(date) = $month2 and year(date) = $tahun ORDER BY date";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["date"]; ?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo number_format(floatval($record["sales"]),2, ".", ","); $totalSales+=$record["sales"]; ?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo number_format(floatval($record["purchase"]),2, ".", ","); $totalPurchase+=$record["purchase"]; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo number_format(floatval($record["salary"]),2, ".", ","); $totalSalary+=$record["salary"]; ?></td>
		  <td align="center" bgcolor="#CCFFFF"><? echo number_format(floatval($record["others"]),2, ".", ","); $totalOthers+=$record["others"];?></td>
		  <td align="right" bgcolor="#CCFFFF"><strong>
		    <? $total=$record["purchase"]+$record["salary"]+$record["others"];			
			   				echo number_format($total,2, ".", ",");
							$allTotal+=$total;
						?>
		  </strong></td>
		  <td align="right" bgcolor="#CCFFFF"><? echo number_format(floatval($record["advance"]),2, ".", ","); $totalAdvance+=$record["advance"]?></td>
          <td align="right" bgcolor="#CCFFFF"><strong>
            <? $cashTransfer=$record["sales"]-$total;			
			   				echo number_format($cashTransfer,2, ".", ",");
							$allCashTransfer+=$cashTransfer;
						?>
          </strong></td>
          <td align="right" bgcolor="#CCFFFF"><? echo number_format(floatval($record["cashBankIn"]),2, ".", ","); $totalcashBankIn+=$record["cashBankIn"] ?></td>
        </tr>
        <tr height="0.5"> 
          <td colspan="10"><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><strong><? echo number_format($totalSales,2, ".", ",");?></strong></td>
<td align="left" bgcolor="#9999FF"><strong><? echo number_format($totalPurchase,2, ".", ",");?></strong></td>
<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalSalary,2, ".", ",");?></strong></td>
<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalOthers,2, ".", ",");?></strong></td>
          <td align="right" bgcolor="#9999FF"><strong><? echo number_format($allTotal,2, ".", ",");?></strong></td>
          <td align="right" bgcolor="#9999FF"><strong><? echo number_format($totalAdvance,2, ".", ",");?></strong></td>
          <td align="right" bgcolor="#9999FF"><strong><? echo number_format($allCashTransfer,2, ".", ",");?></strong></td>
           <td align="right" bgcolor="#9999FF"><strong><? echo number_format($totalcashBankIn,2, ".", ",");?></strong></td>
</tr>
      </table>
        
        
      <table align="center" width="730">
        <tr></tr>
      </table>
      <table align="center" width="730">
        <!--DWLayoutTable-->
        <tr>
          <td colspan="5">________________________________________________________________________________________</td>
        </tr>
        <tr>
          <td colspan="3"><span class="style9">*Difference Total Sales Based On Cash Expenses</span></td>
        </tr>
        <tr>
          <td width="92"><span class="style8">Total Sales</span></td>
          <td width="6">:</td>
          <td width="616"><span class="style41"><? echo number_format($totalSales,2, ".", ",");?></span></td>
        </tr>
        <tr>
          <td><span class="style8">Cash Expenses</span></td>
          <td>:</td>
          <td><span class="style41"><? echo number_format($allTotal,2, ".", ",");?></span></td>
        </tr>
        <tr>
          <td><span class="style8">Cash Balance</span></td>
          <td>:</td>
          <td><span class="style41"><strong>
            <? $cashBal=$totalSales-$allTotal;			
			   				echo number_format($cashBal,2, ".", ",");
							//$allTotal+=$total;
						?>
          </strong></span></td>
        </tr>
        <tr>
          <td><span class="style8">Act. Cash Bal</span></td>
          <td>:</td>
          <td><span class="style41"><? echo number_format($allCashTransfer,2, ".", ",");?></span></td>
        </tr>
        <tr>
          <td><span class="style8"> Difference</span></td>
          <td>:</td>
          <td><span class="style41"><strong>
            <? $difference=$cashBal-$allCashTransfer;			
			   				echo number_format($difference,2, ".", ",");
							//$allTotal+=$total;
						?>
          </strong></span></td>
        </tr>
        
        <tr>
          <td colspan="5">________________________________________________________________________________________</td>
        </tr>
      </table>  
      <p align="left" class="style8">&nbsp;</p>
     
      <p align="left" class="style8">Prepared By: <? echo $_SESSION['staff_name']; ?></p>
      <center>
	  <div>
	    <input type="image" img src="../images/Printicon.png" width="40" height="40" border="0" alt="Print" onClick="window.print()"></div>
       </center>
        <p align="left" class="style35">&nbsp;</p>
        <p>&nbsp;</p>
</td>
</tr>
</table>


</body>
</html>
