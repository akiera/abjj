<?php
	session_start();
	session_destroy();
	 $to_page = "../index.php"
?>
<head>
	<title>E Mart Solution</title>
    <style type="text/css">
<!--
.style2 {font-weight: bold}
-->
    </style>
</head>
<body>
  
                <p align="center">&nbsp;</p>
                <p align="center">&nbsp;</p>
                <p align="center"><strong>Thank You for Using This System</strong></p>
                <p align="center"><strong>Loading... </strong></p>
<p align="center" class="style2"><img src="../images/loading.gif"></p>
<div class="clear"> 
       
<?php
echo "<meta http-equiv = 'Refresh' content = '2; url = $to_page'>\n";
?>	
</body>
</html>
