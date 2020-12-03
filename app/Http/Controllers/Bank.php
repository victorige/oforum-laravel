<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Bank extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enter(){
        $pager = Auth::user()->data;
        if($pager != 4){
            return redirect()->route('redirector');
        }

        $confirmbank = Auth::user()->confirmbank;
        if($confirmbank == 1){
            $accname = Auth::user()->accountname;
            $accnum = Auth::user()->accountnumber;
            $bankname = Auth::user()->bankname;

            return view('bank', ['pagetitle' => 'Bank Account Details', 'accname' => $accname, 'accnum' => $accnum, 'bankname' => $bankname, 'view' => 1]);

        }else{
            $banks = DB::table('banks')->get();
            return view('bank', ['pagetitle' => 'Bank Account Details', 'banks' => $banks, 'view' => 0]);
        }


    }




    public function confirm(Request $request){
        $bankcode=$request->input('bankcode');
        $bankacc=$request->input('bankacc');

        $arr =array(
            'recipientaccount' => "$bankacc",
            'destbankcode' => "$bankcode",
            'PBFPubKey' => env('FLWPUBK'),
        );

        $arr = json_encode($arr);
        $url = "https://api.ravepay.co/flwv3-pug/getpaidx/api/resolve_account";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $request = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($request, true);
        $responsecode = $result['data']['data']['responsecode'];
        echo $request;

        $accountnumber = $result['data']['data']['accountnumber'];
        $accountname = $result['data']['data']['accountname'];

        if($responsecode === 00 || $accountnumber != null || $accountname != null){

            $bankname = DB::table('banks')->where('code', $bankcode)->first();

            $uid = Auth::id();
            $affected = DB::update("update users set accountname = '$accountname' where id = ?", [$uid]);
            $affected = DB::update("update users set accountnumber = '$accountnumber' where id = ?", [$uid]);
            $affected = DB::update("update users set bankname = '$bankname->name' where id = ?", [$uid]);
            $affected = DB::update("update users set bankcode = '$bankcode' where id = ?", [$uid]);
            $affected = DB::update("update users set confirmbank = 1 where id = ?", [$uid]);
            return redirect()->route('redirector');

        }else{
            return $this->sendFailedResponse("Error: We couldn't verify your Account Details. Cross check your Details.");
        }



    }

    public function yes(){
        $uid = Auth::id();
        $pager = Auth::user()->data;
        if($pager != 4){
            return redirect()->route('redirector');
        }

        $length = 10;
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[random_int(0, $max-1)];
       }

       $checkcount = DB::table('users')->where('refercode', $token)->count();

       if($checkcount == 0){
       $affected = DB::update("update users set refercode = '$token' where id = ?", [$uid]);

        $affected = DB::update("update users set data = 5 where id = ?", [$uid]);
        return redirect()->route('redirector');
       }else{
        return $this->sendFailedResponse();
       }



    }

    public function no(){

        $uid = Auth::id();
        $pager = Auth::user()->data;
        if($pager != 4){
            return redirect()->route('redirector');
        }

        $affected = DB::update("update users set accountname = null where id = ?", [$uid]);
        $affected = DB::update("update users set accountnumber = null where id = ?", [$uid]);
        $affected = DB::update("update users set bankname = null where id = ?", [$uid]);
        $affected = DB::update("update users set bankcode = null where id = ?", [$uid]);
        $affected = DB::update("update users set confirmbank = 0 where id = ?", [$uid]);
        return redirect()->route('redirector');

    }

    public function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[random_int(0, $max-1)];
       }

       return $token;
   }




    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('enter.bank')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }


    /////////////////////////////////EDIT BANK///////////////////////////////////////

    public function editenter(){
        $pager = Auth::user()->data;
        if($pager != 5){
            return redirect()->route('redirector');
        }

        $confirmbank = isset($_GET["confirm"]);
        if($confirmbank == 1){
            $accname = Auth::user()->accountname;
            $accnum = Auth::user()->accountnumber;
            $bankname = Auth::user()->bankname;

            return view('editbank', ['pagetitle' => 'Edit Bank Account Details', 'accname' => $accname, 'accnum' => $accnum, 'bankname' => $bankname, 'view' => 1]);

        }else{
            $accnum = Auth::user()->accountnumber;
            $bankname = Auth::user()->bankname;
            $bankcode = Auth::user()->bankcode;
            $banks = DB::table('banks')->where('code', '!=', $bankcode )->get();
            return view('editbank', ['pagetitle' => 'Edit Bank Account Details', 'banks' => $banks, 'accnum' => $accnum, 'bankname' => $bankname, 'bankcode' => $bankcode, 'view' => 0]);
        }


    }




    public function editconfirm(Request $request){
        $bankcode=$request->input('bankcode');
        $bankacc=$request->input('bankacc');

        $arr =array(
            'recipientaccount' => "$bankacc",
            'destbankcode' => "$bankcode",
            'PBFPubKey' => env('FLWPUBK'),
        );

        $arr = json_encode($arr);
        $url = "https://api.ravepay.co/flwv3-pug/getpaidx/api/resolve_account";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $request = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($request, true);
        $responsecode = $result['data']['data']['responsecode'];
        echo $request;

        $accountnumber = $result['data']['data']['accountnumber'];
        $accountname = $result['data']['data']['accountname'];

        if($responsecode === 00 || $accountnumber != null || $accountname != null){

            $bankname = DB::table('banks')->where('code', $bankcode)->first();

            $uid = Auth::id();
            $affected = DB::update("update users set accountname = '$accountname' where id = ?", [$uid]);
            $affected = DB::update("update users set accountnumber = '$accountnumber' where id = ?", [$uid]);
            $affected = DB::update("update users set bankname = '$bankname->name' where id = ?", [$uid]);
            $affected = DB::update("update users set bankcode = '$bankcode' where id = ?", [$uid]);
            return redirect()->route('edit2.bank');

        }else{
            return $this->editsendFailedResponse("Error: We couldn't verify your Account Details. Cross check your Details.");
        }



    }




    protected function editsendFailedResponse($msg = null)
    {
        return redirect()->route('edit.bank')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }
}
