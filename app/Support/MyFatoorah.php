<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use App\Models\Order;

class MyFatoorah {

    // protected $token  = "rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL";
    // protected $token  = "TRZFiGLhLADeXowYgLY6Ivp14FX7RBIE1k71K2WBsof2xigbuISCVrHBJAMfofNVBt5M9ZgWgNStBt5NjKQOK81lWja9EU8AxUOdpme7YVWvvQQKUSDv37QSEdkWNbaAEqtGLxMKTnXuEv3apQp292VskgfsOF0VAg7V2EdpR0ir3qBiiLg-g8vdoFgmkMyBSSt9RWqQbrCILEYU_-aRkKCPNJHj_dJqNOdFUGKOhhLzJ9MKQc7XAGDuhK_8-rOVDlo5rSOGVAAm0UC7VABrby_PL4-7VeonQ78Mt49Y24yElfnZ51lgS4b44BQuwh02W0_dOZA2oBFnM3Ujm4Z42l0dMGRMGgTYeq4kPqR6rzFaK1hfHi6HlmZWTZnoZ8BwSKLvJVwj6mR9fm0_ClGYS3PtPA1Ix7R2zMp_1qcbug33NiO9qPMZC61yxDwwru7Dt7XvwY90dhiMk2Uv1Y_5ZaEAtNhyqejWG419iuiNS-2aKht-je0rT7xbH1cm1-vF5Xn3haOEJPWESGjYY90F4lbd2Gh8PvvhKGDJrgsUa4hcxA_hhU2YfdoEAO5dgEUYbGNRhFjKGXMTPZUB2zgUc8ATavQ0kx-M6-4wVl66YHz3Bc-ipil7t16wjMDVrv6cYDxyxNjDSBnFHenK1p6xYdkPnbvjDctsR269V-6h52wG8K4SRVpfIAOrB9C0hH_fFMKKP0EG2q2SmK56dvEvfvO0jEKuvXyBiFx53A1yVQGHEB4b";
    protected $token  = "TkmHI8fl-UaVZBOM6o9QiT_giKy5krPm2vAHp4eTqtanFBtSJZrftx7LNd69K_RDZemLKlHktgEbwI0YkzDGy_N2NabFr2k5Zdjq8Mcn8DaJBhe37Z8OwCcX_0fcnRvqniE5zaephIKen-OMw-VpfjHjp1-pmsjy_QbikDesdrFLazxKFVOHw_GjqMLAbpF80jYoBJL4L1gASssjLFrYiTGuIrUwgbZ6X-lys5CfgAFluFMOec6DHcomAdfmMq5SvMZY8EbScbT308QK-YxKbxYOKDhviA-iuxukkm8FNsbGLPLBNHwCUArd8mC1I4YL1uQleoUVfagYOnzVr-TPivb30LSxHee_Hdty36WEJlLQYCDQAwprVmtXvulLsnNYYUOcwJqgEe0MW2M0Yn57IOp0rXapNBakCzHBN23G3s94kqEk12Btxv7C6tMCyk5o_xNexdXMFSfbIefmCjIQLLomzOLy4W_LVz-M2e_lZHgEL1IMF5UVioH5BLs1edOB1oMc_fWU9GCwjKbzNSiA65lcqrGg_6gcEFVU_yS3bMmHY6TGtt6a89_bFlqokQOMv6KFFczD5B8aiPwRo2y1B1VNytaWFlV3JGwdMlTNVDClYum71cj9zazsXDAXVfssygXxFmnyYCYcztgwUCBE1UvYyRJsPzgd6Qw6loKVs8hsXH4TilrNrJsMR735QioUtRfPOntB1bApzpZ2mpCCdNwLzig2A3lrRYyQHku0uncAD4mK";
    protected $apiURL = "https://apitest.myfatoorah.com";
    protected $fields = [];

    public function __construct() {
        if(env("MYFATOORA_LIVE")) {
            $this->token    = env("MYFATOORA_TOKEN");
            $this->apiURL   = "https://api-sa.myfatoorah.com/";
        }
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }


