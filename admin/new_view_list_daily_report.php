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

$tahun = $_POST['tahun'];
$cawangan = $_POST['cawangan'];

$report_date = date("Y M d");
?>

<?php
    
    if($month=="01")
    	$bulan1="JANUARI";
    elseif($month=="02")
    	$bulan1="FEBRUARI";
    elseif($month=="03")
    	$bulan1="MAC";
    elseif($month=="04")
    	$bulan1="APRIL";
    elseif($month=="05")
    	$bulan1="MEI";
    elseif($month=="06")
    	$bulan1="JUN";
    elseif($month=="07")
    	$bulan1="JULAI";
    elseif($month=="08")
    	$bulan1="OGOS";
    elseif($month=="09")
    	$bulan1="SEPTEMBER";
    elseif($month=="10")
    	$bulan1="OKTOBER";
    elseif($month=="11")
    	$bulan1="NOVEMBER";
    else
    	$bulan1="DISEMBER";
    	
  
  ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ABJJ Techno Solution</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style type="text/css">
<!--
.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
}
.style7 {
	font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#FFFFFF}
	
.style9 {
	font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:blk}

-->
</style>
</head>

<body>

  <tr>
    <td width="160" valign="top">&nbsp;</td>
  <td width="640"  bkground="" style="bkground-repeat:no-repeat; bkground-position:center " ></br>
    <p>&nbsp;</p>
    <table width="580" align="center" border="0">
		<tr><td width="732" align="center"><p><strong><? echo $cawangan = $_POST['cawangan']; ?></strong></p>
          <p><strong>DAILY REPORT LIST FOR</strong> <strong><?php echo $bulan1; ?>&nbsp;<? echo $tahun = $_POST['tahun']; ?></strong></p></TD>
		</tr>
		
		
					
		</table>
		
		<table width="580" align="center" border="1">
		<tr>
		  <td align="center" colspan="5" bgcolor="#CCFFFF"><span class="style5">Daily Report List</span></td>
		</tr>
		</table>
		
		</br>
<form id="form1" method="post" action="#">
		<table width="756" align="center" border="1">
		<tr class="style7">
	  	  <td width="4%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>No.</strong></td>
		  <td width="11%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Date</strong></td>
		  <td width="7%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Sales (RM)</strong></td>
	  	  <td height="32" colspan="4" align="center" bgcolor="#CC00FF"><strong>Cash Expenses (RM)</strong><strong></strong></td>
          <td width="8%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Cash (RM)</strong><strong></strong></td>
    	  <td width="6%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>B/F (RM)</strong><strong></strong></td>
		  <td width="9%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Advance Claims (RM)</strong><strong></strong></td>
	  	  <td width="12%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Cash Transfer(RM)</strong><strong></strong></td>
		  <td width="8%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Cash Bank In (RM)</strong><strong></strong></td>
	  	  <td width="4%" rowspan="2" align="center" bgcolor="#CC00FF"><strong>Edit</strong><strong></strong></td>
		</tr>
        <tr class="style7">
	  	  <td width="9%" height="20" align="center" bgcolor="#CC00FF"><strong>Purchase</strong></td>
		  <td width="7%" align="center" bgcolor="#CC00FF"><strong>Salary</strong></td>
	  	  <td width="7%" align="center" bgcolor="#CC00FF"><strong>Others</strong></td>
          <td width="8%" align="center" bgcolor="#CC00FF"><strong>Total</strong></td>
		  </tr>
<?php 
		        
		$sql = "SELECT * FROM t_dailyReport WHERE cawangan='$cawangan' and month(date) = $month and year(date) = $tahun ORDER BY date";
		$result = mysql_query($sql) or die ('Data Daily Report cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
		
                              <tr bgcolor="#99FFFF" class="style9" onMouseOver="this.bgColor='#D3FCAB'" onMouseOut="this.bgColor='#99FFFF'">
                                <td><div align="center"><? echo $i; ?></div></td>
                                <td><div align="center"><? echo $record["date"]; ?></div></td>
                                <td ><div align="center"><? echo $record["sales"]; $totalSales+=$record["sales"]; ?></div></td>
								<td><div align="center"><? echo $record["purchase"]; $totalPurchase+=$record["purchase"]; ?></div></td>
                                <td><div align="center"><? echo $record["salary"]; $totalSalary+=$record["salary"]; ?></div></td>
                                <td><div align="center"><? echo $record["others"]; $totalOthers+=$record["others"];?></div></td>
                                <td><div align="right"><strong>
                                  <? $total=$record["purchase"]+$record["salary"]+$record["others"];			
			   				echo number_format($total,2, ".", ",");
							$allTotal+=$total;
						?>
                                </strong></div></td>
                                <td ><div align="center"><? $cash=$record["sales"]+$total;			
			   				echo number_format($cash,2, ".", ",");
							$allCash+=$cash;
						?></div></td>
                                <td ><div align="center"><? echo $record["bf"]; $totalBf+=$record["bf"]?></div></td>
                                <td ><div align="center"><? echo $record["advance"]; $totalAdvance+=$record["advance"]?></div></td>
								<td><div align="center"><? echo $record["cashTransfer"]; $totalcashTransfer+=$record["cashTransfer"]?></div></td>
                                <td><div align="center"><? echo $record["cashBankIn"]; $totalcashBankIn+=$record["cashBankIn"] ?></div></td>
                                <td bgcolor="#99FFFF"><div align="center"><a href='?p=new_viewDailyReport&idDailyReport=<? echo $record["idDailyReport"]; ?>' class="style27">Edit</a></div></td>
                                <? $i++;}?>
                                <tr bgcolor="#99FFFF" class="style9" onMouseOver="this.bgColor='#D3FCAB'" onMouseOut="this.bgColor='#99FFFF'">
                                <td><div align="center"></div></td>
                                <td bgcolor="#99CCFF"><div align="left"><strong>Total</strong></div></td>
                                <td bgcolor="#99CCFF" ><div align="center"><strong><? echo number_format($totalSales,2, ".", ",");?></strong></div></td>
								<td bgcolor="#99CCFF"><div align="center"><strong><? echo number_format($totalPurchase,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF"><div align="center"><strong><? echo number_format($totalSalary,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF"><div align="center"><strong><? echo number_format($totalOthers,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF"><div align="right"><strong><? echo number_format($allTotal,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF" ><div align="center"><strong><? echo number_format($allCash,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF" ><div align="center"><strong><? echo number_format($totalBf,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF" ><div align="center"><strong><? echo number_format($totalAdvance,2, ".", ",");?></strong></div></td>
								<td bgcolor="#99CCFF"><div align="center"><strong><? echo number_format($totalcashTransfer,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99CCFF"><div align="center"><strong><? echo number_format($totalcashBankIn,2, ".", ",");?></strong></div></td>
                                <td bgcolor="#99FFFF"><div align="center"></div></td>
</tr>
                              
                              <?php
				if ($i<1)
				{
					echo "<script>alert('Zero result was found for your search!');";
					print "window.location='?p=list_daily_report'";
					print "</script> ";
				}			
				
				else
				{
						       	$page_name="item.php"; //  If you use this code with a different page ( or file ) name then change this 
				
								$start=$_GET['start'];								// To take care global variable if OFF
								if(!($start > 0)) {                         // This variable is set to zero for the first page
								$start = 0;
								}
								
								$eu = ($start -0);                
								$limit = 50;                                 // No of records to be shown per page.
								$this1 = $eu + $limit; 
								$bk = $eu - $limit; 
								$next = $eu + $limit; 
								
								
								/////////////// WE have to find out the number of records in our table. We will use this to break the pages///////
								$query2=" SELECT * FROM t_dailyReport WHERE cawangan='$cawangan' and month(date) = $month and year(date) = $tahun ORDER BY date";
								$result2=mysql_query($query2);
								echo mysql_error();
								$nume=mysql_num_rows($result2);

						
						$sql = "SELECT * FROM t_dailyReport WHERE cawangan='$cawangan' and month(date) = $month and year(date) = $tahun ORDER BY date LIMIT $eu, $limit";
						$result = mysql_query($sql) or die ('Data of search cannot be reach. ' . mysql_error());
						$i=1;
						
						while ($row = mysql_fetch_array($result))
						{	
								 
								$idDailyReport = $row["idDailyReport"];
								$date = $row ["date"];
								$sales = $row["sales"];
								$others = $row["others"];
								$total = $row["total"];
								$cashTransfer = $row["cashTransfer"];
								$cashBankIn = $row["cashBankIn"];
								$cawangan = $row["cawangan"];
								$oleh = $row["oleh"];
				?>
                   <? }
							  			$p_limit=50; // This should be more than $limit and set to a value for whick links to be breaked
			
										$p_f=$_GET['p_f'];								// To take care global variable if OFF
										if(!($p_f > 0)) {                         // This variable is set to zero for the first page
										$p_f = 0;
										}
										
										$p_fwd=$p_f+$p_limit;
										$p_bk=$p_f-$p_limit;
										//////////// End of variables for advance paging ///////////////
										/////////////// Start the buttom links with Prev and next link with page numbers /////////////////
										echo "<table align = 'center' width='50%'><tr><td  align='left' width='20%'>";
										if($p_f<>0){print "<a href='$page_name?start=$p_bk&p_f=$p_bk'><font fe='Verdana' size='2'>PREV $p_limit</font></a>"; }
										echo "</td><td  align='left' width='10%'>";
										//// if our variable $bk is equal to 0 or more then only we will display the link to move bk ////////
										if($bk >=0 and ($bk >=$p_f)) { 
										print "<a href='$page_name?start=$bk&p_f=$p_f'><font fe='Verdana' size='2'>PREV</font></a>"; 
										} 
										//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
										echo "</td><td align=center width='30%'>";
										
										for($i=$p_f;$i < $nume and $i<($p_f+$p_limit);$i=$i+$limit){
										if($i <> $eu){
										$i2=$i+$p_f;
										echo " <a href='$page_name?start=$i&p_f=$p_f'><font fe='Verdana' size='2'>$i</font></a> ";
										}
										else { echo "<font fe='Verdana' size='4' color=red>$i</font>";}        /// Current page is not displayed as link and given font color red
										
										}
										
										
										echo "</td><td  align='right' width='10%'>";
										///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
										if($this1 < $nume and $this1 <($p_f+$p_limit)) { 
										print "<a href='$page_name?start=$next&p_f=$p_f'><font fe='Verdana' size='2'>NEXT</font></a>";} 
										echo "</td><td align='right' width='20%'>";
										if($p_fwd < $nume){
										print "<a href='$page_name?start=$p_fwd&p_f=$p_fwd'><font fe='Verdana' size='2'>NEXT $p_limit</font></a>"; 
										}
										echo "</td></tr></table>";
										
                                ?><? $i++;}?>
			<tr><td></td></tr>
	</table>
    <td align="center" width="98"><div align="center"></div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<tr> 
                <td align="center">
    </tr>
</form>
</table>
</body>
</html>
