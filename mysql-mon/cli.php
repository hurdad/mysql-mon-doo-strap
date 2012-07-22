<?php
	include './protected/config/common.conf.php';
	include './protected/config/routes.conf.php';
	include './protected/config/db.conf.php';
	include $config['BASE_PATH'].'Doo.php';
	include $config['BASE_PATH'].'app/DooConfig.php';
	include $config['BASE_PATH'].'app/DooCliApp.php';

	//only run via CLI
	if(!defined('STDIN') ) exit;

	//new CLI App
	$cli = new DooCliApp;
	
	//config
	Doo::conf()->set($config);
	
	//set default db
	Doo::db()->setDb($dbconfig, 'mysql-mon');
	
	//set routes
	$cli->route = $route;
	
	//run controller in args
	$cli->run($argv);
?>
