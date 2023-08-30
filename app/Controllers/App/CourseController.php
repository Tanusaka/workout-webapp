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
            'pageid' => 'overview',
            'title' => 'Courses',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Libraries' => '', 
                'Courses' => '' 
            ],
			'courses' => $courses
		];

		return view('modules/libraries/courses/index', $pagedata);
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

		if (empty($course)) {
			return view('errors/html/error_404', ['message'=>'Course cannot be found.']);
		}

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'title' => 'View Course Details',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Libraries' => 'libraries/courses', 
                'Courses' => 'libraries/courses', 
                'Profile' => '' 
            ],
            'pageid' => 'view',
			'course' => $course
		];

		return view('modules/libraries/courses/index', $pagedata);

	}

	public function create()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses-write')) {
            return redirect()->route('/');
        }

		$pagedata = [
			'pageid' => 'create',
			'permissions' => $_SESSION['permissions'],
            'title' => 'New Course',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Libraries' => 'libraries/courses', 
                'Courses' => 'libraries/courses', 
                'Create' => '' 
            ],
		];

		return view('modules/libraries/courses/index', $pagedata);
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
			'coursename' => $reqdata->coursename,
			'courseintro' => $reqdata->courseintro,
			'coursetype' => $reqdata->coursetype,
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

			// if ($reqdata->courseimage != "") {
			// 	$course['coursemediapath'] = 'uploads/courses/'.$reqdata->courseimage;
			// } else {
			// 	$course['coursemediapath'] = $t_course->coursemediapath;
			// }

			$response = $this->coursemodel->updateCourse($course);

			if ($response->status==200) {

				// try {
				// 	if ($reqdata->courseimage != "") {
				// 		#move file to permement location IF EXIIST
				// 		$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/courses/'.$reqdata->courseimage);
				// 		$file->move(FCPATH . 'uploads/courses');
				// 	}
				// } catch (\Exception $e) {
				// 	log_message('error', '[ERROR] {exception}', ['exception' => $e]);
				// }
				
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

	public function delete() {
        if (!AuthController::auth() || !AuthController::hasPermissions('courses-delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourse([
            'id' => trim($reqdata->id)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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


	#overview
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
				'data' => [
					"description" => $response->data->coursedescription,
					"createdby" => $response->data->createdby,
					"createdat" => $this->convertDateTimeTo($response->data->createdat, "d F Y")
				]
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

	#content
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

	public function delete_section() {
        if (!AuthController::auth() || !AuthController::hasPermissions('courses-delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseSection([
            'id' => trim($reqdata->id)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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
			//'lessonduration' => $reqdata->lessonduration
		];

		// if ($reqdata->lessonmedia != "") {
		// 	$lesson['lessonmediapath'] = 'uploads/lessons/'.$reqdata->lessonmedia;
		// }

		$response = $this->coursemodel->saveCourseLesson($lesson);

		if ($response->status==200) {

			// try {
			// 	if ($reqdata->lessonmedia != "") {
			// 		#move file to permement location IF EXIIST
			// 		$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/lessons/'.$reqdata->lessonmedia);
			// 		$file->move(FCPATH . 'uploads/lessons');
			// 	}
			// } catch (\Exception $e) {
			// 	log_message('error', '[ERROR] {exception}', ['exception' => $e]);
			// }

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
				// 'lessonduration' => $reqdata->lessonduration,
				'lessondescription' => $reqdata->lessondescription,
			];

			// if ($reqdata->lessonmedia != "") {
			// 	$lesson['lessonmediapath'] = 'uploads/lessons/'.$reqdata->lessonmedia;
			// } else {
			// 	$lesson['lessonmediapath'] = $t_lesson->lessonmediapath;
			// }

			$response = $this->coursemodel->updateCourseLesson($lesson);

			if ($response->status==200) {

				// try {
				// 	if ($reqdata->courseimage != "") {
				// 		#move file to permement location IF EXIIST
				// 		$file = new \CodeIgniter\Files\File(WRITEPATH . 'uploads/temp/lessons/'.$reqdata->lessonmedia);
				// 		$file->move(FCPATH . 'uploads/lessons');
				// 	}
				// } catch (\Exception $e) {
				// 	log_message('error', '[ERROR] {exception}', ['exception' => $e]);
				// }

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

	public function delete_lesson() {
        if (!AuthController::auth() || !AuthController::hasPermissions('courses-delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseLesson([
            'id' => trim($reqdata->id)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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

	#instructors
	public function get_instructors()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses_instructor-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();
		
		$response = $this->coursemodel->getCourseInstructors([ 'courseid' => $reqdata->course_id ]);

		if ($response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $response->data,
				'permissions'=> $_SESSION['permissions']->courses_instructor,
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

	public function get_instructors_for_course($courseid=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses_instructor-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }
		
		$response = $this->coursemodel->getInstructorsForCourse([ 'courseid' => $courseid ]);

        return json_encode($response);
	}

	public function save_instructor() {

		if (!AuthController::auth() || !AuthController::hasPermissions('courses_instructor-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->saveCourseInstructor([
            'courseid' => $reqdata->courseid,
			'userid' => $reqdata->userid,
			'type' => $reqdata->type
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

	public function delete_instructor() {
        if (!AuthController::auth() || !AuthController::hasPermissions('courses_instructor-delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseInstructor([
            'id' => trim($reqdata->id)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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
        }

        return $this->response;
    }

	#reviews
	public function get_reviews()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses_review-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();
		
		$response = $this->coursemodel->getCourseReviews([ 'courseid' => $reqdata->course_id ]);

		if ($response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $response->data,
				'permissions'=> $_SESSION['permissions']->courses_review,
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

	public function save_review() {

		if (!AuthController::auth() || !AuthController::hasPermissions('courses_review-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->saveCourseReview([
            'courseid' => $reqdata->courseid,
			'review' => $reqdata->review,
			'rating' => $reqdata->rating,
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

	public function delete_review() {
        if (!AuthController::auth() || !AuthController::hasPermissions('courses_review-delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseReview([
            'id' => trim($reqdata->id)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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
        }

        return $this->response;
    }

	#followers
	public function get_followers()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses_follower-read')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();
		
		$response = $this->coursemodel->getCourseFollowers([ 'courseid' => $reqdata->course_id ]);

		if ($response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
                'messages'  => '',
				'data' => $response->data,
				'permissions'=> $_SESSION['permissions']->courses_follower,
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

	public function get_followers_for_course($courseid=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('courses_follower-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }
		
		$response = $this->coursemodel->getFollowersForCourse([ 'courseid' => $courseid ]);

        return json_encode($response);
	}

	public function save_follower() {

		if (!AuthController::auth() || !AuthController::hasPermissions('courses_follower-write')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->saveCourseFollower([
            'courseid' => $reqdata->courseid,
			'userid' => $reqdata->userid,
			'type' => $reqdata->type
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

	public function delete_follower() {
        if (!AuthController::auth() || !AuthController::hasPermissions('courses_follower-delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseFollower([
            'id' => trim($reqdata->id)
        ]);

        
        if (!isset($response->status)) {
            $this->response->setJSON([ 
                'status' => 500,
                'redirect' => '',
                'message'  => $response->message
            ]);
        } else {
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
        }

        return $this->response;
    }

	#settings
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

}