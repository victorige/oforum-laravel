<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentVerification extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function generate(){
        $txf = "mc" . uniqid();
        $uid = Auth::id();
        $affected = DB::update("update users set txf = '$txf' where id = ?", [$uid]);
    }

    public static function check()
    {
        $PAY_AMOUNT = env('PAY_AMOUNT');
        $FLWSECK = env('FLWSECK');
        $txf = Auth::user()->txf;

        $arr =array(
            'txref' => "$txf",
            'SECKEY' => "$FLWSECK"
        );

        $arr = json_encode($arr);
        $url = "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $request = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($request, true);

        if ($result['status'] === "success" && $result['data']['chargecode'] === "00") {
            if ($result['data']['amount'] === $PAY_AMOUNT) {
                $uid = Auth::id();
                $affected = DB::update("update users set data = 2 where id = ?", [$uid]);
                return redirect()->route('redirector');
            }

        }elseif($result['status'] === "success" && $result['data']['status'] === "success-pending-validation"){
            return redirect()->route('process.payment');
        }



    }













    public function cc(){

    $PAY_AMOUNT = env('PAY_AMOUNT');
        $FLWSECK = env('FLWSECK');
        $txf = Auth::user()->txf;

        $arr =array(
            'txref' => "mc5dc27b48245dd",
            'SECKEY' => "$FLWSECK"
        );

        $arr = json_encode($arr);
        $url = "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $request = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($request, true);

        echo $request;

        echo $result['status'];



    }
}
