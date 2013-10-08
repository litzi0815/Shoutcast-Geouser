<?php

include('mysql.php');

function getIPs($host,$pw)
{
	$raw=file_get_contents('http://'.$host.':8000/admin.cgi?sid=1&pass='.$pw);
	$ip_list=array();
	$buffer1=explode('Listener List',$raw);
	
	$buffer2=explode('</table>',$buffer1[1]);
	
	$buffer3=explode('admin.cgi?sid=1&mode=ripdst&ripdst=',$buffer2[0]);
	
	foreach($buffer3 as $line)
	{
		$line_buffer1=explode('">Reserve</a>',$line);
		$ip=trim($line_buffer1[0]);
		if(filter_var($ip, FILTER_VALIDATE_IP))
		{
			array_push($ip_list,$ip);
		}
	}
	return $ip_list;
}

function readAndSaveIPs($host,$pw)
{
	$buffer=getIPs($host,$pw);
	$addr_date=date('Y-m-d',time());
	foreach($buffer as $ip_addr)
	{
		$sql='INSERT INTO ips (addr,addr_date) VALUES ("'.$ip_addr.'","'.$addr_date.'")';
		@mysql_query($sql);
	}
}

function getCity($ip)
{
	$buffer=file_get_contents('http://freegeoip.net/xml/'.$ip);
	$buffer1=explode('<City>',$buffer);
	$buffer2=explode('</City>',$buffer1[1]);
	return $buffer2[0];
}

?>