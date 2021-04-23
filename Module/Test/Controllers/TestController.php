<?php

namespace Module\Test\Controllers;

use App\Controllers\BaseController;
use Module\Test\Models\TestModel;

class TestController extends BaseController
{
	public function index()
	{
		// echo "This is simple from Test Module";

        $data = [ "name" => "Sanjay", "email" => "sanjay_kumar@gmail.com" ];

		return view("\Module\Test\Views\index", $data);
	}
  
    public function otherMethod()
	{
		echo "This is other method from Test Module";
	}
}