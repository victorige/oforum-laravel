<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Referral extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enter(){
        $pager = Auth::user()->data;
        if($pager != 3){
            return redirect()->route('redirector');
        }

        if(isset($_COOKIE['link'])){
            $linkrefer = $_COOKIE['link'];
        }else{
            $linkrefer = null;
        }

        return view('refer', ['pagetitle' => 'Referral', 'linkrefer' => $linkrefer]);
    }

    public function verify(Request $request){
        $referral=$request->input('referral');
        $results = DB::table('users')->where('refercode', $referral)->count();

        if($results == 1){

            $uid = Auth::id();
            $referstatus = Auth::user()->referstatus;
            if($referstatus == 0){
                $affected = DB::update("update users set referral = '$referral' where id = ?", [$uid]);
                $affected = DB::update("update users set referstatus = 0 where id = ?", [$uid]);
                $affected = DB::update("update users set data = 4 where id = ?", [$uid]);
                return redirect()->route('redirector');


            }else{
                return $this->sendFailedResponse("An error occur contact support.");
            }
        }else{
            return $this->sendFailedResponse("Referral code doesn't exist.");
        }


        return view('coupon');
    }


    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('refer.enter')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }


    public function skip(){
        $uid = Auth::id();
        $affected = DB::update("update users set referral = null where id = ?", [$uid]);
        $affected = DB::update("update users set referstatus = 0 where id = ?", [$uid]);
        $affected = DB::update("update users set data = 4 where id = ?", [$uid]);
        return redirect()->route('redirector');
    }

    public function refer(){

        $appurl = env('APP_URL');

        $refercode = Auth::user()->refercode;

        $limit = 10;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $referrals = DB::table('users')
                ->where('referral', $refercode)
                ->orderBy('ID', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('users')
                ->where('referral', $refercode)
                ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;


        return view('referdetail', ['pagetitle' => 'Refer', 'referrals' => $referrals, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, 'total_records' => $total_records, 'refercode' => $refercode, 'appurl' => $appurl ]);
    }

}
