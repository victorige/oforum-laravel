<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Coupon extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enter(){
        $pager = Auth::user()->data;
        if($pager != 1){
            return redirect()->route('redirector');
        }

        return view('coupon', ['pagetitle' => 'Coupon Payment']);
    }

    public function verify(Request $request){
        $coupon=$request->input('coupon');
        $results = DB::table('coupon')->where('value', $coupon)->count();

        if($results == 1){
            $status = DB::table('coupon')->where('value', $coupon)->value('status');
            if($status == 0){
                $uid = Auth::id();

                $affected = DB::update("update coupon set status = 1 where value = ?", [$coupon]);
                $affected = DB::update("update users set coupon = 1 where id = ?", [$uid]);
                $affected = DB::update("update users set txf = '$coupon' where id = ?", [$uid]);
                $affected = DB::update("update users set data = 3 where id = ?", [$uid]);
                $affected = DB::update("update users set txfstatus = 1 where id = ?", [$uid]);
                return redirect()->route('redirector');


            }else{
                return $this->sendFailedResponse("Coupon has already been used.");
            }
        }else{
            return $this->sendFailedResponse("Coupon is invalid.");
        }


        return view('coupon', ['pagetitle' => 'Coupon Payment']);
    }


    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('coupon.payment')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }

    public static function generatecoupon(){
        $length = 7;
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[random_int(0, $max-1)];
       }

       $couponcount = DB::table('coupon')->count();

        return $token."C".$couponcount."U".Auth::user()->id;
    }

    public function buy(){
        $phoner = Auth::user()->phone;
        $presults = DB::table('user_coupon')->where('phone', $phoner)->count();
        if($presults != 1){
            return redirect()->route('redirector');
        }

        $pager = Auth::user()->data;
        if($pager != 5){
            return redirect()->route('redirector');
        }

        $coutrf = DB::table('user_coupon')->where('phone', $phoner)->first();
        $coutrf = $coutrf->pay_code;

        $arr =
            array('txref' => "$coutrf",
                'SECKEY' => env('FLWSECK')
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

        //return $this->generatecoupon();

        if ($result['status'] === "success" && $result['data']['chargecode'] === "00") {

        if($result['data']['amount'] == env('COUPON_PAY_AMOUNT')){
            $phiy = DB::table('coupon')->where('value', $coutrf)->count();
            if($phiy == 0){
                $insert = DB::table('coupon')->insert(
                    ['value' => $coutrf, 'status' => 0, 'user' => Auth::user()->id]
                );
            }
        }

            $code = $this->generatecoupon();
            $affected = DB::update("update user_coupon set pay_code = '$code' where phone = ?", [$phoner]);
            $processing = 0;
        }elseif($result['status'] === "success" && $result['data']['status'] === "success-pending-validation"){
            $processing = 0;
        }else{
            $code = $this->generatecoupon();
            $affected = DB::update("update user_coupon set pay_code = '$code' where phone = ?", [$phoner]);
            $processing = 0;
        }

        $coutrfx = DB::table('user_coupon')->where('phone', $phoner)->first();
        $coutrfx = $coutrfx->pay_code;




        $limit = 10;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $couponcodes = DB::table('coupon')
                ->where('user', Auth::user()->id)
                ->orderBy('ID', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('coupon')
                ->where('user', Auth::user()->id)
                ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;












        return view('buycoupon', ['pagetitle' => 'Buy Coupon', 'processing' => $processing, 'coutrfx' => $coutrfx, 'couponcodes' => $couponcodes, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, 'total_records' => $total_records,]);
    }
}
