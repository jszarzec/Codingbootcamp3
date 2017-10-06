<?php
$host = "localhost";
$userName = "mhensonf_wrt";
$password = "password410";
$database = "mhensonf_gameSite";

$con = mysql_connect($host, $userName, $password, $database);

if ($con == false)
	echo "<p>Error connecting to " . $database . "</p>";

?>
