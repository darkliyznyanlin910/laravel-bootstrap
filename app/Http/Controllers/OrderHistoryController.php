<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;  

class OrderHistoryController extends Controller
{
    public function index()
    {
        $user_email = Auth::user()->email;
        $orders = Orders::where('user_email', $user_email)->orderBy('id', 'desc')->paginate(5);
        //$orders = DB::select("select * from orders where user_email = '$user_email' order by `id` desc");
        return view('profile',['orders'=>$orders]);
    }
}