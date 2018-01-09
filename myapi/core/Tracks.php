<?php 
require "config.php";
class Tracks extends config 
{
    function __construct()
	{
	    parent::__construct();	
	}
	
	function getTrack()
	{
	   $query = $this->db->query("select * from `tracks`,`users` where `users`.`idu` = `tracks`.`uid` &&  title like '%".$_REQUEST['t-search']."%' order by `tracks`.`id` desc");
	   if($query->num_rows>0) :
		 while($row = $query->fetch_assoc()) : 
		   $set['search-track'][] = $row;
           $set['success'] = 1;
		 endwhile;
		else : 
		 $set['search-track'][] = array("message"=>"No Found");
		 $set['success'] = 0;
		endif;
		echo json_encode($set);
	}
	
}
?>