<?php
/**
 *
 * @author Samu
 */
namespace App\Libraries;


class Paypal {


    private static function getAccessToken() {

        $CI =& get_instance();
        
        $AUTHORIZATION = 'Authorization: Basic '.base64_encode($CI->appconfigs->PI_PP_CLIENT_ID.':'.$CI->appconfigs->PI_PP_CLIENT_SECRET);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded', $AUTHORIZATION
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        $jresponse = json_decode($response);

        // $_SESSION['paypal_accessToken'] = $jresponse->access_token;
        // $_SESSION['paypal_tokenexpiresat'] = time() + $jresponse->expires_in;
        
        return $jresponse->access_token;

    }

    private static function sendRequest($request='', $method='POST', $data=[]) {

        $curl = curl_init();

        $curlArray = array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com'.$request,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            // CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.self::getAccessToken()
            ),
        );

        if (isset($data) && !empty($data)) {
            // $curlArray['CURLOPT_POSTFIELDS'] = json_encode($data);
            $curlArray += array(CURLOPT_POSTFIELDS => json_encode($data));
        }
        
        curl_setopt_array($curl, $curlArray);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);

    }

    public static function createOrder($data=[])  {
        return self::sendRequest('/v2/checkout/orders', 'POST', $data);
    }

    public static function captureOrder($orderid='')  {
        return self::sendRequest('/v2/checkout/orders/'.$orderid.'/capture', 'POST');
    }

}

