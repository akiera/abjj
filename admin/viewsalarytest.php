<?php
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}
include '../connection/data2.php';

$idSalary =$_GET['idSalary'];
$query1= "SELECT * FROM t_salary WHERE idSalary ='$idSalary'"; 
$result1 = mysql_query($query1) or die ('Data Salary cannot be reached.' . mysql_error());
$record1= mysql_fetch_array($result1);
session_register("idSalary");
$_SESSION['idSalary'] = $record1["idSalary"];

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
                <form action="?p=edit_salary" method="post" id="form1">
                  <table width="417" align="center" cellpadding="0" cellspacing="0" style="border:none">
                    <!--DWLayoutTable-->
                    <tr>
                      <td colspan="3" bgcolor="#990000"><div align="center" class="style1" style="height:30px; vertical-align:middle; ">View Salary</div></td>
                    </tr>
                    <tr>
                      <td width="117" height="25" bgcolor="#F2F0DC"><span class="style18">ID Salary</span></td>
                  
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: SR0<? echo $record1["idSalary"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Mini Mart</span></td>
                    
                      <td bgcolor="#F2F0DC"><span class="style15">: <? echo $record1["cawangan"]; ?>&nbsp; </span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Staff Name</span></td>                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["name"]; ?></span></td>
                    </tr>                    
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Salary</td>                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["salary"],2,".",","); ?></span></td>
                    </tr>                   
                    <tr>
                      <td height="25" bgcolor="#F2F0DC">Advance</td>                     
                      <td width="258" bgcolor="#F2F0DC"><span class="style15">: RM <? echo number_format($record1["advance"],2,".",","); ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Month</span></td>                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["month"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Year</span></td>                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["year"]; ?></span></td>
                    </tr>
                    <tr>
                      <td height="25" bgcolor="#F2F0DC"><span class="style18">Prepared by</span></td>                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["oleh"]; ?></span></td>
                    </tr>
                     <tr>
                      <td height="25" bgcolor="#F2F0DC">Time Key in</td>                     
                      <td bgcolor="#F2F0DC"><span class="style15">:  <? echo $record1["time"]; ?></span></td>
                    </tr>
                  </table>
                  
                  
                  <table width="50%" border="0" align="center">
                    <tr>
                      <td height="50" valign="bottom" align="center" colspan="3"><input type="hidden" name="idSalary" value="<? echo $record1["idSalary"]; ?>" />
                          <a href='?p=edit_salary&idSalary=<? echo base64_encode($record1["idSalary"]); ?>'> <img src="../images/edit.png" alt="edit"/></a>
                          <input type="hidden" name="idSalary" value="<? echo $record1["idSalary"]; ?>" />
                        <a href='delete_salary.php?idSalary=<? echo $record1["idSalary"]; ?>' onClick="return confirm_del()"><img src="../images/delete.png" alt="delete" border="0" /></a></td>
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
