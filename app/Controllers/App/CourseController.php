<?php
/**
 *
 * @author Samu
 */
namespace App\Controllers\App;

use App\Controllers\App\AuthController;

use App\Models\App\CourseModel;
use App\Models\App\UserModel;

use App\Libraries\Paypal;
use App\Libraries\Authorizenet;

class CourseController extends AuthController
{
	protected $coursemodel;
	protected $usermodel;

	public function __construct() {
		$this->coursemodel = new CourseModel();
		$this->usermodel = new UserModel();
  	}

	#courses
    public function index()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_management')) {
            return redirect()->route('error/403');
        }

		$pagedata = [
			'permissions' => $_SESSION['permissions'],
            'pageid' => 'all',
            'title' => 'Courses',
            'breadcrumbs' => [ 
                'Home' => 'dashboard', 
                'Libraries' => '', 
                'Courses' => '' 
            ],
			'courses' => $this->coursemodel->get()->data
		];

		return view('modules/libraries/courses/index', $pagedata);
	}

	public function view($id=0)
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_view')) {
            return redirect()->route('error/403');
        }

		$response = $this->coursemodel->getCourse([ 'id' => $id ]);
		
		if ($response->status!=200) {
			return view('errors/pages/general', (array) $response);
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
			'course' => $response->data
		];

		return view('modules/libraries/courses/index', $pagedata);

	}

	public function create()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_create')) {
            return redirect()->route('error/403');
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
			'instructors' => $this->coursemodel->getCourseInstructors()->data,
		];

		return view('modules/libraries/courses/index', $pagedata);
	}

	public function saveCourse()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		if ($reqdata->courseimage != "") {

			$reqdata->courseimageid = 0;
			
			$file = $this->moveFile($reqdata->courseimage, 'courses');
			if (isset($file->id)) {
				$reqdata->courseimageid = $file->id;
			}
		} else {
			$reqdata->courseimageid = "";
		}

		$course = [
            'tenantid' => 1,
			'coursename' => $reqdata->coursename,
			'courseintro' => $reqdata->courseintro,
			'coursedescription' => $reqdata->coursedescription,
			'courselevel' => $reqdata->courselevel,
			'coursetype' => $reqdata->coursetype,
			'courseimageid' => $reqdata->courseimageid,
			'instructorprofile' => $reqdata->instructorprofile
        ];

		$response = $this->coursemodel->saveCourse($course);

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

	public function getCourse()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_view')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourse([ 'id' => $reqdata->courseid ]);

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

	public function getCourseInstructors()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourseInstructors([ 'id' => $reqdata->courseid ]);

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

	public function updateCourse()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		if ($reqdata->courseimage != "") {

			$reqdata->courseimageid = 0;
			
			$file = $this->moveFile($reqdata->courseimage, 'courses');
			if (isset($file->id)) {
				$reqdata->courseimageid = $file->id;
			}
		} 

		$course = json_decode(json_encode($reqdata), true);

		$response = $this->coursemodel->updateCourse($course);

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

	public function updateCourseDescription()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$course = json_decode(json_encode($reqdata), true);
		
		$response = $this->coursemodel->updateCourseDescription($course);

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

	public function updateCourseInstructor()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$course = json_decode(json_encode($reqdata), true);
		
		$response = $this->coursemodel->updateCourseInstructor($course);

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

	public function updateCoursePaymentInfo()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$course = json_decode(json_encode($reqdata), true);
		
		$response = $this->coursemodel->updateCoursePaymentInfo($course);

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

	public function updateCourseStatus()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$status = 'I';
		if ($reqdata->status) { $status = 'A'; }

		$course = [
			'courseid' => $reqdata->courseid,
			'status' => $status
		];
		
		$response = $this->coursemodel->updateCourseStatus($course);

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

	public function deleteCourse() {
        if (!AuthController::auth() || !AuthController::hasPermissions('course_delete')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$course = [
			'courseid' => $reqdata->courseid,
		];
		
		$response = $this->coursemodel->deleteCourse($course);

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

	#sections
	public function getSection()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_view')) {
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

	public function saveSection()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
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

	public function updateSection()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
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

	public function deleteSection() {
        if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseSection([
            'id' => trim($reqdata->sectionid)
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
	public function getLesson()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_view')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourseLesson([ 'id' => $reqdata->lessonid ]);

		if ( $response->status == 200 ) {
			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'messages'  => '',
				'data' => $response->data
			]);
		} elseif ( $response->status == 402 ) {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'messages'  => $response->messages,
				'data' => $response->data->paymentinfo
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'messages'  => $response->messages,
				'data' => []
			]);
		}

		return $this->response;

	}

	public function getPreviousLesson()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_view')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCoursePreviousLesson([ 
			'courseid' => $reqdata->courseid, 
			'currentid' => $reqdata->currentid 
		]);

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

	public function getNextLesson()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_view')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourseNextLesson([ 
			'courseid' => $reqdata->courseid, 
			'currentid' => $reqdata->currentid 
		]);

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

	public function saveLesson()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();

		if ($reqdata->lessonmedia != "") {

			$reqdata->lessonmediaid = 0;
			
			$file = $this->moveFile($reqdata->lessonmedia, 'lessons');
			if (isset($file->id)) {
				$reqdata->lessonmediaid = $file->id;
			}
		} else {
			$reqdata->lessonmediaid = "";
		}

		$lesson = [
			'courseid' => $reqdata->courseid,
			'sectionid' => $reqdata->sectionid,
			'lessonname' => $reqdata->lessonname,
			'lessonduration' => $reqdata->lessonduration,
			'lessondescription' => $reqdata->lessondescription,
			'lessonmediaid' => $reqdata->lessonmediaid,
		];

		$response = $this->coursemodel->saveCourseLesson($lesson);

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
	
	public function updateLesson()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();

		if ($reqdata->lessonmedia != "") {

			$reqdata->lessonmediaid = 0;
			
			$file = $this->moveFile($reqdata->lessonmedia, 'lessons');
			if (isset($file->id)) {
				$reqdata->lessonmediaid = $file->id;
			}
		} 

		$lesson = json_decode(json_encode($reqdata), true);
		
		$response = $this->coursemodel->updateCourseLesson($lesson);
		
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

	public function updateLessonOrder()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
			$this->response->setJSON([ 
				'status' => 403,
				'redirect' => '',
				'message'  => "You don't have permission to access"
			]);

			return $this->response;
		}

		$reqdata = $this->request->getJSON();
		

		if ( !empty($reqdata->orderList) ) {

			$response = $this->coursemodel->updateCourseLessonOrder(['orderList' => $reqdata->orderList]);
		
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


		} else {
			$this->response->setJSON([ 
				'status' => 400,
				'redirect' => '',
				'message'  => "Invalid Request."
			]);
		}

        return $this->response;

	}

	public function deleteLesson() {
        if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseLesson([
            'id' => trim($reqdata->lessonid)
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
	
	public function uploadCourseImage()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_create')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		return $this->uploadFile();
	}

	public function uploadLessonMedia()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		return $this->uploadFile();
	}

	public function getCourseEnrollments()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll_users')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCourseEnrollments([ 'courseid' => $reqdata->courseid ]);

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

	public function saveCourseEnrollment()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll_users')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$enrollment = [
			'courseid' => $reqdata->courseid,
			'userid' => $reqdata->userid,
        ];

		$response = $this->coursemodel->saveCourseEnrollment($enrollment);

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

	public function deleteCourseEnrollment() {
        if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll_users')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->deleteCourseEnrollment([
            'id' => trim($reqdata->enrollmentid)
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

	public function acceptCourseEnrollment()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$coupon = json_decode(json_encode($reqdata), true);
		
		$response = $this->coursemodel->acceptCourseEnrollment($coupon);

		if ($response->status==200) {

			$this->response->setJSON([ 
				'status' => 200,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => $response->data
			]);

		} elseif ( $response->status == 402 ) {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'messages'  => $response->messages,
				'data' => $response->data->paymentinfo
			]);
		} else {
			$this->response->setJSON([ 
				'status' => $response->status,
				'redirect' => '',
				'message'  => $response->messages,
				'data' => []
			]);
		}

        return $this->response;

	}

	public function getCoursePayments()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_update')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$response = $this->coursemodel->getCoursePayments([ 'courseid' => $reqdata->courseid ]);

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

	public function createPaypalPaymentOrder() {
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();
	
		$data = [
			"intent" => "CAPTURE",
			"purchase_units" => [
				[
					"amount" => [
						"currency_code" => $reqdata->currency,
						"value" => $reqdata->amount
					]
				]
			]
		];

		$this->response->setJSON(Paypal::createOrder($data));


		return $this->response;
	}

	public function capturePaypalPaymentOrder() {
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$order = Paypal::captureOrder($reqdata->id);
		$jOrder = json_decode(json_encode($order));

		if ($jOrder->status=='COMPLETED') {
			
			$capture = $jOrder->purchase_units[0]->payments->captures[0];
			
			$payment = [
				'courseid'=> $reqdata->courseid,
                'subscriptionid' => 0,
                'orderreference' => $jOrder->id,
                'amount' => $capture->amount->value,
                'currency'=> $capture->amount->currency_code,
                'method' => 'paypal',
                'paidon' => $capture->create_time,
                'payerid' => $jOrder->payer->payer_id,
                'payername' => $jOrder->payer->name->given_name.' '.$jOrder->payer->name->surname,
                'payeremail' => $jOrder->payer->email_address,
                'payeraddress' => $jOrder->payer->address->country_code,
                'status' => $jOrder->status
			];

			$this->coursemodel->createCoursePayment($payment);
		}

		$this->response->setJSON($order);

		return $this->response;
	}

	public function captureAuthorizenetPaymentOrder() {
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();
		$coursePaymentInfo = $this->coursemodel->getCoursePayment(["courseid" => $reqdata->courseid]);

		$responseArray = []; $status = ""; $message = ""; $errors = []; $transactionResponse = [];
		
		if (isset($coursePaymentInfo->status) && $coursePaymentInfo->status == 200) {
			if ($coursePaymentInfo->data->courseprice != $reqdata->amount) {
				
				$errors['amount'] = "Invalid Amount";

			} else {
				#Use this method to authorize and capture a credit card payment.
				$order = Authorizenet::chargeCreditCard($reqdata);

				if ($order['status']=='Ok') {
					
					$payment = [
						'courseid'=> trim($reqdata->courseid),
				        'subscriptionid' => 0,
				        'orderreference' => $order['transactionResponse']['transactionID'],
				        'amount' => trim($reqdata->amount),
				        'currency'=> trim($reqdata->currency),
				        'method' => 'authorizenet',
				        'paidon' => time(),
				        'payerid' => $order['transactionResponse']['authCode'],
				        'payername' => $reqdata->firstname.' '.$reqdata->lastname,
				        'payeremail' => $reqdata->email,
				        'payeraddress' => $reqdata->address.' '.$reqdata->city.' '.$reqdata->state.' '.$reqdata->country.' '.$reqdata->zip,
				        'status' => $order['status']
					];

					$this->coursemodel->createCoursePayment($payment);
				}

				$status  = $order['status'];
				$message = $order['message'];
				$transactionResponse = $order['transactionResponse'];
			}
		} else {
			
			$status  = "Error";
			$message = "Invalid Request";
		}

		if ( !empty($errors) ) {
			$status  = "Invalid";
			$message = "Invalid Field Values";
		}

		$responseArray['status'] = $status;
        $responseArray['message'] = $message;
		$responseArray['errors'] = $errors;
		$responseArray['transactionResponse'] = $transactionResponse;

		$this->response->setJSON($responseArray);

		return $this->response;

	}

	public function generateEnrollmentCouponCode()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll_users')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$couponcode = $this->getCurrentMonth().$this->getCurrentDay().'-'.strtoupper(random_string('alpha', 6));
		return $this->response->setJSON([ 'status' => 200, 'data' => $couponcode]);

	}

	public function updateEnrollmentCouponCode()
	{
		if (!AuthController::auth() || !AuthController::hasPermissions('course_enroll_users')) {
            $this->response->setJSON([ 
                'status' => 403,
				'redirect' => '',
                'message'  => "You don't have permission to access"
            ]);

			return $this->response;
        }

		$reqdata = $this->request->getJSON();

		$coupon = json_decode(json_encode($reqdata), true);
		
		$response = $this->coursemodel->updateCourseEnrollmentCoupon($coupon);

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
				'message'  => $response->messages,
			]);
		}

        return $this->response;

	}

}