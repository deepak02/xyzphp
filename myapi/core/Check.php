<?php 
require "config.php";

class Check extends config 
{
	function __construct()
	{
	   parent::__construct();	
	}
	
	function save()
	{
	   $data = array('time1'=>$_REQUEST['time1'],'time2'=>$_SERVER['REQUEST_TIME']);
	
	   $q = $this->db->query("insert into testing values('".implode("','",$data)."')");
	   echo $q ? json_encode(array("time"=>array(array("message"=>'done')))):  json_encode(array("time"=>array(array("message"=>'done'))));
	}
}
?>