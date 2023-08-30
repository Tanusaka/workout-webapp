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



$routes->get('/libraries/courses', 'App\CourseController::index');
$routes->get('/libraries/courses/create', 'App\CourseController::create');
$routes->post('/libraries/courses/save', 'App\CourseController::save');
$routes->post('/libraries/courses/update', 'App\CourseController::update');
$routes->post('/libraries/courses/delete', 'App\CourseController::delete');

$routes->post('/libraries/courses/upload/image', 'App\CourseController::upload_courseimage');
$routes->post('/libraries/courses/remove/image', 'App\CourseController::remove_courseimage');

$routes->get('/libraries/courses/view/(:num)', 'App\CourseController::get/$1');


$routes->post('/libraries/courses/get/overview', 'App\CourseController::get_overview');
$routes->post('/libraries/courses/get/contents', 'App\CourseController::get_contents');
$routes->post('/libraries/courses/get/instructors', 'App\CourseController::get_instructors');
$routes->post('/libraries/courses/get/reviews', 'App\CourseController::get_reviews');
$routes->post('/libraries/courses/get/followers', 'App\CourseController::get_followers');
$routes->post('/libraries/courses/get/settings', 'App\CourseController::get_settings');


$routes->get('/libraries/courses/instructors/forcourse/(:num)', 'App\CourseController::get_instructors_for_course/$1');
$routes->post('/libraries/courses/instructors/save', 'App\CourseController::save_instructor');
$routes->post('/libraries/courses/instructors/delete', 'App\CourseController::delete_instructor');


$routes->post('/libraries/courses/reviews/save', 'App\CourseController::save_review');
$routes->post('/libraries/courses/reviews/delete', 'App\CourseController::delete_review');


$routes->get('/libraries/courses/followers/forcourse/(:num)', 'App\CourseController::get_followers_for_course/$1');
$routes->post('/libraries/courses/followers/save', 'App\CourseController::save_follower');
$routes->post('/libraries/courses/followers/delete', 'App\CourseController::delete_follower');






$routes->post('/libraries/courses/content/section/get', 'App\CourseController::get_section');
$routes->post('/libraries/courses/content/section/save', 'App\CourseController::save_section');
$routes->post('/libraries/courses/content/section/update', 'App\CourseController::update_section');
$routes->post('/libraries/courses/content/section/delete', 'App\CourseController::delete_section');

$routes->post('/libraries/courses/content/section/lesson/get', 'App\CourseController::get_lesson');
$routes->post('/libraries/courses/content/section/lesson/save', 'App\CourseController::save_lesson');
$routes->post('/libraries/courses/content/section/lesson/update', 'App\CourseController::update_lesson');
$routes->post('/libraries/courses/content/section/lesson/delete', 'App\CourseController::delete_lesson');

$routes->post('/libraries/courses/content/section/lesson/upload', 'App\CourseController::upload_lesson');


$routes->get('/apps/chats', 'App\ChatController::index');


/*
 * --------------------------------------------------------------------
 * User Management Routes
 * --------------------------------------------------------------------
 */
$routes->get('/configs/user-management/users', 'App\UserController::index');
$routes->get('/configs/user-management/users/create', 'App\UserController::create');
$routes->post('/configs/user-management/users/save', 'App\UserController::save');
$routes->get('/configs/user-management/users/view/(:num)', 'App\UserController::get/$1');
$routes->post('/configs/user-management/users/updateprofile', 'App\UserController::update_profile');
$routes->post('/configs/user-management/users/updatepassword', 'App\UserController::update_password');
$routes->post('/configs/user-management/users/updaterole', 'App\UserController::update_role');


$routes->post('/configs/user-management/users/linkedprofiles/save', 'App\LinkedprofileController::saveLinkedProfile');
$routes->post('/configs/user-management/users/linkedprofiles/delete', 'App\LinkedprofileController::deleteLinkedProfile');


$routes->get('/configs/user-management/roles', 'App\RoleController::index');
$routes->get('/configs/user-management/roles/view/(:num)', 'App\RoleController::get/$1');
$routes->post('/configs/user-management/roles/permissions/update', 'App\RoleController::update_permissions');


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
