<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\MediaModel;

class MediaController extends AuthController
{
    protected $mediamodel;

	public function __construct() {
		$this->mediamodel = new MediaModel();
  	}

	#courses
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            return redirect()->route('/');
        }

		$media = [];

		$response = $this->mediamodel->get();

		if ($response->status==200) {
			$media = $response->data;
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'overview',
            'title' => 'Media',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Libraries' => '', 
                'Media' => '' 
            ],
			'media' => $media
		];

		return view('modules/libraries/media/index', $pagedata);
	}

	public function upload()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$input = $this->validate([
			'file' => [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/png]',
				'max_size[file,1024]',
			]
		]);

		$filename = ''; $filepath = ''; $filetype = ''; $status=400;

		if ($input) {
			$file = $this->request->getFile('file');

			$filename = $file->getRandomName();
			$filepath = WRITEPATH . 'uploads/temp';
			$filetype = $file->getMimeType();
			$filesize = $file->getSizeByUnit('mb');
			$fileextn = $file->guessExtension();

			$file->move($filepath, $filename);

			$status = 200;

		} else {
			$status = 400;     
		}

		$this->response->setJSON([ 
			'status' => 200,
			'redirect' => '',
			'messages'  => '',
			'data' => [
				'status' => $status,  
				'filename' => $filename,
				'filetype' => $filetype,
				'filepath' => $filepath,
				'filesize' => $filesize,
				'fileextn' => $fileextn,
			]
		]);

		return $this->response;
	}

	public function save()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$media = [
            'tenantid' => 1,
			'path' => 'uploads/media/',
			'name' => $reqdata->filename,
			'type' => $reqdata->filetype,
			'ext' => $reqdata->fileextn,
			'size' => $reqdata->filesize,
        ];

		$response = $this->mediamodel->saveMedia($media);

		if ($response->status==200) {

			try {
				if ($reqdata->filename != "") {
					#move file to permement location IF EXIIST
					$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/'.$reqdata->filename);
					$file->move(FCPATH . 'uploads/media');
				}
			} catch (\Exception $e) {
				log_message('error', '[ERROR] {exception}', ['exception' => $e]);
			}


			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => $this->appconfigs->baseURL.'libraries/media',
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

	public function delete()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => $this->appconfigs->baseURL.'libraries/media',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		if (!empty($reqdata->files)) {
			$dcount = 0;
			foreach ($reqdata->files as $file) {
				$media = $this->mediamodel->getMedia([ 'id' => $file ]);
				if ($media->status==200) {
					$this->mediamodel->deleteMedia([ 'id' => $media->data->id ]);
					#remove image from folder
					unlink(FCPATH . 'uploads/media/'.$media->data->name);
					$dcount++;
				}
			}

			if ($dcount==count($reqdata->files)) {
				$this->response->setJSON([ 
					'status' => 200,
					'redirect' => $this->appconfigs->baseURL.'libraries/media',
					'message'  => 'All selected files have been deleted.'
				]);
			} else {
				$this->response->setJSON([ 
					'status' => 400,
					'redirect' => $this->appconfigs->baseURL.'libraries/media',
					'message'  => 'All selected files have not been deleted.'
				]);
			}
		} else {
			$this->response->setJSON([ 
				'status' => 400,
				'redirect' => $this->appconfigs->baseURL.'libraries/media',
				'message'  =>'Files not selected'
			]);
		}

        return $this->response;
	}
}