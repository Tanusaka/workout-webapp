<?php

namespace App\Controllers\Core;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Psr\Log\LoggerInterface;

use App\Models\App\FileModel;
use App\Libraries\S3bucket;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'filesystem', 'file', 'text', 'utility'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    public $appconfigs;
	protected $appencrypter;


	protected $filemodel;

    use ResponseTrait;
    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
		register_ci_instance($this);

        // E.g.: 
        $this->session = \Config\Services::session();
        $this->appconfigs = config('App');

		$config         = new \Config\Encryption();
		$config->key    = 'aBigsecret_ofAtleast32Characters';
		$config->driver = 'OpenSSL';

		$this->appencrypter = \Config\Services::encrypter($config);

		$this->filemodel = new FileModel();
    }

    public function convertDateTimeTo($datetime="", $format="Y/m/d H:i:s") {
        $dateTimeArray = explode(' ', $datetime);
        $date=date_create($dateTimeArray[0]);
        return date_format($date, $format);

    }

	public function getCurrentDate() {
		return Time::today()->toDateString();
	}

	public function getCurrentYear() {
		return Time::today()->getYear();
	}

	public function getCurrentMonth() {
		return Time::today()->getMonth();
	}

	public function getCurrentDay() {
		return Time::today()->getDay();
	}

	public function uploadFiles() {

		$input = $this->validate([
			'file' => [
				'uploaded[files]',
				//'mime_in[file,image/jpg,image/jpeg,image/png]',
				'max_size[files,10000]',
			]
		]);

		$filename = ''; $filepath = ''; $filetype = ''; $filesize = ''; $fileextn= ''; $status=400;

		$uploadedFiles = [];
		
		if ($input) {
	
			if ($files = $this->request->getFiles()) {

				foreach($files['files'] as $file)
             	{ 
					$uploadedFile = [
						'filename' => $file->getRandomName(),
						'filepath' => WRITEPATH . 'uploads/temp',
						'filetype' => explode('/', $file->getMimeType())[0],
						'filesize' => $file->getSizeByUnit('mb'),
						'fileextn' => $file->guessExtension(),
					];

					$file->move($uploadedFile['filepath'], $uploadedFile['filename']);
					array_push($uploadedFiles, $uploadedFile);
				}

			}

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
				'uploadedFiles' => $uploadedFiles
			]
		]);

		return $this->response;
    }

    public function uploadFile() {

		$input = $this->validate([
			'file' => [
				'uploaded[file]',
				//'mime_in[file,image/jpg,image/jpeg,image/png]',
				'max_size[file,10000]',
			]
		]);

		$filename = ''; $filepath = ''; $filetype = ''; $status=400;

		if ($input) {
			$file = $this->request->getFile('file');

			$filename = $file->getRandomName();
			$filepath = WRITEPATH . 'uploads/temp';
			$filetype = explode('/', $file->getMimeType())[0];
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

    public function moveFile($fileData="", $root="public", $sub="") {

		$file = [];

		if ($fileData == "") {
			return 0;
		}

		$file = explode ("|", $fileData);

		$s3response = S3bucket::uploadToBucket($file[0]);

		if ( $s3response->get('ObjectURL') == null ) {
			return 0;
		} else {
			
			$upload = [
				'rootdir' => $root,
				'path' => $s3response->get('ObjectURL'),
				'name' => $file[0],
				'type' => $file[1],
				'ext' => $file[2],
				'size' => $file[3],
			];

			$response = $this->filemodel->saveFile($upload);

			if ($response->status==200) {
				return $response->data->file;
			} else {
				return 0;
			}

		}

    }
}
