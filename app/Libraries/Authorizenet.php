<?php
/**
 *
 * @author Samu
 */
namespace App\Libraries;

use Vendor\Autoload;
use Vendor\Authorizenet\Autoload as AnetAutoload;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class Authorizenet {

    public static function chargeCreditCard($data)
    {
        $CI =& get_instance();

        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($CI->appconfigs->PI_AN_MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey($CI->appconfigs->PI_AN_MERCHANT_TRANSACTION_KEY);
        
        // $merchantAuthentication->setName('6m5MHe4uNK');
        // $merchantAuthentication->setTransactionKey('8GGpuqhP8655Z8xq');


        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber(trim($data->cnumber));
        $creditCard->setExpirationDate(trim($data->cexpdate));
        $creditCard->setCardCode(trim($data->ccode));

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        // $order->setInvoiceNumber("10101");
        $order->setDescription(trim($data->cdesc));

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName(trim($data->firstname));
        $customerAddress->setLastName(trim($data->lastname));
        // $customerAddress->setCompany("Souveniropolis");
        $customerAddress->setAddress(trim($data->address));
        $customerAddress->setCity(trim($data->city));
        $customerAddress->setState(trim($data->state));
        $customerAddress->setZip(trim($data->zip));
        $customerAddress->setCountry(trim($data->country));

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        // $customerData->setType("individual");
        // $customerData->setId("99999456654");
        $customerData->setEmail(trim($data->email));

        // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        // $merchantDefinedField1 = new AnetAPI\UserFieldType();
        // $merchantDefinedField1->setName("customerLoyaltyNum");
        // $merchantDefinedField1->setValue("1128836273");

        // $merchantDefinedField2 = new AnetAPI\UserFieldType();
        // $merchantDefinedField2->setName("favoriteColor");
        // $merchantDefinedField2->setValue("blue");

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount(trim($data->amount));
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        // $transactionRequestType->addToUserFields($merchantDefinedField1);
        // $transactionRequestType->addToUserFields($merchantDefinedField2);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        $responseArray = [];
        
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    
                    $responseArray['status'] = "Ok";
                    $responseArray['message'] = "Transaction approved";
                    $responseArray['transactionResponse'] = [
                        'transactionID' => $tresponse->getTransId(),
                        'responseCode'  => $tresponse->getResponseCode(),
                        'messageCode'   => $tresponse->getMessages()[0]->getCode(),
                        'authCode'      => $tresponse->getAuthCode(),
                        'errorCode'     => "", 
                        'message'       => $tresponse->getMessages()[0]->getDescription(),
                    ];
                } else {
                    $responseArray['status'] = "Error";
                    $responseArray['message'] = "Transaction Failed";
                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $responseArray['transactionResponse'] = [
                            'errorCode'     => $tresponse->getErrors()[0]->getErrorCode(), 
                            'message'       => $tresponse->getErrors()[0]->getErrorText(),
                        ];
                    } else {
                        $responseArray['transactionResponse'] = [
                            'errorCode'     => $response->getMessages()->getMessage()[0]->getCode(),
                            'message'       => $response->getMessages()->getMessage()[0]->getText(),
                        ];
                    }
                }

            } else {

                $responseArray['status'] = "Error";
                $responseArray['message'] = "Transaction Failed";
                
                $tresponse = $response->getTransactionResponse();
            
                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $responseArray['transactionResponse'] = [
                        'errorCode'     => $tresponse->getErrors()[0]->getErrorCode(), 
                        'message'       => $tresponse->getErrors()[0]->getErrorText(),
                    ];
                } else {
                    $responseArray['transactionResponse'] = [
                        'errorCode'     => $response->getMessages()->getMessage()[0]->getCode(),
                        'message'       => $response->getMessages()->getMessage()[0]->getText(),
                    ];
                }
            }
        } else {
            $responseArray['status'] = "Error";
            $responseArray['message'] = "No Response Returned";
            $responseArray['transactionResponse'] = [];
        }

        return $responseArray;

    }

}

