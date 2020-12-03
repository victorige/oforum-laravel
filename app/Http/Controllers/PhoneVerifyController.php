<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneVerifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {

        $pager = Auth::user()->data;
        if($pager != 0){
            return redirect()->route('redirector');
        }

        return view('phone', ['pagetitle' => 'Enter Phone Number', ]);
    }



    public function enter(Request $request)
    {
        $request = $request->phone_number;
        $count_number = strlen($request);
        if($count_number != 11){
            return $this->sendFailedResponse("Invalid Phone Number.");
        }

        if ( preg_match('/\s/',$request) ){
            return $this->sendFailedResponse("Invalid Phone Number.");
        }

        $nne = substr($request, 1, 3);
        if($nne=='803'or$nne=='806'or$nne=='703'or$nne=='706'or$nne=='903'or$nne=='813'or$nne=='814'or$nne=='816'or$nne=='810'or$nne=='906'){
        $network = "MTN";
        }elseif ($nne=='805'or$nne=='807'or$nne=='705'or$nne=='905'or$nne=='811'or$nne=='815') {
        $network = "GLO";
        }elseif ($nne=='809'or$nne=='908'or$nne=='909'or$nne=='817'or$nne=='818'){
        $network = "9MOB";
        }elseif ($nne=='802'or$nne=='808'or$nne=='701'or$nne=='708'or$nne=='902'or$nne=='907'or$nne=='812'){
        $network = "AIR";
        }else{
            return $this->sendFailedResponse("Invalid Phone Number.");
        }

        $no = substr($request, 1);
        $country_code = "+234";
        $results = DB::table('users')->where('phone', $no)->count();

        if($results == 0){
            $uid = Auth::id();
            $affected = DB::update("update users set phone = $no where id = ?", [$uid]);
            $affected = DB::update("update users set country = $country_code where id = ?", [$uid]);
            $affected = DB::update("update users set data = 1 where id = ?", [$uid]);
            return redirect()->route('redirector');
        }else{
            return $this->sendFailedResponse("Phone number already exist.");
        }

    }

    protected function callback(Request $request)
    {
        $code=$request->input('code');
        $state=$request->input('state');
        $fapp=env('ACCOUNTKIT_APP_ID');
        $fsec=env('ACCOUNTKIT_APP_SECRET');

        if($state == 'zinoly'){
            $url = "https://graph.accountkit.com/v1.2/access_token?grant_type=authorization_code&code=".$code."&access_token=AA|$fapp|$fsec";
            $get = json_decode(file_get_contents($url),true);
            $code =  $get['access_token'];
            $verify_url = "https://graph.accountkit.com/v1.2/me/?access_token=".$code."";
            $verify = json_decode(file_get_contents($verify_url),true);
            $id = "".$verify['id']."";
            $country_code = "+".$verify['phone']['country_prefix']."";
            $no =  "".$verify['phone']['national_number']."";

            if($verify != null){

                $results = DB::table('users')->where('phone', $no)->count();

                if($results == 0){
                    if($country_code === "+234"){
                    $uid = Auth::id();
                    $affected = DB::update("update users set phone = $no where id = ?", [$uid]);
                    $affected = DB::update("update users set phoneid = $id where id = ?", [$uid]);
                    $affected = DB::update("update users set country = $country_code where id = ?", [$uid]);
                    $affected = DB::update("update users set data = 1 where id = ?", [$uid]);
                    return redirect()->route('redirector');
                    }else{
                        return $this->sendFailedResponse("Verify with a Nigerian Phone Number Only.");
                    }
                }else{
                    return $this->sendFailedResponse("Phone number already exist.");
                }


            }else{
                return $this->sendFailedResponse();
            }

        }else{
            return $this->sendFailedResponse();
        }

    }


    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('verify.phone')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }


}
