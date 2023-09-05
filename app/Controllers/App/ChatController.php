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
	
		$response = $this->chatModel->getChat([ "other_user_id"=>$id,"limit"=>10,"offset"=>0 ]);
		$thread = $response->messages;
		
		$threads = [];
	
		$response = $this->chatModel->get();
		$threads = $response->threads;

		$user = [];
	
		$response = $this->userModel->getUser([ 'userid' => $id ]);
		
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
			    'thread' => $thread,
			    'threads' => $threads,
			    'linked_user' => $user
		];
        
		return view('modules/chat/chat', $pagedata);
	}
}
