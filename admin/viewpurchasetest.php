<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idPurchase =$_GET['idPurchase'];
$query1= "SELECT * FROM t_purchase WHERE idPurchase ='$idPurchase'"; 
$result1 = mysql_query($query1) or die ('Data purchase cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idPurchase");
$_SESSION['idPurchase'] = $record1["idPurchase"];

$query2= "SELECT * FROM logins WHERE user_ic='$IC'"; 
$result2 = mysql_query($query2) or die ('Data login cannot be reached.' . mysql_error());
$record2 = mysql_fetch_array($result2);

$nama=$_SESSION['username'];
$date = date("d/m/Y" ,time()+(3600*8));
$time = date("H:i:s" ,time()+(3600*8));

?>
	<title>ABJJ Techno Solution</title>
    <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
    </style>
    <body>

  
                <h2 class="style12">&nbsp;</h2>
                <form action="?p=edit_purchase" method="post" id="form1">
                  <table width="417" align="center" cellpadding="0" cellspacing="0" style="border:none">
                    <!--DWLayoutTable-->
                    <tr>
                      <td colspan="3" bgcolor="#990000"><div align="center" class="style1" style="height:30px; vertical-align:middle; ">View Purchase</div></td>
                    </tr>
                    <tr>
                      <td width="117" height="25" bgcolor="#F2F0DC"><span class="style18">ID Purchase</span></td>
                  
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: PD0<? echo $record1["idPurchase"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Mini Mart</span></td>
                    
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["cawangan"]; ?>&nbsp; </span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Supplier</span></td>
                    
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["pembekal"]; ?>&nbsp; </span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">No. Invoice</td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["noInv"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Date</td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["tarikh"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Prepared by</span></td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["oleh"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Amount</td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["amaun"],2,".",","); ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Status</span></td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["status"]; ?></span></td>
                    </tr>
                     <tr>
                      <td height="25" bgcolor="#F2F0DC">Time Key in</td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["time"]; ?></span></td>
                    </tr>
                     <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Date Key In</span></td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["date2"]; ?></span></td>
                    </tr>
                  </table>
                  
                  
                  <table width="50%" border="0" align="center">
                    <tr>
                      <td height="50" valign="bottom" align="center" colspan="3"><input type="hidden" name="idPurchase" value="<? echo $record1["idPurchase"]; ?>" />
                          <a href='?p=edit_purchase&idPurchase=<? echo base64_encode($record1["idPurchase"]); ?>'> <img src="../images/edit.png" alt="edit"/></a>
                          <input type="hidden" name="idPurchase2" value="<? echo $record1["idPurchase"]; ?>" />
                        <a href='delete_purchase.php?idPurchase=<? echo $record1["idPurchase"]; ?>' onClick="return confirm_del()"><img src="../images/delete.png" alt="delete" border="0" /></a></td>
                    </tr>
                  </table>
                  <table width="184" height="30" align="center" class="style6">
                   
                  </table>
    </form>
                <table align="center">
                    <tr>
           </tr>
                  </table>
    <p class="style13">&nbsp;</p>
                </div>
      </div>
</body>
</html>
