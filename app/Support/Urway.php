<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use App\Models\Order;

class Urway {

    protected $apiURL = "https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest";

    public function set_payment_data($order, $user){
        $final_total = $order->final_total;
        if ($order->wallet > 0) {
            $final_total -= $order->wallet;
        }

        $terminalId = env("URWAY_TERMINALID");// Will be provided by URWAY
        $password = env("URWAY_PASSWORD");// Will be provided by URWAY
        $merchant_key = env("URWAY_MERCHANT_KEY");// Will be provided by URWAY

        $currencycode = "SAR";
        $amount = round($final_total,2);
        $idorder = $order->number;
        $ipp = get_server_ip();
        //Generate Hash
        $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
        $hash = hash('sha256', $txn_details);

        $data_array =  [
            'trackid'           => $idorder,
            "transid"           => "",
            'terminalId'        => $terminalId,
			'customerEmail'     => $user->email??" ",
            "address"           => "Riyadh",
            "city"              => "Riyadh",
            "state"             => "",
            "zipCode"           => "11611",
			'customerName'      => $user->name??" ",
			'customerIp'        => $ipp,
			'action'            => "12",
			'instrumentType'    => "DEFAULT",
			'merchantIp'        => $ipp,
			'password'          => $password,
			'currency'          => $currencycode,
			'country'           => "SA",
			'amount'            => $amount,
            "udf2"              => url('api/check_urway'),//Response page URL
            "udf3"              => "",
            "udf1"              => "",
            "udf5"              => "",
            "udf4"              => "",
			'tokenizationType'  => "1",
			'tokenOperation'    => "A",
			'cardToken'         => "",
			'requestHash'       => $hash  //generated Hash
        ];
        return $data_array;
    }

    public function verify_payment(){
        $terminalId = env("URWAY_TERMINALID");// Will be provided by URWAY
        $password = env("URWAY_PASSWORD");// Will be provided by URWAY
        $merchant_key = env("URWAY_MERCHANT_KEY");// Will be provided by URWAY

		if (request()->all() !== NULL) {
			$requestHash = "" . request('TranId') . "|" . $merchant_key . "|" . request('ResponseCode') . "|" . request('amount') . "";
			$hash = hash('sha256', $requestHash);
			if ($hash === request('responseHash')) {
				$txn_details1 = "" . request('TrackId') . "|" . $terminalId . "|" . $password . "|" . $merchant_key . "|" . request('amount') . "|SAR";
				//Secure check
				$requestHash1 = hash('sha256', $txn_details1);
				$apifields    = [
					'trackid' => request('TrackId'),
					'terminalId' => $terminalId,
					'action' => '10',
					'merchantIp' => "",
					'password' => $password,
					'currency' => "SAR",
					'transid' => request('TranId'),
					'amount' => request('amount'),
					// 'udf5' => "Authorization",
					'udf5' => "",
					'udf3' => "",
					'udf4' => "",
					'udf1' => "",
					'udf2' => "",
					'requestHash' => $requestHash1
                ];
				$apifields_string = json_encode($apifields);
				$ch  = curl_init($this->apiURL);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $apifields_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($apifields_string)
                    ]
				);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

				//execute post
				$apiresult = curl_exec($ch);
				$urldecodeapi        = (json_decode($apiresult, true));
				$inquiryResponsecode = $urldecodeapi['responseCode'];
				$inquirystatus       = $urldecodeapi['result'];

				if (request('Result') === 'Successful' && request('ResponseCode')==='000') {
					if($inquirystatus=='Successful' || $inquiryResponsecode=='000'){
                        return redirect('api/success_payment?order_number='.request('TrackId'));
					}else {
						echo "Something went wrong!!! Secure Check failed!!!!!!!";
					}
				} else {
                    return redirect('api/failed_payment');
				}
			} else {
				echo "Hash Mismatch!!!!!!!";
			}
		} else {
			echo "Something Went wrong!!!!!!!!!!!!";
		}
    }
    public function call_payment($data){
        $data = json_encode($data);
        $ch = curl_init($this->apiURL); // Will be provided by URWAY
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ]
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $server_output =curl_exec($ch);
        //close connection
        curl_close($ch);

        $result = json_decode($server_output);
        // if (!empty($result->payid) && !empty($result->targetUrl)) {
        //     $url = $result->targetUrl . '?paymentid=' .  $result->payid;
        //     // header('Location: '. $url, true, 307);//Redirect to Payment Page
        // }else{
        //     print_r($result);
        //     echo "<br/><br/>";
        //     print_r($data);
        //     die();
        // }
        return $result;
    }
}
