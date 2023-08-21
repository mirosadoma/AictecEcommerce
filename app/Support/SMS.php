<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class SMS {

    // (new \App\Support\SMS)->setPhone()->SetMessage()->build()

    // ============================= //
    protected $vendorUrl    = "https://www.msegat.com/gw"; // SMS Vendor Url
    protected $userName     = ""; // SMS userName
    protected $apiKey       = ""; // SMS apiKey
    protected $sender       = ""; // SMS Sender
    // ============================= //
    protected $message      = ""; // Message Text
    protected $phone        = ""; // Phone Number

    public function __construct() {
        $this->userName  = env("SEND_USERNAME");
        $this->apiKey    = env("SEND_APIKEY");
        $this->sender    = env("SEND_SENDER");
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function getFields() {
        $fields = [
            "userName"      =>  $this->userName,
            "apiKey"        =>  $this->apiKey,
            "numbers"       =>  $this->phone,
            "userSender"    =>  $this->sender,
            "msg"           =>  $this->message,
            "msgEncoding"   =>  "UTF8",
            "timeToSend"    => "now",
        ];
        return $fields;
    }

    public function build() {
        if (env('SMS_ENABLED', 'true') == "true") {
            return Http::post($this->vendorUrl."/sendsms.php", $this->getFields())->json();
        } else {
            return true;
        }
    }
}
