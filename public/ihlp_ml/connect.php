<?php
// mysql_connect("localhost", "root", "") or die(mysql_error()) ; 
// mysql_select_db("ihlp_ml") or die(mysql_error()) ; 

$hostname = 'localhost';
$username = 'root';
$password = '';

$dbh1 = mysql_connect($hostname, $username, $password); 
$dbh2 = mysql_connect($hostname, $username, $password, true); 

mysql_select_db('ihlp_ml_dev', $dbh1);
mysql_select_db('ihlp_ml', $dbh2);

?>