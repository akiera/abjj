<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idDailyReport =$_GET['idDailyReport'];
$query1= "SELECT * FROM t_dailyReport WHERE idDailyReport ='$idDailyReport'"; 
$result1 = mysql_query($query1) or die ('Data daily report cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idDailyReport");
$_SESSION['idDailyReport'] = $record1["idDailyReport"];

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
                <form action="?p=edit_daily_report" method="post" id="form1">
                  <table width="417" align="center" cellpadding="0" cellspacing="0" style="border:none">
                    <!--DWLayoutTable-->
                    <tr>
                      <td colspan="3" bgcolor="#990000"><div align="center" class="style1" style="height:30px; vertical-align:middle; ">View Daily Report</div></td>
                    </tr>
                    <tr>
                      <td width="117" height="25" bgcolor="#F2F0DC"><span class="style18">ID </span></td>
                  
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RD0<? echo $record1["idDailyReport"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Mini Mart</span></td>
                    
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["cawangan"]; ?>&nbsp; </span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Date</td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["date"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Sales</span></td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["sales"],2,".",","); ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><!--DWLayoutEmptyCell-->&nbsp;</td>
                     
                      <td bgcolor="#F2F0DC"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><strong>Cash Expenses</strong></td>
                     
                      <td bgcolor="#F2F0DC"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Purchase</td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["purchase"],2,".",","); ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Salary</span></td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["salary"],2,".",","); ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Others</td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["others"],2,".",","); ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><strong>Total</strong></td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">:<strong> RM
                        <? $total=$record1["purchase"]+$record1["salary"]+$record1["others"];			
			   				echo number_format($total,2, ".", ",");
						?>
                      </strong></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC"><!--DWLayoutEmptyCell-->&nbsp;</td>
                     
                      <td bgcolor="#F2F0DC"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    </tr>
                     <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC">Advance Claims</td>
                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["advance"],2,".",","); ?></span></td>
                    </tr>
                                        <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC"><strong>Cash Transfer</strong></td>
                     
                      <td bgcolor="#F2F0DC"><span class="style15">:<strong> RM
                        <? $cashTransfer=$record1["sales"]-$total;			
			   				echo number_format($cashTransfer,2, ".", ",");
						?>
                      </strong></span></td>
                    </tr>

                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC">Cash Bank In</td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["cashBankIn"],2,".",","); ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Prepared by</span></td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["oleh"]; ?></span></td>
                    </tr>
                    <tr bordercolor="#FFFFFF">
                      <td height="25" bgcolor="#F2F0DC">Time Key In</td>
                      
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["time"]; ?></span></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  <table align="center">
                    <tr>
                      <td width="80" height="30" align="center"><input type="hidden" name="idDailyReport" value="<? echo $record1["idDailyReport"]; ?>" />
                      <input type="image" name="productSubmit" value="Edit" onClick="return submit_product()" src="../images/edit.png"/></td>
                      <td width="80"><input type="hidden" name="idDailyReport" value="<? echo $record1["idDailyReport"]; ?>" />
                      <a href='delete_daily_report.php?idDailyReport=<? echo $record1["idDailyReport"]; ?>' onClick="return confirm_del()"><img src="../images/delete.png"></a></td>
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
