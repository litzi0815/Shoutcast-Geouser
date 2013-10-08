<?php

include('mysql.php');

function getIPs($host,$pw)
{
        $ip_list=array();
        $buffer1=explode('Listener List',$raw);
        foreach($buffer2 as $line)
        {
                $line_buffer1=explode('</font>',$line);
                $ip=trim($line_buffer1[0]);
                if($ip!='')
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