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

	public function getUsersForEnroll()
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

		$response = $this->coursemodel->getUsersForEnroll([ 'courseid' => $reqdata->courseid ]);

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

	public function resetCourseEnrollments()
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

		$response = $this->coursemodel->resetCourseEnrollments([ 'courseid' => $reqdata->courseid ]);

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

	public function acceptEnrollment()
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

		$enrollment = [
			'id' => $reqdata->enrollmentid
        ];

		$response = $this->coursemodel->acceptCourseEnrollment($enrollment);

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

	public function createPaymentOrder() {
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

	public function capturePaymentOrder() {
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

}