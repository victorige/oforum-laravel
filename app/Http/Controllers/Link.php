<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Link extends Controller
{
    public function link($referid){
        setcookie("link", $referid, time() + (2628000 * 30), "/");
        $rand = rand('0000000000','9999999999');
        return redirect()->route('index', ['shr' => $rand]);
    }

    public function banner(){
        $shrx = rand('1','3');
        if ($shrx == 1){
            return redirect()->away(env('APP_URL')."/Oforum1.png");
        }elseif ($shrx == 2){
            return redirect()->away(env('APP_URL')."/Oforum2.png");
        }elseif ($shrx == 3){
            return redirect()->away(env('APP_URL')."/Oforum3.png");
        }

    }

    public function webhook(Request $request){


        $body = $request->all();

        $signature = $request->header('verif-hash');

        if (!$signature) {
            exit();
        }

        $local_signature = env('SECRET_HASH');

       if( $signature !== $local_signature ){
        exit();
        }

        http_response_code(200);

        if ($body['status'] == 'successful') {
            if(isset($body['customer']['email'])){
                if($body['amount'] == env('COUPON_PAY_AMOUNT')){
                    $phiy = DB::table('coupon')->where('value', $body['txRef'])->count();
                    $userid = DB::table('user_coupon')->where('email', $body['customer']['email'])->first();
                    if($phiy == 0){
                        $insert = DB::table('coupon')->insert(
                            ['value' => $body['txRef'], 'status' => 0, 'user' => $userid->mainid]
                        );
                    }
                }
            }
        }
        exit();

    }

    public function test(){

    }


    public function banktest(){

        $url = "https://api.ravepay.co/v2/banks/NG?public_key=FLWPUBK-2c16d1ca1250a28d8059a222132d144a-X";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $request = curl_exec($ch);
        curl_close($ch);

        $results = json_decode($request, true);;

        $rtys = $results['data']['Banks'];

        foreach ($rtys as $rty){
            $insert = DB::table('banks')->insert(
                ['name' => $rty['Name'], 'code' => $rty['Code']]
            );
        }


    }



    public function livescore(){


        $livescoredata = DB::table('livescore')->where('id', 1)->first();

        $livescoredata = json_decode($livescoredata->json, true);



        $livescoredata_count = $livescoredata['api']['results'];

        if($livescoredata_count == 0){
            $livescoredata_fixtures = null;

        }else{
            $livescoredata_fixtures = $livescoredata['api']['fixtures'];

        }



        return view('livescore', ['pagetitle' => 'Live Soccer Scores', 'livescoredata' => $livescoredata_fixtures, 'count' => $livescoredata_count]);



    }

}
