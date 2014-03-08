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
          <p>CASH BOOK RECONCILE FOR <strong><?php echo $bulan1; ?></strong> <strong>&nbsp;<? echo $tahun = $_POST['tahun']; ?></strong></p></TD>		  
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
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount In(RM)</td>
        </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor="#00CCCC">Amount Out (RM)</td>
             
        </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir != 'B/F' ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="left" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["masuk"]; $totalMasuk+=$record["masuk"]; ?></td>
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["keluar"]; $totalAmaun+=$record["keluar"];  $bal+=$record["masuk"]-$record["keluar"];?></td>
		
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalMasuk,2, ".", ",");?></strong></td>
          <td align="right" bgcolor="#9999FF"><strong><? echo number_format($totalAmaun,2, ".", ","); $baki=$totalMasuk-$totalAmaun;?></strong></td>
         
         
</tr>
      </table>
        
        <table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><p><strong>CASH OUT</strong></p>
	      <p><strong>A) Bank In</strong></p></td>
        </tr>
        <tr class="style9"> 
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount (RM)</td>
         </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="73" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>         
          </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir = 'BANK IN' ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["keluar"]; $totalBankin+=$record["keluar"];  $bal+=$record["masuk"]-$record["keluar"];?></td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalBankin,2, ".", ",");?></strong></td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
</tr>
      </table>
      <table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><p><strong>B) Bos Advance</strong></p></td>
        </tr>
        <tr class="style9"> 
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount (RM)</td>
        </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="73" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>         
        </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir = 'BOS ADVANCE' ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["keluar"]; $totalBos+=$record["keluar"];  $bal+=$record["masuk"]-$record["keluar"];?></td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalBos,2, ".", ",");?></strong></td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
</tr>
      </table>
      <table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><p><strong>C) Others</strong></p></td>
        </tr>
        <tr class="style9"> 
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount (RM)</td>
        </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="73" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>         
        </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir != 'BANK IN' and butir != 'BOS ADVANCE' and butir != 'CASH TRANSFER' and butir != 'B/F' and keluar ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["keluar"]; $totalOth+=$record["keluar"];  $bal+=$record["masuk"]-$record["keluar"];?></td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalOth,2, ".", ",");?></strong></td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
</tr>

      </table>
       <table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><p><strong>D) Salary</strong></p></td>
        </tr>
        <tr class="style9"> 
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount (RM)</td>
         </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="73" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>         
         </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir = 'SALARY' ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["keluar"]; $totalSalary+=$record["keluar"];  $bal+=$record["masuk"]-$record["keluar"];?></td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalSalary,2, ".", ",");?></strong></td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
</tr>
      </table>
      <table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><p><strong>CASH IN</strong></p>
	      <p><strong>A) Cash Transfer</strong></p></td>
        </tr>
        <tr class="style9"> 
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount (RM)</td>
        </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="73" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>         
        </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir = 'CASH TRANSFER' ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["masuk"]; $totalCash+=$record["masuk"]; ?></td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalCash,2, ".", ",");?></strong></td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
</tr>
      </table>
       <table align="center" width="765" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="10"><p><strong>B) Others</strong></p></td>
        </tr>
        <tr class="style9"> 
          <td width="49" rowspan="2" align="center" bgcolor="#00CCCC">No.</td>
          <td width="232" align="center" rowspan="2" bgcolor="#00CCCC"> Particulars</td>
          <td width="93" rowspan="2" align="center" bgcolor="#00CCCC">Date</td>
          <td width="157" rowspan="2" align="center" bgcolor="#00CCCC">Amount (RM)</td>
         </tr>
        
        <tr class="style9"> 
          <td width="121" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="73" align="center" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>         
          </tr>
		<tr>
        </tr>
        
		 <?php 
		        
			$sql = "SELECT * FROM t_cashbook WHERE cawangan='$cawangan' and month(tarikh) = $month2 and year(tarikh) = $tahun and butir != 'CASH TRANSFER' and butir != 'B/F' and masuk ORDER BY tarikh";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
        <tr class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i; ?></td>
          <td align="center" bgcolor="#CCFFFF"><? echo $record["butir"];?></td>
          <td align="right" bgcolor="#CCFFFF"><? echo $record["tarikh"];?></td>
          
		  <td align="center" bgcolor="#CCFFFF"><? echo $record["masuk"]; $totalTah+=$record["masuk"];  ?></td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
		  <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
       
		<? $i++;}?> 
<tr class="style8">
<td></td>
<td align="center"><strong>Total</strong></td>
<td align="left" bgcolor="#9999FF"><!--DWLayoutEmptyCell-->&nbsp;</td>

<td align="center" bgcolor="#9999FF"><strong><? echo number_format($totalTah,2, ".", ",");?></strong></td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="right" bgcolor=""><!--DWLayoutEmptyCell-->&nbsp;</td>
         
</tr>
      </table>
      <table align="center" width="730">
        <tr></tr>
      </table>
      <table align="center" width="730">
        <!--DWLayoutTable-->
        <tr>
          <td colspan="5">
          ________________________________________________________________________________________</td>
        </tr>
        <tr>
          <td colspan="3"><span class="style9">*Summary</span></td>
        </tr>
        <tr>
          <td width="92"><span class="style8"> Total Cash Out</span></td>
          <td width="6">:</td>
          <td width="616"><strong><? echo number_format($totalAmaun,2, ".", ","); $baki=$totalMasuk-$totalAmaun;?></strong></td>
        </tr>
        <tr>
          <td><span class="style8">Total Cash In</span></td>
          <td>:</td>
          <td><strong><? echo number_format($totalMasuk,2, ".", ",");?></strong></td>
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
