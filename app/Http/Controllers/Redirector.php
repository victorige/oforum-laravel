<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Redirector extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $pagedata = Auth::user()->data;

        if($pagedata == 0){
            return redirect()->route('verify.phone');
        }elseif($pagedata == 1){
            return redirect()->route('opt.payment');
        }elseif($pagedata == 2){
            return redirect()->route('process.payment');
        }elseif($pagedata == 3){
            return redirect()->route('refer.enter');
        }elseif($pagedata == 4){
            return redirect()->route('enter.bank');
        }elseif($pagedata == 5){
            return redirect()->route('dashboard');
        }

    }
}
