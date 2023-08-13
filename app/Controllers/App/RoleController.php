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
		if (!AuthController::auth() || !AuthController::hasPermissions('roles-read')) {
            return redirect()->route('/');
        }

		$roles = [];

		$response = $this->rolemodel->get();

		if ($response->status==200) {
			$roles = $response->data;
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'overview',
            'title' => 'Roles',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'User Management' => '', 
                'Roles' => '' 
            ],
			'roles' => $roles
		];

		return view('modules/configs/roles/index', $pagedata);
	}

    public function get($id=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('roles-read')) {
            return redirect()->route('/');
        }

		$role = [];

		$response = $this->rolemodel->getRole([ 'roleid' => $id ]);

		if ($response->status==200) {
			$role = $response->data;
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'title' => $role->rolename.' - Permissions',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'User Management' => 'configs/user-management/roles', 
                'Roles' => 'configs/user-management/roles', 
                'Permissions' => '' 
            ],
            'pageid' => 'view',
			'role' => $role
		];

		return view('modules/configs/roles/index', $pagedata);

	}


	public function update_permissions() 
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('roles-write')) {
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
			'mode' => $reqdata->mode,
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