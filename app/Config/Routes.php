<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/error/403', 'App\ErrorController::error_403');

$routes->get('/', 'App\AuthController::index');
$routes->post('/auth/login', 'App\AuthController::login');
$routes->get('/auth/logout', 'App\AuthController::logout');

$routes->get('/dashboard', 'App\DashboardController::index');
$routes->get('/profile', 'App\UserController::getMyProfile');
$routes->post('/profile/view', 'App\UserController::getMyProfileView');
$routes->post('/profile/settings', 'App\UserController::getMyProfileSettings');
$routes->post('/profile/settings/update/password', 'App\UserController::updateUserPassword');
$routes->post('/profile/settings/update/description', 'App\UserController::updateUserDescription');
$routes->post('/profile/settings/update/profile', 'App\UserController::updateUserProfile');

$routes->post('/profile/settings/upload/profileimage', 'App\UserController::uploadProfileImage');

/*
 * --------------------------------------------------------------------
 * Course Management Routes
 * --------------------------------------------------------------------
 */
$routes->get('/libraries/courses', 'App\CourseController::index');
$routes->get('/libraries/courses/create', 'App\CourseController::create');
$routes->get('/libraries/courses/view/(:num)', 'App\CourseController::view/$1');

$routes->post('/libraries/courses/get/course', 'App\CourseController::getCourse');
$routes->post('/libraries/courses/get/section', 'App\CourseController::getSection');
$routes->post('/libraries/courses/get/lesson', 'App\CourseController::getLesson');
$routes->post('/libraries/courses/get/instructors', 'App\CourseController::getCourseInstructors');

$routes->post('/libraries/courses/save/course', 'App\CourseController::saveCourse');
$routes->post('/libraries/courses/update/course', 'App\CourseController::updateCourse');
$routes->post('/libraries/courses/update/course/description', 'App\CourseController::updateCourseDescription');
$routes->post('/libraries/courses/update/course/instructor', 'App\CourseController::updateCourseInstructor');

$routes->post('/libraries/courses/save/section', 'App\CourseController::saveSection');
$routes->post('/libraries/courses/update/section', 'App\CourseController::updateSection');
$routes->post('/libraries/courses/delete/section', 'App\CourseController::deleteSection');

$routes->post('/libraries/courses/save/lesson', 'App\CourseController::saveLesson');
$routes->post('/libraries/courses/update/lesson', 'App\CourseController::updateLesson');
$routes->post('/libraries/courses/delete/lesson', 'App\CourseController::deleteLesson');

$routes->post('/libraries/courses/upload/courseimage', 'App\CourseController::uploadCourseImage');
$routes->post('/libraries/courses/upload/lessonmedia', 'App\CourseController::uploadLessonMedia');

$routes->post('/libraries/courses/get/users/for/enroll', 'App\CourseController::getUsersForEnroll');
$routes->post('/libraries/courses/get/enrollments', 'App\CourseController::getCourseEnrollments');
$routes->post('/libraries/courses/reset/enrollments', 'App\CourseController::resetCourseEnrollments');
$routes->post('/libraries/courses/save/enrollment', 'App\CourseController::saveCourseEnrollment');
$routes->post('/libraries/courses/delete/enrollment', 'App\CourseController::deleteCourseEnrollment');
$routes->post('/libraries/courses/accept/enrollment', 'App\CourseController::acceptEnrollment');

// $routes->post('/libraries/courses/reviews/save', 'App\CourseController::save_review');
// $routes->post('/libraries/courses/reviews/delete', 'App\CourseController::delete_review');

/*
 * --------------------------------------------------------------------
 * Chat Management Routes
 * --------------------------------------------------------------------
 */

$routes->get('/apps/chats', 'App\ChatController::index');
$routes->get('/apps/chats/view/(:num)', 'App\ChatController::view/$1');
$routes->post('/apps/chats/save', 'App\ChatController::save');


/*
 * --------------------------------------------------------------------
 * User Management Routes
 * --------------------------------------------------------------------
 */

$routes->get('/configs/users', 'App\UserController::index');
$routes->get('/configs/users/view/(:num)', 'App\UserController::get/$1');

$routes->get('/configs/users/create', 'App\UserController::create');
$routes->post('/configs/users/save', 'App\UserController::save');

$routes->post('/configs/users/get/profile', 'App\UserController::getUserProfile');
$routes->post('/configs/users/get/settings', 'App\UserController::getUserSettings');

$routes->post('/configs/users/update/role', 'App\UserController::updateUserRole');

$routes->post('/configs/users/get/role/connections', 'App\UserController::getUserRoleConnections');
$routes->post('/configs/users/save/connection', 'App\UserController::saveUserConnection');
$routes->post('/configs/users/delete/connection', 'App\UserController::deleteUserConnection');

/*
 * --------------------------------------------------------------------
 * Role Management Routes
 * --------------------------------------------------------------------
 */
$routes->get('/configs/roles', 'App\RoleController::index');
$routes->get('/configs/roles/view/(:num)', 'App\RoleController::get/$1');
$routes->post('/configs/roles/update/permissions', 'App\RoleController::updatePermissions');


/*
 * --------------------------------------------------------------------
 * File Routes
 * --------------------------------------------------------------------
 */
$routes->get('/libraries/files', 'App\FileController::index');
$routes->post('/libraries/files/upload', 'App\FileController::upload');
$routes->post('/libraries/files/save', 'App\FileController::save');
$routes->post('/libraries/files/delete', 'App\FileController::delete');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
