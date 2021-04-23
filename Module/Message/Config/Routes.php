<?php

$routes->group("Message", ["namespace" => "\Module\Message\Controllers"], function ($routes) {

	// welcome page - URL: /Message
	$routes->get("/", "MessageController::index");
  
    // other page - URL: /Message/other-method
	$routes->get("other-method", "MessageController::otherMethod");

});