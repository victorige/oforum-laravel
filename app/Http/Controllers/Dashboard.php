<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){
        /** DAILY2245 */
        if (Auth::check()) {
            $dailyzx = DB::table('data')->where('id', 1)->first();
            if($dailyzx->daily != Auth::user()->daily){
                $limitzx = env('POST_VIEW');
                $limitzy = env('POST_SHARE');
                $affected = DB::update("update users set postviewlimit = $limitzx where id = ?", [Auth::user()->id]);
                $affected = DB::update("update users set sharelimit = $limitzy where id = ?", [Auth::user()->id]);
                $affected = DB::update("update users set daily = $dailyzx->daily where id = ?", [Auth::user()->id]);
            }

        }

        $pager = Auth::user()->data;
        if($pager != 5){
            return redirect()->route('redirector');
        }

        $name = Auth::user()->name;
        $avatar = Auth::user()->avatar;
        $joindate = date_format(Auth::user()->created_at," d F, Y");

        date_default_timezone_set('Africa/Lagos');

        $Hour = date('G');
        if ( $Hour >= 0 && $Hour <= 5 ) {
            $greet = "Mornin' Sunshine! :)";
        }else if ( $Hour >= 6 && $Hour <= 11 ) {
            $greet = "Good Morning :)";
        }else if ( $Hour >= 12 && $Hour <= 16 ) {
            $greet = "Good Afternoon :)";
        }else if ( $Hour >= 17 && $Hour <= 24 ) {
            $greet = "Good Evening :)";
        }



        $earnings = $this->CurrencyFormat(Auth::user()->balance);
        $uearnings1 = (DB::table('views')->where('uid', Auth::id())->where('status', 0)->where('type', 0)->count()) * env('READ_AMOUNT');
        $uearnings2 = (DB::table('views')->where('uid', Auth::id())->where('status', 0)->where('type', 1)->count()) * env('SHARE_AMOUNT');
        $uearnings = $uearnings1 + $uearnings2;





        return view('dashboard', ['pagetitle' => 'Dashboard', 'name' => $name, 'avatar' => $avatar, 'joindate' => $joindate, 'greet' => $greet, 'earnings' => $earnings, 'uearnings' => $uearnings, 'readlimit' => Auth::user()->postviewlimit, 'min_payout' => env('MIN_PAYOUT'), 'payout_charge' => env('PAYOUT_CHARGE')]);
    }

    public function CurrencyFormat($number){
        $decimalplaces = 2;
        $decimalcharacter = '.';
        $thousandseparater = ',';
        return number_format($number,$decimalplaces,$decimalcharacter,$thousandseparater);
    }

    public function Oshare(){
        $pager = Auth::user()->data;
        if($pager != 5){
            return redirect()->route('redirector');
        }
        if(Auth::user()->sharelimit == 1){
            if(isset($_GET['shr'])){
                $shrr = $_GET['shr'];
                if($_GET['shr'] == Auth::user()->sharecode){
                    sleep(10);
                    $checkshr = $this->curl_get_shares( env('APP_URL').'?shr='.$shrr );
                    if($checkshr != 0){
                        $checkview = DB::table('views')
                            ->where('pid', $shrr)
                            ->where('uid', Auth::user()->id)
                            ->where('type', 1)
                            ->count();

                            if($checkview == 0){
                                if(Auth::user()->sharelimit == 1){
                                    $affected = DB::update("update users set sharelimit = 0 where id = ?", [Auth::user()->id]);
                                    $insert = DB::table('views')->insert(
                                        ['pid' => $shrr, 'uid' => Auth::user()->id, 'type' => 1]
                                    );

                                    return $this->sendFailedResponse("Osharing Successful.");
                                }

                            }

                    }else{
                        return $this->sendFailedResponse("You failed to Oshare to Facebook. Please try again.");
                    }


                }else{
                    return $this->sendFailedResponse("An error occured while Osharing. Please try again.");
                }
            }else{
                //$unicode = uniqid('shr_');
                $unicode = rand('0000000000','9999999999');
                $affected = DB::update("update users set sharecode = '$unicode' where id = ?", [Auth::id()]);
                $newURL = "https://www.facebook.com/dialog/share?app_id=".env('FACEBOOK_CLIENT_ID')."&display=popup&href=".env('APP_URL')."/?shr=$unicode&redirect_uri=".env('APP_URL')."/oshare?shr=$unicode";
                header('Location: '.$newURL);
                exit();
            }

        }else{
            return $this->sendFailedResponse("You have Oshared for today, Check Back Tomorrow.");
        }

    }

    public function giveaway(){
        $pager = Auth::user()->data;
        if($pager != 5){
            return redirect()->route('redirector');
        }

        $this->processgiveaway();
        $caption = env('APP_URL').'/'.'r/'.Auth::user()->refercode.'?u='.Auth::user()->id;

        if(Auth::user()->gw_totalpoints > 0){
            $affected = DB::update("update users set gw_status = '1' where id = ?", [Auth::id()]);
        }

        return view('giveaway', ['pagetitle' => 'Giveaway', 'caption' => $caption, 'gw_status' => Auth::user()->gw_status, 'gw_sharecount' => Auth::user()->gw_sharecount, 'gw_reactioncount' => Auth::user()->gw_reactioncount, 'gw_totalpoints' => Auth::user()->gw_totalpoints ]);
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

    public function processgiveaway(){
        $access_token = env('FACEBOOK_CLIENT_ID').'|'.env('FACEBOOK_CLIENT_SECRET');
        $api_url = 'https://graph.facebook.com/v3.0/?id=' . urlencode( env('APP_URL').'/'.'r/'.Auth::user()->refercode.'?u='.Auth::user()->id ) . '&fields=engagement&access_token=' . $access_token;
        $fb_connect = curl_init(); // initializing
        curl_setopt( $fb_connect, CURLOPT_URL, $api_url );
        curl_setopt( $fb_connect, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
        curl_setopt( $fb_connect, CURLOPT_TIMEOUT, 20 );
        $json_return = curl_exec( $fb_connect ); // connect and get json data
        curl_close( $fb_connect ); // close connection
        $body = json_decode( $json_return );
        $share_count = intval( $body->engagement->share_count );
        $reaction_count = intval( $body->engagement->reaction_count );
        $total_points = ($reaction_count * 2) + ($share_count * 5);
        $affected = DB::update("update users set gw_sharecount = '$share_count' where id = ?", [Auth::id()]);
        $affected = DB::update("update users set gw_reactioncount = '$reaction_count' where id = ?", [Auth::id()]);
        $affected = DB::update("update users set gw_totalpoints = '$total_points' where id = ?", [Auth::id()]);

    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('dashboard')
            ->withErrors(['msg' => $msg ?: 'An error occured. Please, try again.']);
    }

}
