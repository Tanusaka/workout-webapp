<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\CourseModel;

class CourseController extends AuthController
{
	protected $coursemodel;

	public function __construct() {
		$this->coursemodel = new CourseModel();
  	}

	#courses
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            return redirect()->route('/');
        }

		$courses = [];

		$response = $this->coursemodel->get();

		if ($response->status==200) {
			$courses = $response->data;
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
			'courses' => $courses
		];

		return view('modules/libraries/courses/overview', $pagedata);
	}

	public function get($id=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            return redirect()->route('/');
        }

		$course = [];

		$response = $this->coursemodel->getCourse([ 'id' => $id ]);

		if ($response->status==200) {
			$course = $response->data;
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
			'course' => $course,
		];

		return view('modules/libraries/courses/view', $pagedata);

	}

	public function create()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-write')) {
            return redirect()->route('/');
        }

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
		];

		return view('modules/libraries/courses/create', $pagedata);

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

		$course = [
            'tenantid' => 1,
            'coursetype' => $reqdata->coursetype,
			'coursename' => $reqdata->coursename,
			'courseintro' => $reqdata->courseintro,
			'coursedescription' => $reqdata->coursedescription
        ];

		if ($reqdata->courseimage != "") {
			$course['coursemediapath'] = 'uploads/courses/'.$reqdata->courseimage;
		}

		$response = $this->coursemodel->saveCourse($course);

		if ($response->status==200) {

			try {
				if ($reqdata->courseimage != "") {
					#move file to permement location IF EXIIST
					$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/courses/'.$reqdata->courseimage);
					$file->move(FCPATH . 'uploads/courses');
				}
			} catch (\Exception $e) {
				log_message('error', '[ERROR] {exception}', ['exception' => $e]);
			}


			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => $this->appconfigs->baseURL.'libraries/courses/view/'.$response->data->id,
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

	public function update()
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

		$t_response = $this->coursemodel->getCourse([ 'id' => $reqdata->courseid ]);

		if ($t_response->status==200) {

			$t_course = $t_response->data;

			$course = [
				'courseid' => $reqdata->courseid,
				'coursetype' => $reqdata->coursetype,
				'coursename' => $reqdata->coursename,
				'courseintro' => $reqdata->courseintro,
				'coursedescription' => $reqdata->coursedescription
			];

			if ($reqdata->courseimage != "") {
				$course['coursemediapath'] = 'uploads/courses/'.$reqdata->courseimage;
			} else {
				$course['coursemediapath'] = $t_course->coursemediapath;
			}

			$response = $this->coursemodel->updateCourse($course);

			if ($response->status==200) {

				try {
					if ($reqdata->courseimage != "") {
						#move file to permement location IF EXIIST
						$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/courses/'.$reqdata->courseimage);
						$file->move(FCPATH . 'uploads/courses');
					}
				} catch (\Exception $e) {
					log_message('error', '[ERROR] {exception}', ['exception' => $e]);
				}
				
				$this->response->setJSON([ 
					'status' => 200,
					'redirect' => '',
					'message'  => $response->messages,
					'data' => $this->coursemodel->getCourse([ 'id' => $reqdata->courseid ])
				]);

			} else {
				$this->response->setJSON([ 
					'status' => $response->status,
					'redirect' => '',
					'message'  => $response->messages
				]);
			}
		} else {
			$this->response->setJSON([ 
				'status' => 404,
				'redirect' => '',
				'message'  => 'Record Not Found.'
			]);
		}

        return $this->response;

	}

	public function remove_courseimage()
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

		$c_response = $this->coursemodel->getCourse([ 'id' => $reqdata->courseid ]);

		if ($c_response->status==200) {

			#remove image from folder
			delete_files(WRITEPATH . 'uploads/courses/'.$c_response->data->coursemediapath);

			$response = $this->coursemodel->updateCourse([
				'courseid' => $c_response->data->id,
				'coursetype' => $c_response->data->coursetype,
				'coursename' => $c_response->data->coursename,
				'courseintro' => $c_response->data->courseintro,
				'coursedescription' => $c_response->data->coursedescription,
				'coursemediapath' => ''
			]);
	
			if ($response->status==200) {
				$this->response->setJSON([ 
					'status' => 200,
					'redirect' => '',
					'message'  => $response->messages,
					'data' => $this->coursemodel->getCourse([ 'id' => $reqdata->courseid ])
				]);
			} else {
				$this->response->setJSON([ 
					'status' => $response->status,
					'redirect' => '',
					'message'  => $response->messages
				]);
			}

		} else {
			$this->response->setJSON([ 
				'status' => $c_response->status,
				'redirect' => '',
				'message'  => $c_response->messages
			]);
		}

		


        return $this->response;
	}


	#view-tabs

	public function get_overview()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourse([ 'id' => $reqdata->course_id ]);

		if ($response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $response->data->coursedescription
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

	public function get_contents()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourse([ 'id' => $reqdata->course_id ]);

		if ($response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $response->data->sections,
				'permissions'=> $_SESSION['permissions']->courses_content,
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

	public function get_settings()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourse([ 'id' => $reqdata->course_id ]);

		if ($response->status == 200 ) {

			$settings = [
				'courseid' => $response->data->id,
				'coursetype' => $response->data->coursetype,
				'coursename' => $response->data->coursename,
				'courseintro' => $response->data->courseintro,
				'coursedescription' => $response->data->coursedescription,
				'coursemediapath' => $response->data->coursemediapath,
			];

			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $settings
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

	#sections


	public function get_section()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourseSection([ 'id' => $reqdata->sectionid ]);

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

	public function save_section()
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

		$response = $this->coursemodel->saveCourseSection([
            'courseid' => $reqdata->courseid,
			'sectionname' => $reqdata->sectionname
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

	public function update_section()
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

		$response = $this->coursemodel->updateCourseSection([
            'sectionid' => $reqdata->sectionid,
			'sectionname' => $reqdata->sectionname,
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


	#lessons

	public function get_lesson()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourseLesson([ 'id' => $reqdata->lessonid ]);

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

	public function save_lesson()
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

		$lesson = [
            'sectionid' => $reqdata->sectionid,
			'lessonname' => $reqdata->lessonname,
			'lessondescription' => $reqdata->lessondescription,
			'lessonduration' => $reqdata->lessonduration
        ];

		if ($reqdata->lessonmedia != "") {
			$lesson['lessonmediapath'] = 'uploads/lessons/'.$reqdata->lessonmedia;
		}

		$response = $this->coursemodel->saveCourseLesson($lesson);

		if ($response->status==200) {

			try {
				if ($reqdata->lessonmedia != "") {
					#move file to permement location IF EXIIST
					$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/lessons/'.$reqdata->lessonmedia);
					$file->move(FCPATH . 'uploads/lessons');
				}
			} catch (\Exception $e) {
				log_message('error', '[ERROR] {exception}', ['exception' => $e]);
			}

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

	public function update_lesson()
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

		$t_response = $this->coursemodel->getCourseLesson([ 'id' => $reqdata->lessonid ]);

		if ($t_response->status==200) {

			$t_lesson = $t_response->data;

			$lesson = [
				'lessonid' => $reqdata->lessonid,
				'lessonname' => $reqdata->lessonname,
				'lessonduration' => $reqdata->lessonduration,
				'lessondescription' => $reqdata->lessondescription,
			];

			if ($reqdata->lessonmedia != "") {
				$lesson['lessonmediapath'] = 'uploads/lessons/'.$reqdata->lessonmedia;
			} else {
				$lesson['lessonmediapath'] = $t_lesson->lessonmediapath;
			}

			$response = $this->coursemodel->updateCourseLesson($lesson);


			if ($response->status==200) {

				try {
					if ($reqdata->courseimage != "") {
						#move file to permement location IF EXIIST
						$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/lessons/'.$reqdata->lessonmedia);
						$file->move(FCPATH . 'uploads/lessons');
					}
				} catch (\Exception $e) {
					log_message('error', '[ERROR] {exception}', ['exception' => $e]);
				}

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

		} else {
			$this->response->setJSON([ 
				'status' => 404,
				'redirect' => '',
				'message'  => 'Record Not Found.'
			]);
		}

        return $this->response;

	}
	
	public function upload_lesson()
	{
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
			$filepath = WRITEPATH . 'uploads/temp/lessons';
			$filetype = $file->getClientMimeType();

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
				'filename'  => $filename,
				'filetype' => $filetype,
				'filepath' => $filepath
			]
		]);

		return $this->response;
	}

	public function upload_courseimage()
	{
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
			$filepath = WRITEPATH . 'uploads/temp/courses';
			$filetype = $file->getClientMimeType();

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
				'filename'  => $filename,
				'filetype' => $filetype,
				'filepath' => $filepath
			]
		]);

		return $this->response;
	
	}

}