<?php
$conn = mysql_pconnect('localhost','root','') or die('could not connect with mysql'.mysql_error());
mysql_select_db("piformula_main",$conn) or die('could not select the database'.mysql_error());
?>