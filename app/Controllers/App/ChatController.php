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
	protected $chatmodel;

	public function __construct() {
		$this->chatmodel = new ChatModel();
  	}

	public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_management')) {
			return redirect()->route('error/403');
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
			'pageid' => 'all',
			'title' => 'Chats',
			'breadcrumbs' => [ 
				'Home' => 'dashboard', 
				'Apps' => '', 
				'Chats' => '' 
			],
		];

		return view('modules/apps/chats/index', $pagedata);
	}

	public function getAllChats()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_view')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$response = $this->chatmodel->getChats();

		if ($response->status==200) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => $response->data
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->messages
			]);
		}

        return $this->response;

	}

	public function getChat()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_view')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->chatmodel->getChat([
			'id' => trim($reqdata->chatid)
        ]);

		if ($response->status==200) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => $response->data
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->messages
			]);
		}

        return $this->response;

	}

	public function getPersonalChatConnections()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$response = $this->chatmodel->getPersonalChatConnections();

		if ($response->status==200) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => $response->data
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->messages
			]);
		}

        return $this->response;

	}

	public function savePersonalChat()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->chatmodel->savePersonalChat(['userid' => $reqdata->userid]);

		if ($response->status==200) {

			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => $response->data
			]);

		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->messages
			]);
		}

        return $this->response;

	}

	public function savePersonalChatMessage()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->chatmodel->savePersonalChatMessage([
			'chatid' => $reqdata->chatid,
			'type' => $reqdata->type,
			'message' => $reqdata->message
		]);

		if ($response->status==200) {

			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => $response->data
			]);

		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->messages
			]);
		}

        return $this->response;

	}

	public function deletePersonalChat()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->chatmodel->deletePersonalChat(['id' => trim($reqdata->id)]);

		if ($response->status==200) {
			$this->response->setJSON([ 
				'status' => 200,
				'message'  => $response->messages,
				'data' => $response->data
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'message'  => $response->messages
			]);
		}

        return $this->response;

	}
}
