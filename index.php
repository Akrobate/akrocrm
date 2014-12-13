<?php

	// DO NOT FORGET: "LESS IS MORE"
	
	session_start();	
	require_once("./api.php");

	$main = new Main();	
	$ctr = new Controller();
	$ctr->setAction(request::get("action"));
	$ctr->setModule(request::get("controller"));
	$main->assign('content', $ctr);
	$main->render();
