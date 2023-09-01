<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;


use App\Models\App\ChatModel;

class ChatController extends AuthController
{
	protected $chatModel;

	public function __construct() {
		$this->chatModel = new ChatModel();
  	}
	
    public function index()
	{
        if ( !AuthController::auth() ) {
            return redirect()->route('/');
        }
	
	$threads = [];

	$response = $this->chatModel->get([ 'id' => 3 ]);
	print_r($response);
	if ($response->status==200) {
		$threads = $response->data;
	}

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
}
