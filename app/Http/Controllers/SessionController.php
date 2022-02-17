<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function cart()
    {
        //Session::forget('cart');

        $cart_check = 0;
        $total = 0;
        $saved = 0;

        $items = Session::get('cart');
        if(Session::has('cart')){
            $cart_check = 1;

            for($i=0; $i < count($items); $i++){
                $items[$i]['saved'] = 0;
                $discounted_price = $items[$i]['price'];
                if($items[$i]['discount'] != 0){
                    $discount_rate = $items[$i]['discount'] / 100;
                    $item_saved = $items[$i]['price'] * $discount_rate;
                    $item_saved = round($item_saved, 2, PHP_ROUND_HALF_UP);
                    $items[$i]['saved'] = $item_saved;
                    $discounted_price = $items[$i]['price'] - $item_saved;
                    $saved += $items[$i]['saved'] * $items[$i]['quantity'];
                    $saved = round($saved, 2, PHP_ROUND_HALF_UP);
                }
                $quantity = $items[$i]['quantity'];
                $items[$i]['item_total'] = $quantity * $discounted_price;
                $total += $items[$i]['item_total'];
                $total = round($total, 2, PHP_ROUND_HALF_UP);
            }
        }
        Session::put('saved', $saved);

        Session::put('cart', $items);

        Session::put('total', $total);

        return view('cart',['cart'=>$items, 'check'=>$cart_check, 'total'=>$total, 'saved'=>$saved]);
    }

    public function checkout()
    {
        //Session::forget('cart');
        $cart_check = 0;
        if(Session::has('cart')){
            $cart_check = 1;
        }
        $items = Session::get('cart');

        $total = Session::get('total');

        $saved = Session::get('saved');

        return view('checkout',['cart'=>$items, 'check'=>$cart_check, 'total'=>$total, 'saved'=>$saved]);
    }

    public function confirm(request $request)
    {
        //Session::forget('cart');
        $street = $request['street'];
        $block = $request['block'];
        $unit = $request['unit'];
        $postal_code = $request['postal_code'];
        if(isset($request['street'])){
            Session::put('address', ['street'=>$street, 'block'=>$block, 'unit'=>$unit, 'postal_code'=>$postal_code,]);
        }
        $address = Session::get('address');
        $items = Session::get('cart');
        $total = Session::get('total');
        $saved = Session::get('saved');
        return view('confirm',['cart'=>$items, 'address'=>$address, 'total'=>$total, 'saved'=>$saved]);
    }

    public function add(Request $request)
    {
        $id = $request['id'];
        $quantity = $request['quantity'];

        $result = DB::select("select * from items where id = '$id'");
        $img = $result[0]->img;
        $price = $result[0]->price;
        $stock = $result[0]->stock;
        $item_name = $result[0]->item_name;
        $discount = $result[0]->discount;

        $visit = DB::select("select visit from items where id = '$id'");
        $add = $visit[0]->visit + $quantity;
        DB::update("update items set visit ='$add' where id = '$id'");

        if(Session::has('cart')){
            $item_new = 1;
            $items = Session::get('cart');
            for($i=0; $i < count($items); $i++){
                if($items[$i]['id'] == $id){
                    $item_new = 0;  
                    $items[$i]['quantity'] += $quantity;
                    Session::put('cart', $items); 
                }
            }
            if($item_new === 1){
                Session::push('cart', ['id' => $id, 'item_name' => $item_name, 'discount' => $discount, 'quantity' => $quantity, 'img'=> $img, 'stock'=> $stock, 'price'=> $price,]);
            }
        }else{
            Session::put('cart', [['id' => $id, 'item_name' => $item_name, 'discount' => $discount, 'quantity' => $quantity, 'img'=> $img, 'stock'=> $stock, 'price'=> $price,]]);
        }

        return redirect()->back()->withSuccess('Item Added');
    }

    public function remove(Request $remove)
    {
        $id = $remove['id'];
        $quantity = $remove['quantity'];
        if(Session::has('cart')){
            $items = Session::get('cart');
            for($i=0; $i < count($items); $i++){
                if($items[$i]['id'] == $id){
                    $items[$i]['quantity'] = $items[$i]['quantity'] - $quantity;
                    if($items[$i]['quantity'] == 0){
                        array_splice($items, $i, 1);
                    }
                    Session::put('cart', $items);  
                }
            }
        }
        $cart_check = 0;
        if(count($items) > 0){
            $cart_check = 1;
        }else{
            Session::forget('cart');
        }
        
        return redirect()->back()->withSuccess('Item Removed');
    }
}