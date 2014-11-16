<?php

	session_start();
	
	error_reporting(15);
	require_once("./api.php");
	
	$controller = request::get("controller");
	$action = request::get("action");

	$main = new Main();	
	$ctr = new Controller();
	$ctr->setAction($action);
	$ctr->setModule($controller);
	$main->assign('content', $ctr);
	$main->render();






