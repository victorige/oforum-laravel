<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Payment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function optionview()
    {
        $pager = Auth::user()->data;
        if($pager != 1){
            return redirect()->route('redirector');
        }
        return view('option', ['pagetitle' => 'Payment Option']);
    }

    protected function option(Request $request)
    {
        $option=$request->input('option');
        if($option == 'coupon'){
            return redirect()->route('coupon.payment');
        }elseif ($option == 'flutterwave'){
            return redirect()->route('make.payment');
        }


    }




    public function make()
    {

        $pager = Auth::user()->data;
        if($pager != 1){
            return redirect()->route('redirector');
        }


        $uid = Auth::id();
        $FLWPUBK=env('FLWPUBK');
        $email = Auth::user()->email;
        $country = Auth::user()->country;
        $phone = Auth::user()->phone;
        $phone = $country.$phone;
        $amount = env('PAY_AMOUNT');
        $txf = Auth::user()->txf;
        if($txf == null){
            $txf = "mc" . uniqid();
            $affected = DB::update("update users set txf = '$txf' where id = ?", [$uid]);
            $txf = Auth::user()->txf;
        }

        $fname = Auth::user()->name;



        $PAY_AMOUNT = env('PAY_AMOUNT');
        $FLWSECK = env('FLWSECK');
        $txf = Auth::user()->txf;
        $txfstatus = Auth::user()->txfstatus;

        $arr =array(
            'txref' => "$txf",
            'SECKEY' => "$FLWSECK"
        );
/** check start */
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
            if ($result['data']['amount'] == $PAY_AMOUNT) {
                $uid = Auth::id();
                $affected = DB::update("update users set data = 2 where id = ?", [$uid]);
                return redirect()->route('redirector');
            }else{
                $txf = "mc" . uniqid();
                $affected = DB::update("update users set txf = '$txf' where id = ?", [$uid]);
                return redirect()->route('redirector');

            }

        }elseif($result['status'] === "success" && $result['data']['status'] === "success-pending-validation"){
            $uid = Auth::id();
            $affected = DB::update("update users set data = 2 where id = ?", [$uid]);
            return redirect()->route('process.payment');
        }
/** check end */


        return view('payment', ['pagetitle' => 'Online Payment', 'txfstatus' => $txfstatus, 'FLWPUBK' => $FLWPUBK, 'email' => $email, 'phone' => $phone, 'amount' => $amount, 'txf' => $txf, 'fname' => $fname]);
    }





    public function process(){


        $uid = Auth::id();

        $affected = DB::update("update users set data = 2 where id = ?", [$uid]);
        $affected = DB::update("update users set txfstatus = 0 where id = ?", [$uid]);

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

        $status = $result['status'];



        if($status === "success"){
            $txstatus = $result['data']['status'];
            if($txstatus === "successful"){

                if ($result['data']['amount'] == $PAY_AMOUNT) {

                $affected = DB::update("update users set data = 3 where id = ?", [$uid]);
                $affected = DB::update("update users set txfstatus = 1 where id = ?", [$uid]);
                return redirect()->route('redirector');
            }else{
                $txf = "mc" . uniqid();
                $affected = DB::update("update users set txf = '$txf' where id = ?", [$uid]);
                $affected = DB::update("update users set data = 1 where id = ?", [$uid]);
                $affected = DB::update("update users set txfstatus = 2 where id = ?", [$uid]);
                return redirect()->route('redirector');
            }

            }elseif($txstatus === "success-pending-validation"){
                $pager = Auth::user()->data;
                if($pager != 2){
                    return redirect()->route('redirector');
                }
                return view('process', ['pagetitle' => 'Processing Payments']);
            }else{
                $affected = DB::update("update users set data = 1 where id = ?", [$uid]);
                $affected = DB::update("update users set txfstatus = 2 where id = ?", [$uid]);
                return redirect()->route('redirector');
                }

        }else{
                $affected = DB::update("update users set data = 1 where id = ?", [$uid]);
                $affected = DB::update("update users set txfstatus = 2 where id = ?", [$uid]);
                return redirect()->route('redirector');
        }



    }


}
