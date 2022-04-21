<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\orders;

class PDFController extends Controller
{
    public function invoice(request $request)
    {
        $order_id = strip_tags($request['order_id']);

        $order = DB::select("select * from orders where id = '$order_id'");
        $order = orders::where('id', $order_id);

        $email = $order[0]->user_email;
        $userdetails = DB::select("SELECT * FROM `users` WHERE email = '$email'");

            $order_id = $order[0]->id;
            $user_email = $order[0]->user_email;
            $name = $userdetails[0]->name;
            $order_date = $order[0]->order_date;
            $order_items_array = $order[0]->order_items;
            $order_total = $order[0]->order_total;
            $order_address_array = $order[0]->address;
    
        return view('mypdf', compact('order_id', 'user_email', 'name', 'order_date', 'order_items_array', 'order_total', 'order_address_array'));
    }
}
