<?php
	/**
	 * Import kernel framework and routing 
	 */
	require_once 'vendors/primal/kernel/Kernel.php';
	require_once 'vendors/primal/kernel/Router.php';

	/**
	 * Set a default routing
	 */
	$router = Router::getInstance('myapp.myapp.index');


	/**
	 * Configure routing
	 */
	$router->setUrls([
	    'generate' => 'myapp.myapp.index'
	]);


	/**
	 * Show routed service
	 */
	echo $router->rout(realpath(dirname(__FILE__)));