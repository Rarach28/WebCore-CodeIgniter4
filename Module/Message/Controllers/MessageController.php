<?php

namespace Module\Message\Controllers;

use App\Controllers\BaseController;
use Module\Message\Models\MessageModel;

class MessageController extends BaseController
{
	public function __construct(){
		$this->model = new \Module\Message\Models\MessageModel;
		$this->user = new \App\Models\UserModel;
	}

	public function index()
	{
		// echo "This is simple from Message Module";
		$allUsers = $this->model->getAllUsersPrev(current_user()->id);
		// $messageWith = $this->model->getMessageWith(current_user()->id,$this->user->lastUserId());
		
		
        $data = [ 
			"allUsers" => $allUsers,
		
		];

		return view("\Module\Message\Views\index", $data);
	}
  
    public function chatWith($urId){
		$allMessages = $this->model->messageWith(current_user()->id,$urId);
		$otherUser = $this->user->findById($urId);

		$data = [
			"allMessages" => $allMessages,
			"otherUser" => $otherUser
			
		];

		return view('\Module\Message\Views\chat', $data);
	}

	public function chatTo(){
		// $from_user_id = (current_user()->id);
		$text = $this->request->getPost("message");
		$mess = new \Module\Message\Entities\Message($this->request->getPost());
		// $to_user_id = $this->request->getPost("to_user_id");


		// $mess->from_user_id = $from_user_id;
		// $mess->text = $text;
		// $mess->to_user_id = $to_user_id;

		// $data = [
		// 	"from_user_id" => $from_user_id,
		// 	"to_user_id" => $to_user_id,
		// 	"text" => $text
		// ];

		dd($mess);
		if($this->model->insertMess($mess)){
			return redirect()->back()->with("success","HOTOVO");;
		} else{
			return rediret()->back()->with("error","Něco se pokazilo :/");
		}
	}


	public function otherMethod()
	{
		echo "This is other method from Message Module";
	}

	// public function index()
	// {
	// 	// echo "This is simple from Message Module";
	// 	$allUsers = $this->model->getAllUsers();
	// 	$messageWith = $this->model->getMessageWith(current_user()->id,$this->user->lastUserId());
		
    //     $data = [ 
	// 		"allUsers" => $allUsers,
	// 		"messageWith" => $messageWith,
		
	// 	];

	// 	return view("\Module\Message\Views\index", $data);
	// }
}