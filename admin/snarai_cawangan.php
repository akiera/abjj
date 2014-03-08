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
$_SESSION['user_ic']=$record2["user_ic"];


$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));


?><head>
<title>ABJJ MANAGEMENT</title>
</head>
	
<div id="content">
<form action="?p=add_cawangan" method="post" id="form1">

<h3 align="center">MINIMART LIST</h3>
<table class="display" id="data_tbl_tools">
        <thead>
          <tr>
            <th width="47"> No. </th>
            <th width="130"> ID</th>
            <th width="297">Mini Mart</th>
            <th width="103"> Detail </th>
          </tr>
        </thead>
         <?php
		$sql = "SELECT * FROM `t_cawangan` ORDER BY `id`";
		$result = mysql_query($sql) or die ('Data t_cawangan cannot be reach. ' . mysql_error());
		$i=1;
		while ($record = mysql_fetch_array($result))
		{	
		 	$id =$record["id"]; ?>
	 		<tr class="">
	 		<td align="center"><? echo $i; ?></td>
	 		<td align="center">SP0<? echo $record["idCawangan"]; ?></td>
			<td><? echo $record["namaCawangan"]; ?></td>
			<td align="center"><a href='?p=viewcawangan&idCawangan=<? echo $record["idCawangan"]; ?>' class="style27">Detail</a></td>
	 		</tr><?
		 	$i++;
		}
?>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th> No. </th>
            <th> ID</th>
            <th>Mini Mart</th>
            <th>Detail</th>
          </tr>
          
          
</table>
        <div class="form_input">
          <div align="center">
            <button type="submit" class="btn_small btn_orange"><span>Add New Minimart</span></button></a>
          </div>
        </div>
      </body>