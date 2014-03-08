<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idPayment =$_GET['idPayment'];
$query1= "SELECT * FROM t_payment WHERE idPayment ='$idPayment'"; 
$result1 = mysql_query($query1) or die ('Data payment cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idPayment");
$_SESSION['idPayment'] = $record1["idPayment"];

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
                <form action="?p=edit_payment" method="post" id="form1">
                  <table width="417" align="center" cellpadding="0" cellspacing="0" style="border:none">
                    <!--DWLayoutTable-->
                    <tr>
                      <td colspan="3" bgcolor="#990000"><div align="center" class="style1" style="height:30px; vertical-align:middle; ">View Payment</div></td>
                    </tr>
                    <tr>
                      <td width="117" height="25" bgcolor="#F2F0DC"><span class="style18">ID Payment</span></td>
                  
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: PY0<? echo $record1["idPayment"]; ?></span></td>
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
                      <td height="25" bgcolor="#F2F0DC">Date</td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["tarikh"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Chq No.</td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["chqNo"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Amount</td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["amaunt"],2,".",","); ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">CN</td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo $record1["cn"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bordercolor="#FFFFFF" bgcolor="#F2F0DC">time</td>
                      <td bordercolor="#FFFFFF" bgcolor="#F2F0DC"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><strong>Amount Due</strong></td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">:<strong> RM
                            <? $due=$record1["amaunt"]-$record1["cn"];			
			   				echo number_format($due,2, ".", ",");
						?>
                      </strong></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Prepared by</span></td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["oleh"]; ?></span></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table align="center">
                    <tr>
                      <td width="80" height="30" align="center"><input type="hidden" name="idPayment" value="<? echo $record1["idPayment"]; ?>" />
                      <a href='?p=edit_payment&idPayment=<? echo base64_encode($record1["idPayment"]); ?>'> <img src="../images/edit.png" alt="edit"/></a></td>
                      <td width="80"><input type="hidden" name="idPayment" value="<? echo $record1["idPayment"]; ?>" />
                      <a href='../admin/delete_payment.php?idPayment=<? echo $record1["idPayment"]; ?>' onClick="return confirm_del()"><img src="../images/delete.png"></a></td>
                       <td width="80"><input type="hidden" name="idPayment" value="" />
                      <a href="?p=new_payment" target="_self"><img src="../images/add_new.png"></a></td>
                    </tr>
                  </table>
                  <table width="184" height="30" align="center" class="style6">
                   
                  </table>
    </form>
                <table width="50%" border="0" align="center">
                </table>
                <p class="style13">&nbsp;</p>
                </div>
      </div>
</body>
</html>
