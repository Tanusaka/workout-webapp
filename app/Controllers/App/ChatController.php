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

		$message = '';


		if ($reqdata->attachments != "") {


			$attachments = explode("-", $reqdata->attachments);

			$message = $message.'<div class="chat-attachment-container text-center">';

			foreach ($attachments as $attachment) {

				$file = $this->moveFile($attachment, 'chats', 'chat_'.$reqdata->chatid);

				if (isset($file->id)) {
					if ($file->type=='image') {
						$name= 'Image';
						$src = $file->path.$file->name;
					} elseif ($file->type=="video") {
						$name= 'Video';
						$src = 'assets/images/video.png';
					} else {
						$name= 'Attachment';
						$src = 'assets/images/attachment.png';
					}

					$message = $message.'<div data-attachmentid="'.$file->id.'" data-attachmentpath="'.$file->path.$file->name.'" data-attachmenttype="'.$file->type.'" class="d-flex flex-stack chat-attachment-preview-item">'.				
						'<div class="d-flex">'.
							'<div class="symbol symbol-40px mt-4px">'.
								'<img src="'.$src.'">'.
							'</div>'.
							'<div class="ms-4 text-start">'.
								'<a class="fs-6 fw-bold text-gray-900 text-hover-primary mb-2">'.$name.'</a>'.
								'<div class="fw-semibold fs-7 text-muted">Size: '.$file->size.' MB</div>'.
							'</div>'.
						'</div>'.
					'</div>';
				}
			}

			$message = $message.'</div>';

			if ($reqdata->message!="") {
				$message = $message.'<div class="chat-content-container mt-5 pr-5">'.$reqdata->message.'</div>';
			}
		} else {
			$message = $message.'<div class="chat-content-container">'.$reqdata->message.'</div>';
		}

		

		$response = $this->chatmodel->savePersonalChatMessage([
			'chatid' => $reqdata->chatid,
			'type' => $reqdata->type,
			'message' => $message
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

	public function uploadAttachments()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('chat_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		return $this->uploadFiles();
	}
}
