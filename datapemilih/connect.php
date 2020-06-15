<?php
$host = "127.0.0.1";
$user = "pcoh4447_pemilih";
$pass = "pemilihhebat";
$dbName = "pcoh4447_datapemilih";
mysql_connect($host, $user, $pass);
mysql_select_db($dbName)
or die ("Connect Failed !! : ".mysql_error());
?>