<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\Core\BaseController;

use App\Models\App\AuthModel;


class AuthController extends BaseController
{

    protected $authmodel;


    public function __construct() {
		$this->authmodel = new AuthModel();
  	}

    public function index()
	{
        if (AuthController::auth()) {
            return redirect()->route('dashboard');
        }

		return view('modules/auth/login');
	}

    public function login()
    {
        $reqdata = $this->request->getJSON();

        $response = $this->authmodel->check([
            'email' => $reqdata->email,
            'password' => $reqdata->password
        ]);

        if ( isset($response->token) ) {

            $auth['id']  = $response->id;
            $auth['tenantid']  = $response->tenantid;
            $auth['email']  = $response->email;
            $auth['roleid']  = $response->roleid;
            $auth['rolename']  = $response->rolename;
            $auth['firstname']  = $response->firstname;
            $auth['lastname']  = $response->lastname;
            $auth['profileimage']  = $response->profileimage;
            $auth['token']  = $response->token;
            $auth['refreshtoken']  = $response->rtoken;
            $auth['logged_in'] = true;
            $auth['last_activity_at']  = time();

            $this->session->set($auth);
            $this->session->set('permissions', $this->authmodel->getPermissions());

            $this->response->setJSON([ 
                'status' => 200,
                'redirect'  => $this->appconfigs->baseURL.'dashboard'
            ]);
        } else {
            $this->response->setJSON([ 
                'status' => $response->status,
                'message'  => $response->messages->error
            ]);
        }

        return $this->response;
    }

    public function logout()
    {
        $this->authmodel->logout();
        $this->session->destroy();    
        return redirect()->route('/');
    }

    public static function auth() 
    {   
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'])   {
        return true;
        } else {
        return false;
        }
    } 

    public static function hasPermissions($guard=null)
    {
        $permissions = (array) $_SESSION['permissions'];

        if (isset($permissions[$guard])) {
            return $permissions[$guard];
        } else {
            return false;
        }
    }


}