<?php 
 require_once "core/autoload.php";
 

	function getrequest() 
	{
	   $get  = new controller;
	   $get->do_all();	
	}

	function deviceRegister()
	{
		$send = new controller;
		$send->registerTOKEN();
	}

	function chat()
	{
       $chat = new controller;
	   $chat->chitchat();
	}
    
    function uploadtrack()
	{
	     $track = new controller;
		 $track->setTrack();
	}

    function addfriend()
	{
	   $friend = new controller;
	   $friend->friends();
	}

    function testapp()
	{
	     $test = new Check;
		 $test->save();
	}

    function tokenrefresh()
	{	
	        $token = new controller;
		    $token->tokenreload();
	}
    
    function track()
	{
	    $track = new Tracks;
		$track->getTrack();
	}
		
?>