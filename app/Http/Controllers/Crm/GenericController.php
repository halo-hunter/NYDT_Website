<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\PaymentSettings;
use App\Models\Crm\SmsLog;
use App\Models\Crm\TwilioApiDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class GenericController extends Controller
{
    public static function anet_charge_credit_card($data) {

        $data = (object) $data;

        if (!config('app.allow_direct_card_entry', false)) {
            return (object) [
                'code' => 0,
                'message' => 'Direct card entry is disabled. Please use hosted/tokenized payment flow.',
            ];
        }

        $amount = (float) $data->amount;

        $card_number = (integer) $data->card_number;
        $expiration_date = (string) $data->expiration_date; // TODO: Anet expiration_date format: YYYY-MM
        $card_code = (integer) $data->card_code;

        $invoice_number = (integer) $data->invoice_number; // TODO: Anet incoice number: unique
        $description = (string) $data->description; // TODO: Anet order or transaction desctiprion

        $firstname = (string) $data->firstname;
        $lastname = (string) $data->lastname;

        $type = (string) $data->type; // TODO: Anet default type:  individual
        $customer_id = (integer) $data->customer_id;

        if (
            $amount == '' ||
            $card_number == '' ||
            $expiration_date == '' ||
            $card_code == '' ||
            $invoice_number == '' ||
            $description == '' ||
            $firstname == '' ||
            $lastname == '' ||
            $type == '' ||
            $customer_id == ''
        ) {
            return 'some parameter is missing!';
            exit();
        }

        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        // $merchantAuthentication->setName(config('app.merchant_login_id')); // SANDBOX
        // $merchantAuthentication->setTransactionKey(config('app.merchant_transaction_key')); // SANDBOX
        $merchantAuthentication->setName(PaymentSettings::first()->merchant_login_id); // PRODUCTION
        $merchantAuthentication->setTransactionKey(PaymentSettings::first()->merchant_transaction_key); // PRODUCTION

        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card_number);
        $creditCard->setExpirationDate($expiration_date);
        $creditCard->setCardCode($card_code);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($invoice_number);
        $order->setDescription($description);

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($firstname);
        $customerAddress->setLastName($lastname);
//        $customerAddress->setCompany("Souveniropolis");
//        $customerAddress->setAddress("14 Main Street");
//        $customerAddress->setCity("Pecan Springs");
//        $customerAddress->setState("TX");
//        $customerAddress->setZip("44628");
//        $customerAddress->setCountry("USA");

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType($type);
        $customerData->setId($customer_id);
        //$customerData->setEmail("EllenJohnson@example.com");

        // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        $merchantDefinedField1 = new AnetAPI\UserFieldType();
        $merchantDefinedField1->setName("customerLoyaltyNum");
        $merchantDefinedField1->setValue("1128836273");

        $merchantDefinedField2 = new AnetAPI\UserFieldType();
        $merchantDefinedField2->setName("favoriteColor");
        $merchantDefinedField2->setValue("blue");

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        $transactionRequestType->addToUserFields($merchantDefinedField1);
        $transactionRequestType->addToUserFields($merchantDefinedField2);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);


//        if ($response != null) {
//            // Check to see if the API request was successfully received and acted upon
//            if ($response->getMessages()->getResultCode() == "Ok") {
//                // Since the API request was successful, look for a transaction response
//                // and parse it to display the results of authorizing the card
//                $tresponse = $response->getTransactionResponse();
//
//                if ($tresponse != null && $tresponse->getMessages() != null) {
//                    echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
//                    echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
//                    echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
//                    echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
//                    echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
//                } else {
//                    echo "Transaction Failed \n";
//                    if ($tresponse->getErrors() != null) {
//                        echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
//                        echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
//                    }
//                }
//                // Or, print errors if the API request wasn't successful
//            } else {
//                echo "Transaction Failed \n";
//                $tresponse = $response->getTransactionResponse();
//
//                if ($tresponse != null && $tresponse->getErrors() != null) {
//                    echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
//                    echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
//                } else {
//                    echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
//                    echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
//                }
//            }
//        } else {
//            echo  "No response returned \n";
//        }

        // return $response;

        $tresponse = $response->getTransactionResponse();

        if ($response->getMessages()->getResultCode() == "Ok") {
            $transaction_id = $tresponse->getTransId();
            $data = [
                'code' => 1,
                'transaction_id' => $transaction_id,
                'message' => "Successfully created transaction with Transaction ID: " . $transaction_id
            ];
        } else {
            $data = [
                'code' => 0,
                'message' => $tresponse->getErrors()[0]->getErrorText()
            ];
        }

        $data = (object) $data;

        return $data;
    }

    public static function anet_get_transaction_details($transaction_id) {

        $transactionId = (integer) $transaction_id;

        if ($transaction_id == '') {
            return 'some parameter is missing!';
            exit();
        }

        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        // $merchantAuthentication->setName(config('app.merchant_login_id')); // SANDBOX
        // $merchantAuthentication->setTransactionKey(config('app.merchant_transaction_key')); // SANDBOX
        $merchantAuthentication->setName(PaymentSettings::first()->merchant_login_id); // PRODUCTION
        $merchantAuthentication->setTransactionKey(PaymentSettings::first()->merchant_transaction_key); // PRODUCTION

        // Set the transaction's refId
        $refId = 'ref' . time();

        $request = new AnetAPI\GetTransactionDetailsRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setTransId($transactionId);

        $controller = new AnetController\GetTransactionDetailsController($request);

        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);

