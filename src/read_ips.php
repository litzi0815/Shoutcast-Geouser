<?php
if($_SERVER['REMOTE_ADDR']!='') die('This script may only be run in the console');

// Specify your servers and admin-passwords here
$servers=array('127.0.0.1','10.18.98.10','10.18.98.12');
$passwords=array('xxx1','xxx2','xxx3');

// Don't change anything below this line

include('functions.php');

for($i=0;$i<count($servers);$i++)
{
	readAndSaveIPs($servers[$i],$passwords[$i]);
}
?>