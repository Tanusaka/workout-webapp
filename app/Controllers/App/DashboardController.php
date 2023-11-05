<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;


class DashboardController extends AuthController
{
    public function index()
	{
		if ( !AuthController::auth() ) {
            return redirect()->route('/');
        }

		$pagedata = [
			'permissions' => $_SESSION['permissions']
		];

		return view('modules/dashboard/dashboard', $pagedata);
	}


}