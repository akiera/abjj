
<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "1234");
define("SQL_DB", "abjjmana_dbabjj");

$conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)
		or die('Fail to connect the database. ' . mysql_error());
mysql_select_db(SQL_DB, $conn);

?>

