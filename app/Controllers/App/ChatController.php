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
    public function index()
	{
        if ( !AuthController::auth() ) {
            return redirect()->route('/');
        }

        $pagedata = [
			'permissions' => $_SESSION['permissions']
		];
        
		return view('modules/chat/chats', $pagedata);
	}
}