//        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
//        {
//            echo "SUCCESS: Transaction Status:" . $response->getTransaction()->getTransactionStatus() . "\n";
//            echo "                Auth Amount:" . $response->getTransaction()->getAuthAmount() . "\n";
//            echo "                   Trans ID:" . $response->getTransaction()->getTransId() . "\n";
//        }
//        else
//        {
//            echo "ERROR :  Invalid response\n";
//            $errorMessages = $response->getMessages()->getMessage();
//            echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
//        }

        //return $response;

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            $data = [
                'code' => 1,
                'transaction_status' => $response->getTransaction()->getTransactionStatus(),
                'transaction_amount' => $response->getTransaction()->getAuthAmount(),
                'transaction_id' => $response->getTransaction()->getTransId()
            ];
        } else {
            $data = [
                'code' => 0,
            ];
        }

        $data = (object) $data;

        return $data;
    }

    public static function twilio_send_sms($client_id, $case_id = null, $note_id = false, $phone_number, $text) {
        $param_to = (integer) $phone_number;
        $param_message_text = (string) $text;
        $to = '+' . preg_replace("/[^0-9]/", "", $param_to);
        $message_text = $param_message_text;
        if (App::environment('local', 'staging')) {
            $sid = config('app.twilio_test_dev_account_sid');
            $app_token = config('app.twilio_test_dev_app_token');
            $from_phone_number = '+' . config('app.twilio_test_dev_from_phone_number');
        } else {
            $sid = TwilioApiDetails::get()->first()->account_sid;
            $app_token = TwilioApiDetails::get()->first()->app_token;
            $from_phone_number = TwilioApiDetails::get()->first()->from_phone_number;
        }
        $response = Http::asForm()
            ->withBasicAuth($sid, $app_token)
            ->post("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json", [
                'To' => $to,
                'From' => $from_phone_number,
                'Body' => $message_text,
                'StatusCallback' => route('api_connections->twilio_status_callback'),
            ]);

        // dd($response->object());

        if (!property_exists($response->object(), 'code')) {
            SmsLog::insert([
                'client_id' => $client_id,
                'case_id' => $case_id,
                'note_id' => $note_id,
                'phone_number' => $phone_number,
                'message_test' => $param_message_text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return 'success';
        } else {
            return "fail";
        }
    }

    public static function format_phone_number_to_us_format($phone_number)
    {
        $cleaned = preg_replace('/[^0-9]/', '', $phone_number);

        if (strlen($cleaned) == 11 && substr($cleaned, 0, 1) == "1") {
            $cleaned = substr($cleaned, 1);
        }

        if (strlen($cleaned) == 10) {
            return '('.substr($cleaned, 0, 3).') '.substr($cleaned, 3, 3).'-'.substr($cleaned, 6);
        }

        return $phone_number;
    }

    public static function get_client_riders_email_addresses(int $client_id): array|bool
    {

        $client = Client::find($client_id);

        if (!$client) {
            return false;
        }

        $emails = $client->riders()->whereNotNull('email')->pluck('email')->toArray();

        return !empty($emails) ? $emails : false;

    }

    public static function get_client_riders_phone_numbers(int $client_id): array|bool
    {

        $client = Client::find($client_id);

        if (!$client) {
            return false;
        }

        $phones = $client->riders()->whereNotNull('phone')->pluck('phone')->toArray();

        return !empty($phones) ? $phones : false;

    }


}
