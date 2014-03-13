<?php 

include '../connection/data2.php';


$id_product=$_POST['idTopup'];

$query20= "SELECT * FROM test WHERE idTopup ='$idTopup'"; 
$result20 = mysql_query($query20) or die ('Data Topup transfer cannot be reached.' . mysql_error());
$record20= mysql_fetch_array($result20);
$_SESSION['idTopup'] = $record20["idTopup"];
$date = date('d/m/Y h:i:s a', time());
$butir = 'TOPUP TRANSFER';

?>

<table class="display" id="data_tbl_tools">
      <thead>
        <tr>
          <th width="47"> No. </th>
          <th width="271"> Particulars</th>
          <th width="139"> Date </th>
          <th width="147"> Amount In</th>
          <th width="93"> Amount Out</th>
          <th width="105"> Balance </th>
          <th width="74"> Detail</th>
        </tr>
      </thead>
       <?php 
		        
		$sql = "SELECT butir, cawangan,date2, masuk, keluar FROM test ORDER BY date2 DESC";
		$result = mysql_query($sql) or die ('Data Cash Book cannot be reach. ' . mysql_error());
		
		$i=1;
		
		while ($record = mysql_fetch_array($result))
		{	
	 	?>
      <tr class="">
        <td align="center"><? echo $i; ?></td>
        <td align="left"><? echo $record["butir"];?></td>
        <td align="center"><? echo $record["date2"];?></td>
        <td align="center"><? echo $record["masuk"]; $totalMasuk+=$record["masuk"]; ?></td>
        <td align="left"><div align="right"><? echo $record["keluar"]; $totalAmaun+=$record["keluar"];  $bal+=$record["masuk"]-$record["keluar"];?></div></td>
        <td align="center"><strong><? echo number_format($bal,2, ".", ",");?></strong></td>
        <td bgcolor="#99FFFF"><div align="center"><a href='' class="style27">Detail</a></div></td>
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
          <th><strong><? echo number_format($totalMasuk,2, ".", ",");?></strong></th>
          <th align="right"><strong><? echo number_format($totalAmaun,2, ".", ","); $baki=$totalMasuk-$totalAmaun;?></strong></th>
          <th><strong><? echo number_format($baki,2, ".", ",");?></strong></th>
          <th></th>
        </tr>
    </table>
    <?php
	$sql = "insert into t_topup (cawangan, butir, tarikh, masuk, keluar, noslip, masa, oleh, date2) SELECT cawangan, 'Balance Forward', tarikh, masuk, keluar, noslip, masa, oleh, now() FROM 

(
select * from t_topup order by idtopup desc
) as temp_table

group by cawangan

order by idtopup desc";
		$result = mysql_query($sql) or die ('Data Cash Book cannot be reach. ' . mysql_error());
		
	$sql2 = "insert into t_cashbook (cawangan, butir, tarikh, masuk, keluar, noslip, masa, oleh, date2) SELECT cawangan, 'Balance Forward', tarikh, masuk, keluar, noslip, masa, oleh, now() FROM 

(
select * from t_cashbook order by idcash desc
) as temp_table

group by cawangan

order by idtopup desc";
		$result = mysql_query($sql) or die ('Data Cash Book cannot be reach. ' . mysql_error());
		?>