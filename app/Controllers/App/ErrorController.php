<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;


class ErrorController extends AuthController
{
    public function error_403()
	{
		return view('errors/pages/403');
	}


}