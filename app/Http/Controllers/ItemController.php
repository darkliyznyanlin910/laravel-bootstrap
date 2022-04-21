<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('state', 'active')->paginate(4);
        //$items = DB::select('select * from items');
        return view('index',['items'=>$items]);
    }

    public function search(request $request)
    {
        $search = strip_tags($request['search']);
        $items = DB::select("select * from items where item_name like '%$search%'");
        $items = Item::where('item_name','LIKE','%'.$search.'%');
        return view('search',['items'=>$items]);
    }
}
