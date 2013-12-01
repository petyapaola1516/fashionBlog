<?php


$hostname = 'localhost';


$username = 'root';


$password = '';


$link = @mysql_connect($hostname, $username, $password);

$db = mysql_select_db('fashionblog', $link);

?>

