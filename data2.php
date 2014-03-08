
<?php
define("DB_HOST", "localhost");
define("DB_USER", "nrzcoll3_abjj123");
define("DB_PASS", "abjj12!@#");
define("SQL_DB", "nrzcoll3_dbabjj");

$conn = mysql_connect(DB_HOST,DB_USER,DB_PASS)
		or die('Fail to connect the database. ' . mysql_error());
mysql_select_db(SQL_DB, $conn);

?>

