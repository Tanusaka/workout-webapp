<?php
  
namespace App\Filters;
  
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use App\Controllers\App\AuthController;
  
class AuthGuard implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        try {

            // print_r('<pre>');print_r($arguments[0]);print_r('</pre>');die;
            
            #check is user logged in and has permissions to access
            // if ( !AuthController::auth() ) {
            //     // return Auth::getResponse(403);
            //     return;
            // }

            // AuthController::allows($arguments[0]);

            #check user has permissions to access
            if (  isset($arguments[0]) && !AuthController::allows($arguments[0]) ) {
                // return;
                // return Auth::getResponse(403);
            }

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return;
            // return Auth::getResponse(500);
        }
    }
  
    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}