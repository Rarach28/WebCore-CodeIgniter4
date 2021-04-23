<?php

namespace Module\Message\Controllers;

use App\Controllers\BaseController;
use Module\Message\Models\MessageModel;

class MessageController extends BaseController
{
	public function index()
	{
		// echo "This is simple from Message Module";

        $data = [ "name" => "Sanjay", "email" => "sanjay_kumar@gmail.com" ];

		return view("\Module\Message\Views\index", $data);
	}
  
    public function otherMethod()
	{
		echo "This is other method from Message Module";
	}
}