<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\FileModel;

class FileController extends AuthController
{
    protected $filemodel;

	public function __construct() {
		$this->filemodel = new FileModel();
  	}

	#courses
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('file_management')) {
            return redirect()->route('error/403');
        }

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'all',
            'title' => 'File Management',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Libraries' => '', 
                'Files' => '' 
            ],
			'files' => $this->filemodel->getFiles()->data
		];

		return view('modules/libraries/files/index', $pagedata);
	}

	public function upload()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('file_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		return $this->uploadFile();
	}

	public function save()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('file_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$additionalData = [
			#other data goes here
		];

		$file = $this->moveFile($reqdata->fileupload, 'public', $additionalData);

		if (isset($file->id)) {

			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => 'File has been uploaded succeesfully.',
				'data' => $file
			]);

		} else {
			$this->response->setJSON([ 
				'status' => 400,
				'redirect' => '',
				'message'  => 'Drop or upload a valid file before save changes.'
			]);
		}

        return $this->response;

	}

	public function delete()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('file_delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->filemodel->deleteFiles([ 'files' => $reqdata->files ]);

		if ($response->status==200) {

			if (isset($response->data->links) && !empty($response->data->links)) {
				foreach ($response->data->links as $link) {
					#remove image from folder
					unlink(FCPATH . $link);
				}
			}

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
}