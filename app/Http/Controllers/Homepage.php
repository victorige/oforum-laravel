<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Homepage extends Controller
{
    public function index(){
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

        $limit = 20;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $posts = DB::table('zy_posts')
                ->where('post_status', 'publish')
                ->where('post_type', 'post')
                ->where('post_title', '!=' , null)
                ->where('post_content', '!=' , null)
                ->orderBy('ID', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('zy_posts')
                ->where('post_status', 'publish')
                ->where('post_type', 'post')
                ->where('post_title', '!=' , null)
                ->where('post_content', '!=' , null)
                ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;

        $livescoredata = DB::table('livescore')->where('id', 1)->first();

        $livescoredata = json_decode($livescoredata->json, true);
        $livescoredata_count = $livescoredata['api']['results'];

        return view('index', ['pagetitle' => env('APP_NAME'), 'posts' => $posts, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, 'livescoredata_count' => $livescoredata_count ]);
    }



    public function postview($id){
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

        $post = DB::select('select * from zy_posts where post_name= :id and post_status = :status and post_type = :type', ['id' => $id, 'status' => 'publish', 'type' => 'post']);
        if($post == null){
            return abort(404);
        }

        foreach ($post as $posts) {
            $post_ID = $posts->ID;
            $post_title = $posts->post_title;
            $post_content = $posts->post_content;
            $post_date = $posts->post_date;
            $post_name = $posts->post_name;
        }


        $ogurl = env('APP_URL')."/-/".$post_name;

            $string = strip_tags($post_content);
            if (strlen($string) > 500) {

                $stringCut = substr($string, 0, 500);
                $endPoint = strrpos($stringCut, ' ');

                $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

            }




        if (Auth::check()) {

        $uid = Auth::user()->id;
        $pager = Auth::user()->data;
        if($pager == 5){


           $checkview = DB::table('views')
                ->where('pid', $post_ID)
                ->where('uid', $uid)
                ->count();

                if($checkview == 0){
                    $postviewlimit = Auth::user()->postviewlimit;
                    if($postviewlimit != 0){
                        $postviewlimit = $postviewlimit - 1;
                        $affected = DB::update("update users set postviewlimit = '$postviewlimit' where id = ?", [$uid]);
                        $insert = DB::table('views')->insert(
                            ['pid' => $post_ID, 'uid' => $uid]
                        );


                    }
                }



        }

    }

        return view('postview', ['pagetitle' => $post_title, 'post_title' => $post_title, 'post_content' => $post_content, 'timeago' => $this->timeago($post_date), 'ogurl' => $ogurl, 'ogdescription' => $string ]);
    }


    public function pageview($id){
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

        $post = DB::select('select * from zy_posts where post_name= :id and post_status = :status and post_type = :type', ['id' => $id, 'status' => 'publish', 'type' => 'page']);
        if($post == null){
            return abort(404);
        }

        foreach ($post as $posts) {
            $post_ID = $posts->ID;
            $post_title = $posts->post_title;
            $post_content = $posts->post_content;
            $post_date = $posts->post_date;
            $post_name = $posts->post_name;
        }

        $ogurl = env('APP_URL')."/--/".$post_name;

            $string = strip_tags($post_content);
            if (strlen($string) > 500) {

                $stringCut = substr($string, 0, 500);
                $endPoint = strrpos($stringCut, ' ');

                $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

            }



        return view('pageview', ['pagetitle' => $post_title, 'post_title' => $post_title, 'post_content' => $post_content, 'timeago' => $this->timeago($post_date), 'ogurl' => $ogurl, 'ogdescription' => $string ]);
    }


    public function timeago($date) {
        $timestamp = strtotime($date);

        $strTime = array("second", "minute", "hour", "day", "month", "year");
        $length = array("60","60","24","30","12","10");

        $currentTime = time();
        if($currentTime >= $timestamp) {
             $diff     = time()- $timestamp;
             for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
             $diff = $diff / $length[$i];
             }

             $diff = round($diff);
             return $diff . " " . $strTime[$i] . "(s) ago ";
        }
     }


     public function list(){

        $limit = 10;
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
        $start_from = ($page-1) * $limit;

        $payouts = DB::table('payout')
                ->orderBy('id', 'DESC')
                ->offset($start_from)
                ->limit($limit)
                ->get();

        $total_records = DB::table('payout')
                ->count();

        $totalPages = ceil($total_records / $limit);
        $jm = $page - 1;
        $jp = $page + 1;
        return view('payoutlist', ['pagetitle' => 'Payout List', 'payouts' => $payouts, 'page' => $page, 'jm' => $jm, 'jp' => $jp, 'totalPages' => $totalPages, 'total_records' => $total_records]);
    }



}