    public function setData(Order $order) {
        $total = ($order->total == 0) ? 1 : $order->total;
        $this->fields = [
            'CustomerName'       => $order->user->username,
            'NotificationOption' => 'All',
            'MobileCountryCode'  => '966',
            'CustomerMobile'     => substr($order->user->phone, 3),
            'CustomerEmail'      => $order->user->email,
            'InvoiceValue'       => $total,
            'DisplayCurrencyIso' => 'SAR',
            'CallBackUrl'        => url("/api/callback"),
            'ErrorUrl'           => url("/api/callback"),
            'Language'           => 'en',
            'CustomerReference'  => $order->id,
            "Suppliers"=> [
                [
                  "SupplierCode"=> $order->store->storeRequest->SupplierCode,
                  "ProposedShare"=> ( ($total * 95) / 100 ),
                  "InvoiceShare"=> $total
                ]
              ]
        ];
        return $this;
    }

    public function getFields($data) {
        $this->fields = [
            'CustomerName'       => $data["username"],
            'NotificationOption' => 'All',
            'MobileCountryCode'  => '966',
            'CustomerMobile'     => substr($data['phone'], 3),
            'CustomerEmail'      => $data['email'],
            'InvoiceValue'       => $data["total"],
            'DisplayCurrencyIso' => 'SAR',
            'CallBackUrl'        => url("/dashboard/pplans/callback"),
            'ErrorUrl'           => url("/dashboard/pplans/callback"),
            'Language'           => 'en',
            'CustomerReference'  => $data["id"],
        ];
        return $this;
    }

    public function sendPayment() {
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])->post($this->apiURL."/v2/SendPayment",$this->fields)->json();
        if($data ["IsSuccess"] == false) {
            return [
                "status"      => $data["IsSuccess"],
                "message"     => $data["Message"],
            ];    
        }
        return [
            "status"      => $data["IsSuccess"],
            "invoiceId"   => $data["Data"]["InvoiceId"],
            "InvoiceURL"  => $data["Data"]["InvoiceURL"],
        ];
    }


    // ================================= //
    // ================================= //
    // ============ Supplier =========== //
    // ================================= //
    // ================================= //

    public function setSupplierData($fields) {
        $this->fields = $fields;
        return $this;
    }

    public function send() {
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])->post($this->apiURL."/v2/CreateSupplier",$this->fields)->json();
        if($data ["IsSuccess"] == false) {
            return [
                "status"      => $data["IsSuccess"],
                "message"     => $data["Message"],
            ];    
        }
        return [
            "status"            => $data["IsSuccess"],
            "SupplierCode"      => $data["Data"]["SupplierCode"],
        ];
    }

    public function makeRefund(\App\Models\Order $order) {
        
        $total = $order->total - $order->shipping_price - ( ($order->total * 5) / 100 );
        
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])->post($this->apiURL."//v2/MakeSupplierRefund",[
            "Key"       => $order->invoiceId,
            "KeyType"   => "invoiceid",
            "VendorDeductAmount"=> 0,
            "Comment"=> "Cancel By ".ucfirst($order->cancel_by),
            "Suppliers"=> [
                [
                "SupplierCode"=> $order->store->storeRequest->SupplierCode,
                "SupplierDeductedAmount"=> $total
                ]
            ]
        ])->json();
        return $data;
    }

    public function getSuppliers() {
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])->get($this->apiURL."/v2/GetSuppliers")->json();
        return $data;
    }
    
    public function getBanks() {
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])->get($this->apiURL."/v2/GetBanks")->json();
        return $data;
    }


    public function sendSupplierDocument($type,$file,$date = null,$SupplierCode) {
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])
        ->attach('FileUpload', file_get_contents(public_path("$file")), 'i.pdf')
        ->put($this->apiURL."/v2/UploadSupplierDocument",[
            // "FileUpload"        => file_get_contents(public_path("$file")),
            "FileType"          => "$type",
            "ExpireDate"        => "$date",
            "SupplierCode"      => "$SupplierCode",
        ])->json();
        return $data;
    } 

    // ================================================ //
    // ================================================ //
    // ================================================ //
    // ================================================ //
    public function callBack($paymentId) {
        $data = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type"  => "application/json"
        ])->post($this->apiURL."/v2/getPaymentStatus",[
            'KeyType' => 'PaymentId',
            'Key' => $paymentId,
        ])->json();
        return $data;
    }
}
