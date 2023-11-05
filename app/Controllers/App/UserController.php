<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\UserModel;
use App\Models\App\RoleModel;

class UserController extends AuthController
{
	protected $usermodel;
	protected $rolemodel;

	public function __construct() {
		$this->usermodel = new UserModel();
		$this->rolemodel = new RoleModel();
  	}

	#users
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_management')) {
            return redirect()->route('error/403');
        }

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'all',
            'title' => 'Users',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Configs' => '', 
                'Users' => '' 
            ],
			'users' => $this->usermodel->get()->data
		];

		return view('modules/configs/users/index', $pagedata);
	}

	public function get($id=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_profile')) {
            return redirect()->route('error/403');
        }

		$response = $this->usermodel->getUser([ 'id' => $id ]);

		if ($response->status!=200) {
			return view('errors/pages/general', (array) $response);
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'title' => 'View User Details',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Configs' => 'configs/users', 
                'Users' => 'configs/users', 
                'Profile' => '' 
            ],
            'pageid' => 'view',
			'user' => $response->data,
			'roles' => $this->rolemodel->get()->data
		];

		return view('modules/configs/users/index', $pagedata);

	}

    public function create()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_create_profile')) {
            return redirect()->route('error/403');
        }

		$pagedata = [
			'pageid' => 'create',
			'permissions' => $_SESSION['permissions'],
            'title' => 'New User',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Configs' => 'configs/users', 
                'Users' => 'configs/users', 
                'Create' => '' 
            ],
            'roles' => $this->rolemodel->get()->data
		];

		return view('modules/configs/users/index', $pagedata);
	}

	public function save()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_create_profile')) {
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

	public function updateUserProfile()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_update_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		if ($reqdata->profileimage != "") {
			
			$reqdata->profileimageid = 0;
			
			$file = $this->moveFile($reqdata->profileimage, 'profileimages');
			if (isset($file->id)) {
				$reqdata->profileimageid = $file->id;
			}
		} 

		$user = json_decode(json_encode($reqdata), true);

		$response = $this->usermodel->updateUserProfile($user);

		if ($response->status==200) {

			$_SESSION['firstname'] = $response->data->user->firstname;
			$_SESSION['profileimage'] = $response->data->user->profileimage;

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

	public function updateUserPassword()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_update_password')) {
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

	public function updateUserDescription()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_update_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->updateUserDescription([
			'userid' => trim($reqdata->userid),
            'description' => trim($reqdata->description),
        ]);

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

	public function updateUserRole()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_update_role')) {
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

	public function getUserProfile()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->getUser([
			'id' => trim($reqdata->userid)
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

	public function getUserSettings()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->getUser([
			'id' => trim($reqdata->userid)
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

	public function getTrainers()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_trainer_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->getTrainers();

		if ($response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $response->data
			]);
        } else {
            $this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'messages'  => $response->messages
			]);
        }

        return $this->response;

	}

	public function getMyProfile()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_profile')) {
            return redirect()->route('error/403');
        }

		$response = $this->usermodel->getMyProfile();

		if ($response->status!=200) {
			return view('errors/pages/general', (array) $response);
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'title' => 'View User Details',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Configs' => 'configs/users', 
                'Users' => 'configs/users', 
                'Profile' => '' 
            ],
            'pageid' => 'myprofile',
			'user' => $response->data
		];

		return view('modules/configs/users/index', $pagedata);

	}

	public function getMyProfileView()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$response = $this->usermodel->getMyProfile();

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

	public function getMyProfileSettings()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_view_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$response = $this->usermodel->getMyProfile();

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

	public function uploadProfileImage()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_update_profile')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		return $this->uploadFile();
	}

	public function getUserRoleConnections()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_add_connections')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->getUserRoleConnections(['id' => trim($reqdata->userid)]);

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

	public function saveUserConnection()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_add_connections')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->saveUserConnection([
            'userid' => trim($reqdata->userid),
			'connid' => trim($reqdata->connid)
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

	public function deleteUserConnection()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('user_delete_connections')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->usermodel->deleteUserConnection(['id' => trim($reqdata->id)]);

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