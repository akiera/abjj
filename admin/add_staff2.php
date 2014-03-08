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
<head>

<title>ABJJ Techno Solution</title>
<link rel="stylesheet" type="text/css" href="inc/view.css" media="all">
<script type="text/javascript" src="inc/view.js"></script>

<script language="JavaScript" type="text/JavaScript">
function topage() { 
		window.location="staff_list.php";
	}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
	document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

</script>
</head>

<body id="main_body" >
	
	<img id="top" src="inc/top.png" alt="">
	<div id="form_container">
	
		
<form id="form1" class="appnitro"  method="post" action="?p=process_staff">
					<div class="form_description">
			<h2>Tambah Pengguna Baru</h2>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Nama </label>
		<div>
		  <input name="staffname" onFocus="1" class="element text medium" type="text" maxlength="40" size="40"value="<? echo $_GET['staffname'];?>"/>
       </div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">No K/P </label>
		<div>
			<input name="staffIC" class="element text small" type="text" maxlength="12" size="15" value="<? echo $_GET['staffIC'];?>"/>
		</div> 
		</li>		<li id="li_12" >
		<label class="description" for="element_12">Jantina </label>
		<div>
		<select class="element select short" id="sex" name="staffsex"> 
			<option value="pilih">--sila pilih--</option>
<option value="Male"  <? if($_GET['staffsex']=="Male"){?>selected<? }?>>Lelaki</option>
<option value="Female" <? if($_GET['staffsex']=="Female"){?>selected<? }?>>Perempuan</option>
		</select>
		</div> 
		</li>		<li id="li_11" >
		<label class="description" for="element_11">Alamat </label>
		
		<div>
			<input name="staffaddress" class="element text large" value="<? echo $_GET['staffaddress'];?>" type="text">
            <label for="element_11_1">Alamat Jalan</label>
		</div>
	
		<div></div>
	
		<div class="left">
		  <input name="stafftown" type="text" class="element text medium" value="<? echo $_GET['stafftown'];?>" size="40" />
		  <label for="element_11_3">Bandar</label>
		</div>
	
		<div class="right">
			<select name="staffState" class="element select short" id="State">
              <option value="pilih" >--sila pilih--</option>
              <option value="Perlis" <? if($_GET['staffState']=="Perlis"){?>selected<? }?>>Perlis</option>
              <option value="Kedah" <? if($_GET['staffState']=="Kedah"){?>selected<? }?>>Kedah</option>
              <option value="Penang" <? if($_GET['staffState']=="Penang"){?>selected<? }?>>Pulau Pinang</option>
              <option value="Perak" <? if($_GET['staffState']=="Perak"){?>selected<? }?>>Perak</option>
              <option value="Pahang" <? if($_GET['staffState']=="Pahang"){?>selected<? }?>>Pahang</option>
              <option value="Selangor" <? if($_GET['staffState']=="Selangor"){?>selected<? }?>>Selangor</option>
              <option value="Kelantan" <? if($_GET['staffState']=="Kelantan"){?>selected<? }?>>Kelantan</option>
              <option value="Terengganu" <? if($_GET['staffState']=="Terengganu"){?>selected<? }?>>Terengganu</option>
              <option value="Wilayah Persekutuan" <? if($_GET['staffState']=="Wilayah Persekutuan"){?>selected<? }?>>Kuala Lumpur</option>
              <option value="Negeri Sembilan" <? if($_GET['staffState']=="Negeri Sembilan"){?>selected<? }?>>Negeri Sembilan</option>
              <option value="Melaka" <? if($_GET['staffState']=="Melaka"){?>selected<? }?>>Melaka</option>
              <option value="Johor"  <? if($_GET['staffState']=="Johor"){?>selected<? }?>>Johor</option>
              <option value="Sarawak" <? if($_GET['staffState']=="Sarawak"){?>selected<? }?>>Sarawak</option>
              <option value="Sabah" <? if($_GET['staffState']=="Sabah"){?>selected<? }?>>Sabah</option>
            </select>
			<label for="element_11_4">Negeri</label>
		</div>
	
		<div class="left">
			<input name="staffposcode" type="text" class="element text medium" value="<? echo $_GET['staffpostcode'];?>" size="20" maxlength="5">
			<label for="element_11_5">Poskod</label>
		</div>
		</li>		
		<li id="li_6" >
		<label class="description" for="element_6">No. Telefon </label>
		<div>
		  <input name="staffphone" type="text" class="element text small" value="<? echo $_GET['staffphone'];?>" size="15" maxlength="11"/>
		</div> 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Emel </label>
		<div>
		  <input name="staffemail" type="text" class="element text medium" value="<? echo $_GET['staffemail'];?>" size="30" maxlength="30"/>
		</div> 
		</li>		<li id="li_14" >
		<label class="description" for="element_14">Kategori </label>
		<div>
		<select id="position" name="staffcate"> 
			<option value="pilih">--sila pilih--</option>
<option value="Admin" <? if($_GET['staffcate']=="Admin"){?>selected<? }?>>Admin</option>
<option value="Staff" <? if($_GET['staffcate']=="Staff"){?>selected<? }?>>Staf</option>
<option value="Customer" <? if($_GET['staffcate']=="Customer"){?>selected<? }?>>Pelanggan</option>
		</select>
		</div> 
		</li>		<li id="li_8" >
		<label class="description" for="element_8">Kata Pengguna </label>
		<div>
		  <input name="Username" type="text" class="element text small" value="<? echo $_GET['Username'];?>" size="20" maxlength="15"/>
		</div> 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">Kata Laluan </label>
		<div>
			<input name="Password" type="password" class="element text small" value="<? echo $_GET['Password'];?>" size="20" maxlength="10"/>
		</div> 
		</li>		<li id="li_10" >
		<label class="description" for="element_10">Ulang Kata Laluan </label><div>
			<input name="Password2" type="password" class="element text small" value="<? echo $_GET['Password'];?>" size="20" maxlength="10"/>
		</div> 
		</li>
			
			  <li class="buttons">
			    <input type="hidden" name="form_id" value="193057" />
			    
				<input type="image" name="Submit" value="Hantar" onClick="return verify_staff()" src="../images/hantar.png" />
				<label>
			    <input type="image" name="Reset" value="Semula" src="../images/Semula.png">
				</label>
			    <label>
			    <input type="image" name="button" value="Kembali" onClick="topage()" src="../images/kembali.png"/>
			    </label>
			  </li>
	  </ul>
	  </form>	
		<div id="footer"></div>
</div>
	<img id="bottom" src="inc/bottom.png" alt="">
    </div>
	</body>
</html>