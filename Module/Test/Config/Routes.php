<?php

$routes->group("test", ["namespace" => "\Module\Test\Controllers"], function ($routes) {

	// welcome page - URL: /Test
	$routes->get("/", "TestController::index");
  
    // other page - URL: /Test/other-method
	$routes->get("other-method", "TestController::otherMethod");

});