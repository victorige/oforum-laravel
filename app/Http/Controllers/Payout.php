<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Payout extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Request(){
        if(Auth::user()->balance >= env('MIN_PAYOUT')){
            return $this->process();
        }else{
            return $this->sendFailedResponse("You have not reached minimum payout.");
        }
    }


    protected function process()
    {
        $amount = Auth::user()->balance - env('PAYOUT_CHARGE');

        $affected = DB::update("update users set balance = 0 where id = ?", [Auth::id()]);

        DB::table('payout')->insert(
            [
                'user' => Auth::user()->id,
                'a_num' => Auth::user()->accountnumber,
                'a_name' => Auth::user()->accountname,
                'b_name' => Auth::user()->bankname,
                'b_code' => Auth::user()->bankcode,
                'amount' => $amount,
                'charges' => env('PAYOUT_CHARGE'),
                'code' => "PY".uniqid()."-id-".Auth::user()->id,
                'init' => 0,
                'try' => 0,
                'status' => 0
            ]
        );
        return $this->sendFailedResponse("Success: Your payout request was successful. Check Payout History for Status.");

    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('dashboard')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }

    public function history(){

        $uid = Auth::user()->id;

        $limit = 10;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $payouts = DB::table('payout')
                ->where('user', $uid)
                ->orderBy('ID', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('payout')
        ->where('user', $uid)
                ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;
        return view('payout', ['pagetitle' => 'Payout History', 'payouts' => $payouts, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, 'total_records' => $total_records]);
    }


    public function agent(){
        $phoner = Auth::user()->phone;
        $presults = DB::table('user_coupon')->where('phone', $phoner)->where('agentlist', '!=', 0)->count();
        if($presults != 1){
            return redirect()->route('redirector');
        }

        $uid = Auth::user()->id;

        $limit = 10;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $payouts = DB::table('agentpayout')
                ->where('user', $uid)
                ->orderBy('ID', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('agentpayout')
        ->where('user', $uid)
                ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;
        return view('agent', ['pagetitle' => 'Agent Payout History', 'payouts' => $payouts, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, 'total_records' => $total_records]);
    }


}
