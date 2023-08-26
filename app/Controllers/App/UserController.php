<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\UserModel;
use App\Models\App\RoleModel;
use App\Models\App\LinkedprofileModel;

class UserController extends AuthController
{
	protected $usermodel;

	public function __construct() {
		$this->usermodel = new UserModel();
  	}

	#users
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-read')) {
            return redirect()->route('/');
        }

		$users = [];

		$response = $this->usermodel->get();

		if ($response->status==200) {
			$users = $response->data;
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'overview',
            'title' => 'Users',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'User Management' => '', 
                'Users' => '' 
            ],
			'users' => $users
		];

		return view('modules/configs/users/index', $pagedata);
	}

	public function get($id=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-read')) {
            return redirect()->route('/');
        }

		$user = [];

		$response = $this->usermodel->getUser([ 'userid' => $id ]);

		if ($response->status==200) {
			$user = $response->data;
		}

		if (empty($user)) {
			return view('errors/html/error_404', ['message'=>'User cannot be found.']);
		}

		$rolemodel = new RoleModel();
		$linkedprofilemodel = new LinkedprofileModel();

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'title' => 'View User Details',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'User Management' => 'configs/user-management/users', 
                'Users' => 'configs/user-management/users', 
                'Profile' => '' 
            ],
            'pageid' => 'view',
			'user' => $user,
			'roles' => $rolemodel->get()->data,
			'linkedprofiles' => $linkedprofilemodel->getLinkedprofiles(['userid'=>$user->id])->data,
			'usersforlinkedprofile' => $linkedprofilemodel->getUsersForLinkedProfile(['userid'=>$user->id])->data,
		];

		return view('modules/configs/users/index', $pagedata);

	}

    public function create()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            return redirect()->route('/');
        }

		$rolemodel = new RoleModel();

		$pagedata = [
			'pageid' => 'create',
			'permissions' => $_SESSION['permissions'],
            'title' => 'New User',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'User Management' => 'configs/user-management/users', 
                'Users' => 'configs/user-management/users', 
                'Create' => '' 
            ],
            'roles' => $rolemodel->get()->data
		];

		return view('modules/configs/users/index', $pagedata);
	}

	public function save()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->saveUser([
            'firstname' => trim($reqdata->firstname),
			'lastname' => trim($reqdata->lastname),
			'email' => trim($reqdata->email),
			'roleid' => trim($reqdata->roleid)
        ]);

		if ($response->status==200) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => $this->appconfigs->baseURL.'configs/user-management/users/view/'.$response->data->id,
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

	public function update_profile()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->updateUserProfile([
			'userid' => trim($reqdata->userid),
            'firstname' => trim($reqdata->firstname),
			'lastname' => trim($reqdata->lastname),
			'gender' => trim($reqdata->gender),
			'dob' => trim($reqdata->dob),
			'mobile' => trim($reqdata->mobile),
			'address1' => trim($reqdata->address1),
			'address2' => trim($reqdata->address2),
			'city' => trim($reqdata->city),
			'country' => trim($reqdata->country)
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

	public function update_password()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->updateUserPassword([
			'userid' => trim($reqdata->userid),
            'current_password' => trim($reqdata->current_password),
			'password' => trim($reqdata->new_password),
			'confirm_password' => trim($reqdata->confirm_password)
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

	public function update_role()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('users-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->updateUserRole([
			'userid' => trim($reqdata->userid),
            'roleid' => trim($reqdata->roleid)
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