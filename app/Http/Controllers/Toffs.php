<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Toffs extends Controller
{

    public function table(){
        $toffs = DB::table('toffs')->get();
        echo "<style>

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
                                            </style>


                                <table>
          <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Code</th>
          </tr>";
          $i = 1;

        foreach ($toffs as $toff){
            echo "<tr>
            <td>$i</td>
            <td>$toff->name</td>
            <td>$toff->code</td>
            </tr>";
            $i = $i + 1;
        }

        echo "</table>";
    }

    public function toffs()
    {


        $toffs = DB::table('toffs')->get();

        foreach ($toffs as $toff) {

            $code = $this->getToken(5);

            $check = DB::table('toffs')->where('code', $code)->first();





            if($check != $code ){
                if($toff->code == null){
                    $affected = DB::update("update toffs set code = '$code' where id = ?", [$toff->id]);
                }

            }else{
                $affected = DB::update("update toffs set code = null where id = ?", [$toff->id]);

            }

            //$affected = DB::update("update toffs set code = null where id = ?", [$toff->id]);






        }
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

   public function smss(){

    $toffs = DB::table('toffs')->where('sms', 0)->get();

        foreach ($toffs as $toff) {

$message = "Hello beautiful,
You've been recommended for TOFFS and with reviews we can boldly say you're the type of PARTY QUEEN we need.
Here's your Invitation ID is $toff->code
Entry admits just one, please don't tamper or share the Invitation ID because it bears your name only

Party venue: APARTMENT 13, behind frostyz bodija Ibadan
Convoy leaves UI by 8pm (if you want to follow convoy)
Party starts 9pm
See you there.";

                $senderid = 'TOFFS';
                $to = "$toff->phone";
                $token = 'z12Xqex7uTsv6jvaFgDeJML1yg1ZL3mxGXudYHyHCeP8NlK4nqOWrCPWOqpVDihlru13hGk153LzUf8INz8NnTxbzDi5EI5KilVX';
                $baseurl = 'https://smartsmssolutions.com/api/json.php?';

                $sms_array = array
                (
                'sender' => $senderid,
                'to' => $to,
                'message' => $message,
                'type' => '0',
                'routing' => 4,
                'token' => $token
                );

                $params = http_build_query($sms_array);
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL,$baseurl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

                $response = curl_exec($ch);

                curl_close($ch);
                $result = json_decode($response, true);
                $responsecode = $result['code'];

                if($responsecode == 1000){
                    $affected = DB::update("update toffs set sms = 1 where id = ?", [$toff->id]);
                }

}

   }




   public function sms(){

    $toffs = DB::table('toffs')->where('sms', 0)->get();

        foreach ($toffs as $toff) {

$message = "Hello beautiful,
You've been recommended for TOFFS and with reviews we can boldly say you're the type of PARTY QUEEN we need.
Here's your Invitation ID is $toff->code
Entry admits just one, please don't tamper or share the Invitation ID because it bears your name only

Party venue: APARTMENT 13, behind frostyz bodija Ibadan
Convoy leaves UI by 8pm (if you want to follow convoy)
Party starts 9pm
See you there.";


                echo "Phone Number: $toff->phone <br><br>";
                echo "TEXT: $message <br><br><br><br>";


}

   }



   public function comment(){

    $baseurl = 'https://commentator.now.sh/';

                $comment = "TOFFS is bad";
                $limit = 1;


                $sms_array = array
                (
                "comment" => "$comment",
                "limit" => $limit,
                );


                $params = http_build_query($sms_array);
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL,$baseurl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

                $response = curl_exec($ch);

                curl_close($ch);
                $result = json_decode($response, true);

                echo $response;



   }


   public function cc(){

    $PAY_AMOUNT = env('PAY_AMOUNT');
        $FLWSECK = env('FLWSECK');

        $code = "HHOLWM6C34U14";
        $sec = env('FLWSECK');

        $arr =array(
            'txref' => "$code",
            'SECKEY' => "$sec"
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

        echo $request;


    }


    public function cqq(){


        $arr = array(
            "account_bank" => "011",
            "account_number" => "zzz3092855686",
            "amount" => "100",
            "seckey" => env('FLWSECK'),
            "narration" => env('APP_NAME'),
            "currency" => "NGN",
            "reference"=> "test01",
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

        echo $request;


        }


        public function cq(){

            $url = "https://api.twitter.com/1.1/statuses/user_timeline.json?Name=victNG";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Bearer: AAAAAAAAAAAAAAAAAAAAAP8J1wAAAAAAT4B1iMTfuo4qFY3RCRk9ktimq3Y%3D9GHo76F6mpQckNNgRCkHSQRCG9InrLiPQQCcrV79CoyjFNenae']);
            $request = curl_exec($ch);
            curl_close($ch);

            echo $request;





        }




        public function curl_get_shares( $url ){
            $access_token = env('FACEBOOK_CLIENT_ID').'|'.env('FACEBOOK_CLIENT_SECRET');
            $api_url = 'https://graph.facebook.com/v3.0/?id=' . urlencode( $url ) . '&fields=engagement&access_token=' . $access_token;
            $fb_connect = curl_init(); // initializing
            curl_setopt( $fb_connect, CURLOPT_URL, $api_url );
            curl_setopt( $fb_connect, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
            curl_setopt( $fb_connect, CURLOPT_TIMEOUT, 20 );
            $json_return = curl_exec( $fb_connect ); // connect and get json data
            curl_close( $fb_connect ); // close connection
            $body = json_decode( $json_return );
            return intval( $body->engagement->share_count );
        }

        public function pendingact(){
            $views5 = DB::table('views')->where('type', 0)->where('status', 0)->count();
            $views5 = $views5 * 5;

            $views20 = DB::table('views')->where('type', 1)->where('status', 0)->count();
            $views20 = $views20 * 20;

            echo $views5 + $views20;

        }


        public function phonenumbers(){
            $users = DB::table('users')->get();
            $balance = 0;
            foreach ($users as $user){
                $balance = $balance + $user->balance;
            }

            $payouts = DB::table('payout')->where('status', 0)->get();
            $pbalance = 0;
            foreach ($payouts as $payout){
                $pbalance = $pbalance + $payout->amount + 50;
            }

            $coupons = DB::table('coupon')->where('status', 0)->count();
            $cbalance = $coupons * 1350;

            $data = DB::table('data')->where('id', 1)->first();
            $dbalance = $data->acash + $data->ceocash;


            echo $balance + $pbalance + $cbalance + $dbalance;
        }




        public function cal155(){
            //return $this->pendingact();

        return $this->league('2020-01-01');

            //return $this->h2h('a', 'a','a','a',5319,5322);
        }








        public function fetch(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/leagues",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                    "x-rapidapi-key: ac3666abccmshf6e11c6df4053fap1c86e0jsn582e94c1c942"
                ),
            ));


            //$result = json_decode($request, true);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {

                echo $response;

                exit();

                $result = json_decode($response, true);


                $result = $result['api']['leagues'];

                foreach ($result as $results){
                    echo $this->league($results['league_id']);

                }
            }

        }


        public function league($date){
            //$date = "2019-12-1";

            echo "<b>*Date: ".$date."*</b><br><br>";

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/fixtures/date/$date?timezone=Africa/Lagos",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                    "x-rapidapi-key: ac3666abccmshf6e11c6df4053fap1c86e0jsn582e94c1c942"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $result = json_decode($response, true);
                $result = $result['api']['fixtures'];

                foreach ($result as $results){
                    $status = $results['status'];

                    if($status === "Not Started"){
                        echo $this->h2h(
                            $results['league']['name'],
                            $results['league']['country'],
                            $results['homeTeam']['team_name'],
                            $results['awayTeam']['team_name'],
                            $results['homeTeam']['team_id'],
                            $results['awayTeam']['team_id']
                        );
                    }




                }
            }





        }





        public function h2h($leaguename, $leaguecountry, $homeTeamteam_name, $awayTeamteam_name, $homeTeamteam_id, $awayTeamteam_id){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/fixtures/h2h/$homeTeamteam_id/$awayTeamteam_id?timezone=Africa/Lagos",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                    "x-rapidapi-key: ac3666abccmshf6e11c6df4053fap1c86e0jsn582e94c1c942"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {

                $result = json_decode($response, true);
                $result = $result['api']['fixtures'];
                $countrfvs = count($result);

                $over15 = 0;
                $anywin = 0;
                $homewin = 0;
                $awaywin = 0;
                $homewinx = 0;
                $awaywinx = 0;
                $scores = "s:<br>";



                $count = 0;
                $countnum = 2;
                $countnum1 = $countnum + 1;
                $result = array_reverse($result);

                //echo "<br><br>".$confirm."<br><br>";

                if($countrfvs >= $countnum){
                    foreach ($result as $fvs){
                        if($count <= $countnum){


                        if($fvs['status'] === "Match Finished"){
                            $count = $count + 1;

                            if($fvs['homeTeam']['team_id'] == $homeTeamteam_id){
                                $home = $fvs['goalsHomeTeam'];
                                $away = $fvs['goalsAwayTeam'];
                            }else{
                                $away = $fvs['goalsHomeTeam'];
                                $home = $fvs['goalsAwayTeam'];
                            }



                            $gol = $home." - ".$away;
                            $scores = $scores."$gol<br>";

                            $hasum = $home + $away;
                        // OVER 1.5
                            if($home > 0){
                                if($away > 0){
                                    if($hasum > 2){
                                        $over15 = $over15 + 1;
                                    }
                                }
                            }

                        // ANY TEAM WINS
                            if($home > $away || $away > $home){
                                $dh = abs($home - $away);
                                if($dh > 1){
                                    $anywin = $anywin + 1;
                                }

                            }

                        // HOME WINS
                            if($home > $away){
                                $homewin = $homewin + 1;
                            }

                        // AWAY WINS
                            if($away > $home){
                                $awaywin = $awaywin + 1;
                            }

                        // HOME WINS OR DRAW
                            if($home >= $away){

                                    $homewinx = $homewinx + 1;

                            }

                        // AWAY WINS OR DRAW
                            if($away >= $home){

                                    $awaywinx = $awaywinx + 1;

                            }


                        }
                    }


                    }


                    $confirm = 0;
                    if($over15 > $countnum){
                        $confirm = 1;

                    }

                    if($anywin > $countnum){
                        $confirm = 1;
                    }

                    if($homewin > $countnum){
                        $confirm = 1;

                    }

                    if($awaywin > $countnum){
                        $confirm = 1;

                    }

                    if($homewinx > $countnum){
                        //$confirm = 1;

                    }

                    if($awaywinx > $countnum){
                        //$confirm = 1;

                    }

                    if($confirm == 1){
                        //echo $scores;
                        echo $home = "League country: ".$leaguecountry." <br> ";
                        echo $home = "League name: ".$leaguename." <br> ";
                        echo $home = "<b>*Match: ".$homeTeamteam_name." - ".$awayTeamteam_name."*</b><br>";
                        echo "Prediction:<br>";
                        if($over15 > $countnum){ echo "Over 1.5 <br>"; }
                        if($anywin > $countnum){ echo "Any Team Win <br>"; }
                        if($homewin > $countnum){ echo $homeTeamteam_name." Win <br>"; }
                        if($awaywin > $countnum){ echo $awayTeamteam_name." Win <br>"; }
                        //if($homewinx > $countnum){ echo $homeTeamteam_name." Win or Draw <br>"; }
                        //if($awaywinx > $countnum){ echo $awayTeamteam_name." Win or Draw <br>"; }

                        echo "<br><br>";
                    }

                }





            }

        }





    public function ex() {





    }




    public function fetchh(){

        $apikey = "9a0e2e9a72194552afe8e71c4650d03644fcfe8d07ce1d6fa6d26f6c6facba9e";
            $firstTeam = urlencode($firstTeam);
            $secondTeam = urlencode($secondTeam);
            $url = "https://apiv2.apifootball.com/?action=get_H2H&firstTeam=$firstTeam&secondTeam=$secondTeam&APIkey=$apikey";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            $request = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($request, true);

            $rfvs = $result['firstTeam_VS_secondTeam'];

            //$rfvs = json_encode($rfvs);

            $countrfvs = count($rfvs);

            $confirm = 0;
            $count = 0;
            $countnum = 3;

            if($countrfvs <= $countnum){

            foreach ($rfvs as $fvs){
                if($count <= $countnum){
                    $count = $count + 1;

                $home = $fvs['match_hometeam_score'];
                $away = $fvs['match_awayteam_score'];

                $hasum = $home + $away;

                if($home >= 1){
                    if($away >= 1){
                        if($hasum >= 3){
                            $confirm = $confirm + 1;
                        }
                    }
                }


            }
            echo "checked <br><br>";
        }

            if($confirm >= $countnum){
            echo $home = $fvs['league_name']." <br> ";
            echo $home = $fvs['match_hometeam_name']." - ".$fvs['match_awayteam_name']." <br><br> ";
            }

        }






    }







}
