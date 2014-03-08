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

.style22 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13PX; font-weight: bold;}
.style31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style35 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: normal; }
.style41 {font-size: 14px;
	font-weight: bold;
}
.style42 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
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
          <td width="118" rowspan="6"><img src="../images/logoABJJ.jpg" width="278" height="146"></td>
          <td width="616"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="1"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><span class="style41">ABJJ Techno Solution </span></td>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style42">1-12, Blok C, Jln Pulai Perdana 11/7,</span></td> 
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style42">Tmn Sri Pulai Perdana, </span></td> 
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style42">81110 Johor Bahru, Johor.</span></td> 
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="right" class="style7">Date:<span class="style7"><? echo $date ?></span></td>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <TR> 
          <TD colspan="3"><div align="center"><strong>________________________________________________________________________________________</strong></div></TD>
          <td>&nbsp;</td>
        </TR>
      </table>
		
		
      <table align="center" width="730">
        <!--DWLayoutTable-->
        <TR class="style22"> 
          <td width="732" align="center"><p><strong><? echo $cawangan = $_POST['cawangan']; ?></strong></p>
          <p>SUMMARY OF  PURCHASE REPORT FOR <strong><?php echo $bulan1; ?></strong><strong>&nbsp;<? echo $tahun = $_POST['tahun']; ?></strong></p></TD>
        </TR>
      </table>
</td></tr>

<tr>
<td>
		<table align="center" width="694" cellpadding="2" cellspacing="2">
        <!--DWLayoutTable-->
		<tr>
		  <td colspan="9"><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
        <tr class="style31"> 
          <td width="21" align="center" bgcolor="#00CCCC">No</td>
          <td width="293" align="center" bgcolor="#00CCCC">Supplier</td>
          <td width="76" align="center" bgcolor="#00CCCC">Date</td>
          <td width="116" align="center" bgcolor="#00CCCC">No. Invoice</td>
          <td width="70" align="center" bgcolor="#00CCCC">Amount (RM)</td>
          <td width="78" align="center" bgcolor="#00CCCC">Status</td>
        </tr>
		<tr>
		  <td colspan="9" height="1"><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
        
        <?php 
		        
		$sql = "SELECT * FROM t_pembekal ORDER BY idPembekal";
		$result = mysql_query($sql) or die ('Data supplier cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
		
        <tr valign="top" class="style8"> 
          <td align="center" bgcolor="#CCFFFF"><? echo $i ?></td>
          <td align="left" bgcolor="#CCFFFF"><? echo $record["namaPembekal"]; ?></td>      
          <? $i++; ?>
           
          <td align="center" bgcolor="#CCFFFF"><?php
		$namaPembekal=$record["namaPembekal"];
		$sql2 = "SELECT * FROM t_purchase WHERE pembekal='$namaPembekal' and cawangan='$cawangan' and month(tarikh) = $month and year(tarikh) = $tahun";
		$result2 = mysql_query($sql2) or die ('Data product cannot be reach. ' . mysql_error());
		while ($record2 = mysql_fetch_array($result2))
		{	
	 	?>
           <div><? echo $record2["tarikh"]; ?>&nbsp;<bR>
              <? }?>
            </div>
		  <td align="center" bgcolor="#CCFFFF"><?php
		$namaPembekal=$record["namaPembekal"];
		$sql2 = "SELECT * FROM t_purchase WHERE pembekal='$namaPembekal' and cawangan='$cawangan' and month(tarikh) = $month and year(tarikh) = $tahun";
		$result2 = mysql_query($sql2) or die ('Data product cannot be reach. ' . mysql_error());
		while ($record2 = mysql_fetch_array($result2))
		{	
	 	?>
		    <div>
		    <div><? echo $record2["noInv"]; ?><bR>
                <? }?>
            </div>
	      <div align="left"><bR>
		  <td align="right" bgcolor="#CCFFFF"><?php
		  
		$namaPembekal=$record["namaPembekal"];
		$sql2 = "SELECT * FROM t_purchase WHERE pembekal='$namaPembekal' and cawangan='$cawangan' and month(tarikh) = $month and year(tarikh) = $tahun";
		$result2 = mysql_query($sql2) or die ('Data product cannot be reach. ' . mysql_error());
		$subtotal = 0;
		//$totalall += $subtotal;
		while ($record2 = mysql_fetch_array($result2))
		
		{	
	
	 	?>
		    <div>
            
	          <div align="right"><? echo number_format($record2["amaun"],2, ".", ",");   ?><bR >
	            <? $subtotal+=$record2["amaun"];
					$a+=$record2["amaun"];
				}?>
	          </div>
              <td align="center" bgcolor="#CCFFFF"><?php
		$namaPembekal=$record["namaPembekal"];
		$sql2 = "SELECT * FROM t_purchase WHERE pembekal='$namaPembekal' and cawangan='$cawangan' and month(tarikh) = $month and year(tarikh) = $tahun";
		$result2 = mysql_query($sql2) or die ('Data product cannot be reach. ' . mysql_error());
		while ($record2 = mysql_fetch_array($result2))
		{	
	 	?>
		    <div>
		    <div><? echo $record2["status"]; ?><bR>
                <? }?>
            </div>
	        </div>
            
          <div align="right"></div>		  </tr>
        <tr height="0.1">
          <td class="style8"></td>
          <td class="style8"></td>

          <td align="left" class="style8"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="center" class="style8"><strong>SUBTOTAL</strong></td>
          <td align="center" bgcolor="#9999FF" class="style8"><div align="right"><strong>  
          <?  echo number_format(    $subtotal, 2, ".", ",");?></strong></div></td> 
          <td align="left" class="style8"><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          
				<? } ?>
                
                <tr height="0.1">
          <td class="style8"></td>
          <td class="style8"></td>
          <td align="left" class="style8"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="left" class="style8"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="left" class="style8"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF" class="style8"><div align="right">
            
          </div></td> 
          </tr>
                <tr class="style8">
<td></td>
<td></td>
<td align="left"><!--DWLayoutEmptyCell-->&nbsp;</td>
<td align="center"><strong>TOTAL</strong></td>
<td align="center" bgcolor="#9933FF"><div align="right"><strong>
  <? 
  		
		 $totalall += $a;
				
			   echo number_format($totalall,2, ".", ","); ?>
</strong></div></td>
<td align="left"><!--DWLayoutEmptyCell-->&nbsp;</td>
</tr>
      </table>
        
      <p align="left" class="style8">&nbsp;</p>
      <p align="left" class="style35">&nbsp;</p>
      <p align="left" class="style8">Prepared By: <? echo $_SESSION['staff_name']; ?></p>
          <center>
	  <div><input type="button" width="40" height="40" border="0" value="Print" onClick="window.print()"></div>
       </center>
        <p align="left" class="style35">&nbsp;</p>
        <p>&nbsp;</p>
</td>
</tr>
</table>


</body>
</html>
