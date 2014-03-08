<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
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

?>
<html>
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="../common/js/universal.js"></script>
<script type="text/javascript" src="../common/js/calendar.js"></script>
<script type="text/javascript" src="../common/js/calendarsetup.js"></script>
<script type="text/javascript" src="../common/js/calendar_en.js"></script>

<script language="JavaScript">
function check_po()
{
	if(document.form1.qty_out.value=="")
	{
		alert(" Please fill in quantity sold. ");
		document.form1.qty_out.focus();
		return false;
	}
	else
   	{
   			var qty = form1.qty_out.value.match(/\b([0-9]{1,})\b/gi);
			if (!qty)
			{
				alert('Invalid Quantity!');
				document.form1.qty_out.focus();
				return false;
			}
  	}
	
	if(document.form1.txtsolddate.value=="")
	{
		alert(" Please choose the sold date. ");
		document.form1.txtsolddate.focus();
		return false;
	}
	
}
</script>

	<style type="text/css"> 
@import url("../common/css/calendar_style.css"); 
    .style1 {color: #FFFFFF}
    </style>
	<title>ABJJ Techno Solution</title>

    </style>
</head>

<body>

 
                <h2 class="style12">&nbsp;</h2>
              
                <table width="50%" border="0" align="center">
                </table>
                <table width="445" height="" border="0" align="center" cellpadding="0" cellspacing="0" class="style7">
                  <!--DWLayoutTable-->
                  <form method="post" action="" name="">
                    <tr class="style25">
                      <td height="50" colspan="4" align="center" bgcolor="#330000"><span class="style27 style1"><strong>Sila Pilih Stok Keluar.</strong></span></td>
                    </tr>
                    <tr height="30">
                      <td width="77"><span class="style24"></span></td>
                      <td width="117"><span class="style31">Kategori Stok </span></td>
                      <td width="8"><span class="style31">:</span></td>
                      <td width="243"><span class="style31">&nbsp;
                        <select name="category" id="category" class="style7" onChange="submit()">
                          <option value="" selected="selected">--Sila Pilih--</option>
                          <option value="Makanan">Makanan</option>
                              <option value="Minuman">Minuman</option>
                              <option value="Alat Tulis">Alat Tulis</option>
                              <option value="Bateri">Bateri</option>
                              <option value="Ubat">Ubat</option>
                      </select>
                      </span></td>
                    </tr>
                  </form>
                  <? $category = $_POST['category'];
	if($category==''){ $category = $_GET['category'];}
?>
                  <?
if ($category!='')
{?>
                  <form action="?p=productOut2" method="post" id="form1">
                    <input name="category2" type="hidden" value="<? echo $category ?>" />
                    <?
	$query_search = "SELECT * FROM t_product where category = '".$category."' ";
	$search = mysql_query($query_search) or die(mysql_error());
	$row_search = mysql_fetch_array($search);
	
	$idpro=$_GET['id_product'];
	$qtypro=$_GET['qtypro'];
	$datesold=$_GET['datesold'];
?>
                    <tr height="30">
                      <td><span class="style24"></span></td>
                      <td><span class="style31">Nama Stok</span></td>
                      <td><span class="style31">:</span></td>
                      <td><span class="style31">&nbsp;
                        <select name="id_product">
                          <?php do { ?>
                          <option value="<?php echo $row_search['id_product']; ?>" <? if($idpro==$row_search['id_product']){?>selected<? }?>><?php echo $row_search['productName']; ?></option>
                          <?php } while ($row_search = mysql_fetch_assoc($search)); ?>
                      </select>
                      </span></td>
                    </tr>
                    <tr>
                      <td><span class="style24"></span></td>
                      <td><span class="style31">Kuantiti Keluar</span></td>
                      <td><span class="style31">:</span></td>
                      <td><span class="style31">&nbsp;
                        <input name="qty_out" type="text" size="5" value="<? echo $qtypro; ?>" />
                      </span></td>
                    </tr>
                    <tr>
                      <td><span class="style24"></span></td>
                      <td><span class="style31">Tarikh Keluar</span></td>
                      <td><span class="style31">:</span></td>
                      <td><span class="style31">&nbsp;
                        <input type="text" id="txtsolddate" name="solddate" maxlength="30"
			value="<?php echo $datesold; ?>" size="15">
			<button type="submit" id="calendarbutton"><img src="../images/calendar.gif" width="16" height="16" border="0"></button>
				<script type="text/javascript">
				Calendar.setup({
				inputField    : "txtsolddate",
				button        : "calendarbutton",
				align         : "Tr"
				});
				</script>
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td><span class="style24"></span></td>
                      <td align="center" colspan="3"><span class="style24"><br />
                        <input name="submit" type="image" onClick="return check_po()" value="Submit" src="../images/hantar.png"/>
                        <br />
                      </span></td>
                    </tr>
                  </form>
                  <? } ?>
                  <?

if	 (0)
{ ?>
                  <form method="post" action="" name="">
                    <? $category = $_POST['category'];
?>
                    <input name="category2" type="hidden" value="<? echo $category ?>" />
                    <?
	$query_search = "SELECT * FROM t_product where category = '".$category."' ";
	$search = mysql_query($query_search) or die(mysql_error());
	$row_search = mysql_fetch_array($search);
?>
                    <tr height="30">
                      <td><span class="style24"></span></td>
                      <td><span class="style31">Nama Stok</span></td>
                      <td><span class="style31">:</span></td>
                      <td><span class="style31">&nbsp;
                        <select name="id_product" disabled="disabled">
                          <?php do { ?>
                          <option value="<?php echo $row_search['id_product']; ?>"><?php echo $row_search['productName']; ?></option>
                          <?php } while ($row_search = mysql_fetch_assoc($search)); ?>
                      </select>
                      </span></td>
                    </tr>
                    <tr>
                      <td><span class="style24"></span></td>
                      <td><span class="style31">Kuantiti Keluar</span></td>
                      <td><span class="style31">:</span></td>
                      <td><span class="style31">&nbsp;
                        <input name="qty_out" type="text" size="5" value="<? echo $qty_out; ?>" disabled="disabled" />
                      </span></td>
                    </tr>
                    <tr>
                      <td><span class="style24"></span></td>
                      <td><span class="style31">Tarikh Keluar</span></td>
                      <td><span class="style31">:</span></td>
                      <td><span class="style31">&nbsp;
                        <input type="text" id="txtsolddate" name="solddate" maxlength="30"
			value="<?php if(txtsolddate == ""){echo $record["solddate"];}?>" size="15" disabled>
			<button type="submit" id="calendarbutton" disabled><img src="../images/calendar.gif" width="16" height="16" border="0"></button>
				<script type="text/javascript">
				Calendar.setup({
				inputField    : "txtsolddate",
				button        : "calendarbutton",
				align         : "Tr"
				});
				</script>
                      &nbsp;</span></td>
                    </tr>
                    <tr>
                      <td><span class="style24"></span></td>
                      <td align="center" colspan="3"><span class="style24"><br />
                        <input name="submit" type="image" disabled="disabled" onClick="return checkpo()" value="Submit" src="../images/hantar.png" />
                        <br />
                      </span></td>
                    </tr>
                  </form>
                  <? } ?>
                </table>
               </div>
    </div>
  </div>

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
</body>
</html>
