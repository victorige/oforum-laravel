<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use DB;
use Illuminate\Http\Request;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // REGCOM
        $schedule->call(function () {
            $regcoms = DB::table('users')->where('data', 5)->where('regcom', 0)->limit(14)->get();

            foreach ($regcoms as $regcom) {

                $r_r = $regcom->referral;
                $r_s = $regcom->referstatus;
                if($r_r != null){
                    if($r_s == 0){
                        $checkrs = DB::table('users')->where('refercode', $r_r)->first();
                        $balance = $checkrs->balance + env('REFER_AMOUNT');
                        $affected = DB::update("update users set referstatus = 1 where id = ?", [$regcom->id]);
                        $affected = DB::update("update users set balance = '$balance' where id = ?", [$checkrs->id]);
                    }

                    $data = DB::table('data')->where('id', 1)->first();
                    if($regcom->coupon == 1){
                        $acash = $data->acash + 130;
                        $affected = DB::update("update data set acash = $acash where id = ?", [1]);
                    }else{
                        $acash = $data->acash + 180;
                        $affected = DB::update("update data set acash = $acash where id = ?", [1]);
                    }

                    $ceocash = $data->ceocash + 150;
                    $affected = DB::update("update data set ceocash = $ceocash where id = ?", [1]);

                }else{
                    $data = DB::table('data')->where('id', 1)->first();
                    if($regcom->coupon == 1){
                        $acash = $data->acash + 830;
                        $affected = DB::update("update data set acash = $acash where id = ?", [1]);
                    }else{
                        $acash = $data->acash + 880;
                        $affected = DB::update("update data set acash = $acash where id = ?", [1]);
                    }

                    $ceocash = $data->ceocash + 450;
                    $affected = DB::update("update data set ceocash = $ceocash where id = ?", [1]);

                }
            $affected = DB::update("update users set regcom = 1 where id = ?", [$regcom->id]);

            }
        })->everyMinute()->name('regcom')->withoutOverlapping();

        // VIEWS
        $schedule->call(function () {
            $limit = 14;
            $adata = DB::table('data')->where('id', 1)->first();
            $allow = $limit * env('READ_AMOUNT');

            if($adata->acash >= $allow){
                $views = DB::table('views')->where('status', 0)->where('type', 0)->limit($limit)->orderBy('id', 'desc')->get();
                foreach ($views as $view) {
                    $adata = DB::table('users')->where('id', $view->uid)->first();
                    $balance = $adata->balance + env('READ_AMOUNT');
                    $affected = DB::update("update users set balance = $balance where id = ?", [$view->uid]);
                    $zadata = DB::table('data')->where('id', 1)->first();
                    $zadata = $zadata->acash - env('READ_AMOUNT');
                    $affected = DB::update("update data set acash = $zadata where id = ?", [1]);

                    $affected = DB::update("update views set status = 1 where id = ?", [$view->id]);
                }
            }
        })->everyMinute()->name('views')->withoutOverlapping();

        // SHARE
        $schedule->call(function () {
            $limit = 14;
            $adata = DB::table('data')->where('id', 1)->first();
            $allow = $limit * env('SHARE_AMOUNT');

            if($adata->acash >= $allow){
                $views = DB::table('views')->where('status', 0)->where('type', 1)->limit($limit)->orderBy('id', 'desc')->get();
                foreach ($views as $view) {
                    $adata = DB::table('users')->where('id', $view->uid)->first();
                    $balance = $adata->balance + env('SHARE_AMOUNT');
                    $affected = DB::update("update users set balance = $balance where id = ?", [$view->uid]);
                    $zadata = DB::table('data')->where('id', 1)->first();
                    $zadata = $zadata->acash - env('SHARE_AMOUNT');
                    $affected = DB::update("update data set acash = $zadata where id = ?", [1]);

                    $affected = DB::update("update views set status = 1 where id = ?", [$view->id]);
                }
            }
        })->everyMinute()->name('views')->withoutOverlapping();

        // SEND PAYMENT
        $schedule->call(function () {
            $pdata = DB::table('data')->where('id', 1)->first();
            if($pdata->paymentpause == 0){
                if($pdata->systempaymentpause == 0){
                    $this->sendpayout();
                }
            }
        })->everyMinute()->name('send-payment')->withoutOverlapping();

        // PAYMENT STATUS
        $schedule->call(function () {
            $this->paymentstatus(1);
        })->everyMinute()->name('d-payment-status')->withoutOverlapping();
        $schedule->call(function () {
            $this->paymentstatus(2);
        })->everyMinute()->name('a-payment-status')->withoutOverlapping();

        // SEND AGENT PAYMENT
        $schedule->call(function () {
            $pdata = DB::table('data')->where('id', 1)->first();
            if($pdata->paymentpause == 0){
                if($pdata->systempaymentpause == 0){
                    $this->agentsendpayout();
                }
            }
        })->everyMinute()->name('agent-send-payment')->withoutOverlapping();

        // AGENT PAYMENT STATUS
        $schedule->call(function () {
            $this->agentpaymentstatus(1);
        })->everyMinute()->name('agent-d-payment-status')->withoutOverlapping();
        $schedule->call(function () {
            $this->agentpaymentstatus(2);
        })->everyMinute()->name('agent-a-payment-status')->withoutOverlapping();


        // DAILY
        $schedule->call(function () {
            $this->daily();
            $this->agentcommsion();
        })->daily()->name('daily')->withoutOverlapping()->timezone('Africa/Lagos');
        $schedule->call(function () {
            $affected = DB::update("update data set systempaymentpause = 0 where id = ?", [1]);
        })->dailyAt('7:00')->name('7daily')->withoutOverlapping()->timezone('Africa/Lagos');

        // LIVESCORE
        $schedule->call(function () {
            //$this->livescore();
        })->everyMinute()->name('livescore1');





    }






    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }



    protected function daily(){
        $daily = DB::table('data')->where('id', 1)->first();
        $daily = $daily->daily + 1;
        $affected = DB::update("update data set daily = $daily where id = ?", [1]);
    }


    protected function paymentstatus($rew){
        if($rew == 1){
            $sendpayouts = DB::table('payout')->where('init', 1)->where('status', 0)->orderBy('ID', 'DESC')->limit(14)->get();
        }else{
            $sendpayouts = DB::table('payout')->where('init', 1)->where('status', 0)->orderBy('ID', 'ASC')->limit(14)->get();
        }


        foreach ($sendpayouts as $sendpayout) {
            $code = $sendpayout->try.$sendpayout->code;
            $sec = env('FLWSECK');

            $url = "https://api.ravepay.co/v2/gpx/transfers?seckey=$sec&reference=$code";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            $request = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($request, true);
            $status = $result['data']['transfers'][0]['status'];
            $com_reason = $result['data']['transfers'][0]['complete_message'];
            $date_created = $result['data']['transfers'][0]['date_created'];
            if($status == 'SUCCESSFUL'){
                $affected = DB::update("update payout set status = 1 where id = ?", [$sendpayout->id]);

            }

            if($status == 'FAILED'){
                $date_pastz = time() - strtotime($date_created);
                $date_past = $date_pastz / 3600;
                if($date_past >= 30){
                    $affected = DB::update("update payout set init = 0 where id = ?", [$sendpayout->id]);
                    $try = $sendpayout->try + 1;
                    $affected = DB::update("update payout set try = $try where id = ?", [$sendpayout->id]);
                    $affected = DB::update("update payout set status = 0 where id = ?", [$sendpayout->id]);
                }
            }

              if($com_reason == "DISBURSE FAILED: You have exceeded your daily limit for this product"){
                $affected = DB::update("update data set systempaymentpause = 1 where id = ?", [1]);
              }

              if($com_reason == "DISBURSE FAILED: You have exceeded your daily frequency for this product"){
                $affected = DB::update("update data set systempaymentpause = 1 where id = ?", [1]);
              }

            }

    }


    protected function sendpayout(){
        $sendpayouts = DB::table('payout')->where('init', 0)->where('status', 0)->limit(1)->get();
        foreach ($sendpayouts as $sendpayout) {
            $bamount = $sendpayout->amount + $sendpayout->charges;
            $arr = array(
                'currency' => 'NGN',
                'seckey' => env('FLWSECK'));
            $arr = json_encode($arr);
            $url = "https://api.ravepay.co/v2/gpx/balance";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            $request = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($request, true);
            $balance = $result['data']['AvailableBalance'];

            if($balance >= $bamount){
                $arr = array(
                    "account_bank" => "$sendpayout->b_code",
                    "account_number" => "$sendpayout->a_num",
                    "amount" => $sendpayout->amount,
                    "seckey" => env('FLWSECK'),
                    "narration" => env('APP_NAME'),
                    "currency" => "NGN",
                    "reference"=> $sendpayout->try.$sendpayout->code,
                    );

                    $arr = json_encode($arr);
                $url = "https://api.ravepay.co/v2/gpx/transfers/create";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
                $request = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($request, true);
                if($result['status'] == 'success'){
                    $affected = DB::update("update payout set init = 1 where id = ?", [$sendpayout->id]);
                    $sec = env('FLWSECK');

                    $url = "https://api.ravepay.co/v2/gpx/transfers?seckey=$sec&reference=$sendpayout->try$sendpayout->code";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
                    $request = curl_exec($ch);
                    curl_close($ch);
                    $result = json_decode($request, true);
                    $time = $result['data']['transfers'][0]['date_created'];
                    $affected = DB::update("update payout set created = '$time' where id = ?", [$sendpayout->id]);
                }
            }else{
                $affected = DB::update("update payout set init = 0 where id = ?", [$sendpayout->id]);
                $try = $sendpayout->try + 1;
                $affected = DB::update("update payout set try = $try where id = ?", [$sendpayout->id]);
                $affected = DB::update("update payout set status = 0 where id = ?", [$sendpayout->id]);

            }


        }

    }

    protected function agentpaymentstatus($rew){
        if($rew == 1){
            $sendpayouts = DB::table('agentpayout')->where('init', 1)->where('status', 0)->orderBy('ID', 'DESC')->limit(14)->get();
        }else{
            $sendpayouts = DB::table('agentpayout')->where('init', 1)->where('status', 0)->orderBy('ID', 'ASC')->limit(14)->get();
        }


        foreach ($sendpayouts as $sendpayout) {
            $code = $sendpayout->try.$sendpayout->code;
            $sec = env('FLWSECK');

            $url = "https://api.ravepay.co/v2/gpx/transfers?seckey=$sec&reference=$code";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            $request = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($request, true);
            $status = $result['data']['transfers'][0]['status'];
            $com_reason = $result['data']['transfers'][0]['complete_message'];
            $date_created = $result['data']['transfers'][0]['date_created'];
            if($status == 'SUCCESSFUL'){
                $affected = DB::update("update agentpayout set status = 1 where id = ?", [$sendpayout->id]);

            }

            if($status == 'FAILED'){
                $date_pastz = time() - strtotime($date_created);
                $date_past = $date_pastz / 3600;
                if($date_past >= 30){
                    $affected = DB::update("update agentpayout set init = 0 where id = ?", [$sendpayout->id]);
                    $try = $sendpayout->try + 1;
                    $affected = DB::update("update agentpayout set try = $try where id = ?", [$sendpayout->id]);
                    $affected = DB::update("update agentpayout set status = 0 where id = ?", [$sendpayout->id]);
                }
            }

              if($com_reason == "DISBURSE FAILED: You have exceeded your daily limit for this product"){
                $affected = DB::update("update data set systempaymentpause = 1 where id = ?", [1]);
              }

              if($com_reason == "DISBURSE FAILED: You have exceeded your daily frequency for this product"){
                $affected = DB::update("update data set systempaymentpause = 1 where id = ?", [1]);
              }

            }

    }

    protected function agentsendpayout(){
        $sendpayouts = DB::table('agentpayout')->where('init', 0)->where('status', 0)->limit(1)->get();
        foreach ($sendpayouts as $sendpayout) {
            $bamount = $sendpayout->amount + $sendpayout->charges;
            $arr = array(
                'currency' => 'NGN',
                'seckey' => env('FLWSECK'));
            $arr = json_encode($arr);
            $url = "https://api.ravepay.co/v2/gpx/balance";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            $request = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($request, true);
            $balance = $result['data']['AvailableBalance'];

            if($balance >= $bamount){
                $arr = array(
                    "account_bank" => "$sendpayout->b_code",
                    "account_number" => "$sendpayout->a_num",
                    "amount" => $sendpayout->amount,
                    "seckey" => env('FLWSECK'),
                    "narration" => env('APP_NAME')." Agent",
                    "currency" => "NGN",
                    "reference"=> $sendpayout->try.$sendpayout->code,
                    );

                    $arr = json_encode($arr);
                $url = "https://api.ravepay.co/v2/gpx/transfers/create";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
                $request = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($request, true);
                if($result['status'] == 'success'){
                    $affected = DB::update("update agentpayout set init = 1 where id = ?", [$sendpayout->id]);
                    $sec = env('FLWSECK');

                    $url = "https://api.ravepay.co/v2/gpx/transfers?seckey=$sec&reference=$sendpayout->try$sendpayout->code";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
                    $request = curl_exec($ch);
                    curl_close($ch);
                    $result = json_decode($request, true);
                    $time = $result['data']['transfers'][0]['date_created'];
                    $affected = DB::update("update agentpayout set created = '$time' where id = ?", [$sendpayout->id]);
                }
            }else{
                $affected = DB::update("update agentpayout set init = 0 where id = ?", [$sendpayout->id]);
                $try = $sendpayout->try + 1;
                $affected = DB::update("update agentpayout set try = $try where id = ?", [$sendpayout->id]);
                $affected = DB::update("update agentpayout set status = 0 where id = ?", [$sendpayout->id]);

            }


        }

    }

    protected function agentcommsion(){


        $axdata = DB::table('data')->where('id', 1)->first();

        $payout = $axdata->ceocash;

        if($payout >= 10000){
            $subagentcount = DB::table('user_coupon')->where('position', 1)->count();
            $mainagent = ceil(round($payout * 0.9)) - env('PAYOUT_CHARGE');
            $mainagent1 = ceil(round($payout * 0.9));
            $submoney = ceil(round(($payout - $mainagent1) / $subagentcount)) - env('PAYOUT_CHARGE');

            $agentsx = DB::table('user_coupon')->get();

            foreach ($agentsx as $agentx) {

                $agdata = DB::table('users')->where('id', $agentx->mainid)->first();

                if($agentx->position == 2){
                    DB::table('agentpayout')->insert(
                        [
                            'user' => $agdata->id,
                            'a_num' => $agdata->accountnumber,
                            'a_name' => $agdata->accountname,
                            'b_name' => $agdata->bankname,
                            'b_code' => $agdata->bankcode,
                            'amount' => $mainagent,
                            'charges' => env('PAYOUT_CHARGE'),
                            'code' => "AG".uniqid()."-id-".$agdata->id,
                            'init' => 0,
                            'try' => 0,
                            'status' => 0
                        ]
                    );

                }elseif($agentx->position == 1){
                    DB::table('agentpayout')->insert(
                        [
                            'user' => $agdata->id,
                            'a_num' => $agdata->accountnumber,
                            'a_name' => $agdata->accountname,
                            'b_name' => $agdata->bankname,
                            'b_code' => $agdata->bankcode,
                            'amount' => $submoney,
                            'charges' => env('PAYOUT_CHARGE'),
                            'code' => "AG".uniqid()."-id-".$agdata->id,
                            'init' => 0,
                            'try' => 0,
                            'status' => 0
                        ]
                    );

                }

            $affected = DB::update("update data set ceocash = 0 where id = ?", [1]);

            }

        }

    }


    public function livescore(){

        $url = "https://api-football-v1.p.rapidapi.com/v2/fixtures/live";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-rapidapi-host: api-football-v1.p.rapidapi.com",
            "x-rapidapi-key: ac3666abccmshf6e11c6df4053fap1c86e0jsn582e94c1c942"
        ));
        $request = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
        }else {

            $request = str_replace("'", "", $request);
            $affected = DB::update("update livescore set json = '$request' where id = ?", [1]);

        }


    }



}
