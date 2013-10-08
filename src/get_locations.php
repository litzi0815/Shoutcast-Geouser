<?php
if($_SERVER['REMOTE_ADDR']!='') die('This script may only be run in the console');

include('functions.php');

$sql='SELECT addr FROM ips WHERE location = ""';
$sql_q=mysql_query($sql);
while($row=mysql_fetch_array($sql_q))
{
	$buffer=getCity($row['addr']);
	if($buffer=='') $buffer='Unbekannt';
	$sql='UPDATE ips SET location="'.$buffer.'" WHERE addr="'.$row['addr'].'"';
	mysql_query($sql);
}
?>