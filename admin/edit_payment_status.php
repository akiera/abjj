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
          <p><strong>PAYMENT STATUS LIST FOR</strong> <strong><?php echo $bulan1; ?>&nbsp;<? echo $tahun = $_POST['tahun']; ?></strong></p></TD>
		</tr>
		
		<tr><td align="right"></br><form name="searchitem" method="post" action="">
		</form>
						</br>
		</td></tr>
		</table>
		
		<table width="580" align="center" border="1">
		<tr>
		  <td align="center" colspan="5" bgcolor="#CCFFFF"><span class="style5">Payment Status List</span></td>
		</tr>
		</table>
		
		</br>
		<table width="620" align="center" border="1">
		<tr class="style7">
		  <td width="6%" align="center" bgcolor="#CC00FF"><strong>No.</strong></td>
			<td width="34%" align="center" bgcolor="#CC00FF"><strong>Supplier</strong></td>
			<td width="13%" align="center" bgcolor="#CC00FF"><strong>Date</strong></td>
		  <td width="22%" align="center" bgcolor="#CC00FF"><strong>No. Invoice</strong></td>
			<td width="13%" align="center" bgcolor="#CC00FF"><strong>Amaun</strong></td>
		  <td width="12%" align="center" bgcolor="#CC00FF"><strong>Status</strong></td>
		</tr>
		
		<?php
			if (isset($_POST['txtsearchkey']))
			{
				$txtsearchkey=$_POST['txtsearchkey'];
			
				$sql1 = "SELECT * FROM t_purchase WHERE idPurchase like '%$txtsearchkey%' || cawangan like '%$txtsearchkey%' || pembekal like '%$txtsearchkey%' || tarikh like '%$txtsearchkey%' || noInv like '%$txtsearchkey%' || amaun like '%$txtsearchkey%' || status like '%$txtsearchkey%' || oleh like '%$txtsearchkey%' ORDER BY pembekal"; 
				$rst1=mysql_query($sql1)or die ('Problem : ' . mysql_error());;
						
				$x=0;
			
				while($row=mysql_fetch_array($rst1))
				{
				$x++; 
				$idPurchase = $row["idPurchase"];
				$pembekal = $row ["pembekal"];
				$tarikh = $row["tarikh"];
				$noInv = $row["noInv"];
				$amaun = $row["amaun"];
				$status = $row["status"];
				
				?>
                              <tr bgcolor="#99FFFF" class="style9" onMouseOver="this.bgColor='#D3FCAB'" onMouseOut="this.bgColor='#99FFFF'">
                                <td><div align="center"><? echo $x; ?></div></td>
                                <td><div align="left"><? echo $row["pembekal"]; ?></div></td>
                                <td ><div align="center"><? echo $row["tarikh"]; ?></div></td>
								<td><div align="center"><? echo $row["noInv"]; ?></div></td>
                                <td><div align="center"><? echo $row["amaun"]; ?></div></td>
                                <td><div align="center"><? echo $row["status"]; ?></div></td>
                              </tr>
                              <? }?>
                              <?php
				if ($x<1)
				{
					echo "<script>alert('Zero result was found for your search!');";
					print "window.location='../admin/view_payment_status.php'";
					print "</script> ";
				}			
				}
				else
				{
						       	$page_name="item.php"; //  If you use this code with a different page ( or file ) name then change this 
				
								$start=$_GET['start'];								// To take care global variable if OFF
								if(!($start > 0)) {                         // This variable is set to zero for the first page
								$start = 0;
								}
								
								$eu = ($start -0);                
								$limit = 10;                                 // No of records to be shown per page.
								$this1 = $eu + $limit; 
								$bk = $eu - $limit; 
								$next = $eu + $limit; 
								
								
								/////////////// WE have to find out the number of records in our table. We will use this to break the pages///////
								$query2=" SELECT * FROM t_purchase WHERE cawangan='$cawangan' and month(tarikh) = $month and year(tarikh) = $tahun ORDER BY pembekal";
								$result2=mysql_query($query2);
								echo mysql_error();
								$nume=mysql_num_rows($result2);

						
						$sql = "SELECT * FROM t_purchase WHERE cawangan='$cawangan' and month(tarikh) = $month and year(tarikh) = $tahun ORDER BY pembekal LIMIT $eu, $limit";
						$result = mysql_query($sql) or die ('Data of search cannot be reach. ' . mysql_error());
						$x=0;
						
						while ($row = mysql_fetch_array($result))
						{	
								$x++; 
								$idPurchase = $row["idPurchase"];
								$pembekal = $row ["pembekal"];
								$tarikh = $row["tarikh"];
								$noInv = $row["noInv"];
								$amaun = $row["amaun"];
								$status = $row["status"];
				
				?>
                              <tr bgcolor="#99FFFF" class="style9" onMouseOver="this.bgColor='#D3FCAB'" onMouseOut="this.bgColor='#99FFFF'">
                                <td><div align="center"><? echo $x; ?></div></td>
                               <td><div align="left"><? echo $row["pembekal"]; ?></div></td>
                                <td ><div align="center"><? echo $row["tarikh"]; ?></div></td>
								<td><div align="center"><? echo $row["noInv"]; ?></div></td>
                                <td><div align="center"><? echo $row["amaun"]; ?></div></td>
                                <td><div align="center"><? echo $row["status"]; ?></div></td>
                              </tr>
                   <? }
							  			$p_limit=10; // This should be more than $limit and set to a value for whick links to be breaked
			
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
										
                               } ?>
			<tr><td></td></tr>
            
	</table>
    <td align="center" width="98"><div align="center">
		<input name="editstatus" type="button" value="Edit Status" align="center">
        </div></td>
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
