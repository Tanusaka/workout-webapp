<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\LinkedprofileModel;

class LinkedprofileController extends AuthController
{
	protected $linkedprofilemodel;

	public function __construct() {
		$this->linkedprofilemodel = new LinkedprofileModel();
  	}

    public function saveLinkedProfile() {
        if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->linkedprofilemodel->saveLinkedProfile([
            'userid' => trim($reqdata->userid),
			'linkedprofileid' => trim($reqdata->linkedprofileid)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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
        }

        return $this->response;
    }

    public function deleteLinkedProfile() {
        if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->linkedprofilemodel->deleteLinkedProfile([
            'id' => trim($reqdata->linkid)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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
        }

        return $this->response;
    }

}