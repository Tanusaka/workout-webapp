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
        $guardTokens = explode('-', $guard);

        $permissions = (array) $_SESSION['permissions'];

        if ( !is_null($permissions) ) {
            if ($guardTokens[1] == 'read') {
                return $permissions[$guardTokens[0]]->read;
            } else if ($guardTokens[1] == 'write') {
                return $permissions[$guardTokens[0]]->write;
            } else if ($guardTokens[1] == 'delete') {
                return $permissions[$guardTokens[0]]->delete;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }


}