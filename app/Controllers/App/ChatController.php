<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;


use App\Models\App\ChatModel;
use App\Models\App\UserModel;


class ChatController extends AuthController
{
	protected $chatModel;
	protected $userModel;

	public function __construct() {
		$this->chatModel = new ChatModel();
		$this->userModel = new UserModel();
  	}
	
    public function index()
	{
        if ( !AuthController::auth() ) {
            return redirect()->route('/');
        }
	
	$threads = [];

	$response = $this->chatModel->get();
	$threads = $response->threads;

	$pagedata = [
		    'permissions' => $_SESSION['permissions'],
	            'pageid' => 'overview',
	            'title' => 'Messaging Page',
	            'breadcrumbs' => [ 
	                'Home' => 'dashboard', 
	                'User Management' => '', 
	                'Users' => '' 
	            ],
		    'threads' => $threads
	];
        
		return view('modules/chat/chats', $pagedata);
	}

	public function view($id)
	{
	        if ( !AuthController::auth() ) {
	            return redirect()->route('/');
	        }
		
		$thread = [];
	
		$response = $this->chatModel->getChat([ "other_user_id"=>$id,"limit"=>100,"offset"=>0 ]);
		$thread = array_reverse($response->messages);

		//print_r($thread);
		
		$threads = [];
	
		$response = $this->chatModel->get();
		$threads = $response->threads;

		$user = [];
	
		$response = $this->userModel->getUserData([ 'userid' => $id ]);
		//print_r($response);
		
		if ($response->status==200) {
			$user = $response->data;
		}
			
	        $pagedata = [
			    'permissions' => $_SESSION['permissions'],
		            'pageid' => 'overview',
		            'title' => 'Personal Messaging Page',
		            'breadcrumbs' => [ 
		                'Home' => 'dashboard', 
		                'User Management' => '', 
		                'Users' => '' 
		            ],
			    'messages' => $thread,
			    'threads' => $threads,
			    'linked_user' => $user
		];
        
		return view('modules/chat/chat', $pagedata);
	}

	public function save()
	{
	    if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();

		$response = $this->chatModel->saveChat([
			'receiver_id' => $reqdata->receiver_id,
			'message_text' => $reqdata->message_text
		]);

		if ($response->status=="success") {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->message_id
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->message
			]);
		}

		return $this->response;
	}
}
