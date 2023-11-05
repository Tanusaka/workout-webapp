<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\RoleModel;

class RoleController extends AuthController
{
	protected $rolemodel;

	public function __construct() {
		$this->rolemodel = new RoleModel();
  	}

	#roles
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('role_management')) {
            return redirect()->route('error/403');
        }

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'all',
            'title' => 'Roles',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Configs' => '', 
                'Roles' => '' 
            ],
			'roles' => $this->rolemodel->get()->data
		];

		return view('modules/configs/roles/index', $pagedata);
	}

    public function get($id=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('role_view_permissions')) {
            return redirect()->route('error/403');
        }

		$response = $this->rolemodel->getRole([ 'id' => $id ]);
		
		if ($response->status!=200) {
			return view('errors/pages/general', (array) $response);
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'title' => $response->data->rolename.' - Permissions',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Configs' => 'configs/roles', 
                'Roles' => 'configs/roles', 
                'Permissions' => '' 
            ],
            'pageid' => 'view',
			'role' => $response->data
		];

		return view('modules/configs/roles/index', $pagedata);

	}

	public function updatePermissions() 
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('role_update_permissions')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->rolemodel->updatePermissions([
            'permissionid' => $reqdata->permissionid,
			'access' => $reqdata->access
        ]);

		if ($response->status==200) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages
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

}