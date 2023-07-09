<?php
/**
 *
 * @author Samu
 */
namespace App\Models\Core;

// use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class BaseModel 
{
    protected $apirequest;
    protected $method;
    protected $data;
    protected $httpHeader;

    public function apiGET($request, $data=[], $token=true)
    {
        $this->apirequest = $request;
        $this->method = "GET";
        $this->data = $data;

        $this->setHttpHeader($token);

        return $this->apiConnect();
    }

    public function apiPost($request, $data=[], $token=true)
    {
        $this->apirequest = $request;
        $this->method = "Post";
        $this->data = $data;

        $this->setHttpHeader($token);

        return $this->apiConnect();
    }

    private function setHttpHeader($token)
    {
        if ($token) {
            $this->httpHeader = array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$_SESSION['token']
            );
        } else {
            $this->httpHeader = array(
                "Content-Type: application/json"
            );
        }
    }

    
    /*******************************************************************************
     * Establish new connection with the application web service
     *
     * @return boolean
    *******************************************************************************/  
    private function apiConnect() 
    {
    	// $web_service_host = trim($this->config->item('app_auth_WEB_host'));
    	// $web_service_port = trim($this->config->item('app_auth_WEB_port'));
    	// $web_service_key  = trim($this->config->item('app_auth_WEB_key'));

        // $REQUEST_URL = $web_service_host.":".$web_service_port.$request;


        $REQUEST_URL = 'http://localhost:8888/trainerapp/api/public/'.$this->apirequest;

        $curl = curl_init();

        if (empty($this->data)) {

            curl_setopt_array($curl, array(

            // CURLOPT_PORT => $web_service_port,
            CURLOPT_URL => $REQUEST_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POSTFIELDS => "",            
            CURLOPT_HTTPHEADER => $this->httpHeader,

            ));
            
        } else {

            curl_setopt_array($curl, array(

            // CURLOPT_PORT => $web_service_port,
            CURLOPT_URL => $REQUEST_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POSTFIELDS => json_encode($this->data),            
            CURLOPT_HTTPHEADER => $this->httpHeader,

            ));
        }      

        $response = curl_exec($curl);

        if (!$response) {
        $response = 500;
        } 

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        $response = 500;
        }

        return $response;    
    }

}