<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\orders;
use App\Models\Item;
use App\Models\category;
use App\Http\Requests\StorePostRequest;

class AdminController extends Controller
{
    public function summary()
    {
        $today = date('Y-m-d');
        $date = date('Y-m-d', strtotime($today."- 15 days"));
        //$items = DB::select("select * from items order by `sale` desc");
        $items = Item::orderBy('sale', 'asc')->get();
        for($i=0; $i<count($items); $i++){
            if($items[$i]->sale == 0 || $items[$i]->visit == 0){
                $items[$i]->rate = 0;
            }else{
                $ratio = $items[$i]->sale / $items[$i]->visit;
                $rate = $ratio * 100;
                $items[$i]->rate = round($rate, 2, PHP_ROUND_HALF_UP);
            }
        }
        
        $sale_total = 0;
        $order_no = 0;
        //$orders_all = DB::select("select order_total from orders");
        $orders_all = Orders::all();
        foreach($orders_all as $order_all){
            $sale_total += $order_all->order_total;
            $order_no++;
        }

        $sale_in_15_days = 0;
        $order_no_in_15_days = 0;
        //$orders_15 = DB::select("select order_total from orders where order_date > '$date'");
        $orders_15 = Orders::where('order_date', '>', $date);
        foreach($orders_15 as $order_15){
            $sale_in_15_days += $order_15->order_total;
            $order_no_in_15_days++;
        }

        return view('summary',['items'=>$items, 'sale_total'=>$sale_total, 'sale_in_15_days'=>$sale_in_15_days, 'order_no_in_15_days'=>$order_no_in_15_days, 'order_no'=>$order_no]);
    }

    public function pending_orders()
    {
        //$result = DB::select("select * from orders where order_status != 'Delivered' order by `order_date`");
        $result = Orders::whereNot('order_status', 'Delivered')->orderBy('order_date', 'asc')->get();
        return view('pending_orders',['orders'=>$result]);
    }

    public function order_history()
    {
        $orders = Orders::orderBy('id', 'desc')->paginate(5);
        //$orders = DB::select("select * from orders order by `id` desc");
        return view('order_history',['orders'=>$orders]);
    }

    public function add_new_item()
    {
        //$categories = DB::select("select * from categories");
        $categories = category::all();
        return view('add_new_item',['categories'=>$categories]);
    }

    public function manage_category()
    {
        //$categories = DB::select("select * from categories");
        $categories = category::all();
        return view('manage_category',['categories'=>$categories]);
    }

    public function add_new_category_process(request $request)
    {
        $category = strip_tags($request['category']);
        //$check = DB::select("select * from categories where category_name = '$category'");
        $check = category::where('category_name', $category)->get();
        if(count($check) != 0){
            return redirect()->back()->withError('Category already Exist');
        }
        DB::insert('insert into categories (category_name) values (?)', [$category]);
        return redirect()->route('manage_category')->withSuccess('Category Added');
    }

    public function remove_category_process(request $request)
    {
        $category = strip_tags($request['category']);
        DB::delete("delete from categories where category_name = '$category'");
        return redirect()->route('manage_category')->withSuccess('Category Removd');
    }

    public function edit_items(request $request)
    {
        $id = strip_tags($request['id']);
        //$items = DB::select("select * from items where id = '$id' ");
        $items = Item::where('id', $id)->get();
        $category = $items[0]->category;
        //$categories = DB::select("select * from categories where category_name != '$category'");
        $categories = Category::whereNot('category_name', $category);
        $state = 'active';
        if($items[0]->state == 'active'){
            $state = 'inactive';
        }
        return view('edit_items',['items'=>$items[0], 'state'=>$state, 'categories'=>$categories]);
    }

    public function edit_items_process(Request $request)
    {
        $id = strip_tags($request['id']);
        $sku = strip_tags($request['sku']);
        $item_name = strip_tags($request['item_name']);
        $price = strip_tags($request['price']);
        $stock = strip_tags($request['stock']);
        $state = strip_tags($request['state']);
        $category = strip_tags($request['category']);

        $discount_setting = strip_tags($request['discount']);
        $start_date = strip_tags($request['start_date']);
        $end_date = strip_tags($request['end_date']);

        $sku_check = 'single';
        
        $items = DB::select("select sku from items where id != '$id'");
        $items = Item::whereNot('id', $id);
        foreach($items as $item){
            if($item->sku == $sku){
                $sku_check = 'duplicate';
            }
        }
        if($sku_check == 'single'){

            if(isset($request->file)){
                $fileName = time().'.'.$request->file->extension();  
        
                $request->file->move(public_path('images'), $fileName);

                $img = "images/$fileName";
                DB::update("update items set 
                    sku ='$sku',
                    item_name ='$item_name',
                    category ='$category',
                    state ='$state',
                    discount_setting ='$discount_setting',
                    start_date = '$start_date',
                    end_date = '$end_date',
                    price ='$price',
                    img ='$img',
                    stock ='$stock'
                    where id = '$id'");
                return redirect()->route('manage_items')->withSuccess('Item Edit Saved');
            }else{
                DB::update("update items set 
                    sku ='$sku',
                    item_name ='$item_name',
                    category ='$category',
                    state ='$state',
                    discount_setting ='$discount_setting',
                    start_date = '$start_date',
                    end_date = '$end_date',
                    price ='$price',
                    stock ='$stock'
                    where id = '$id'");
                return redirect()->route('manage_items')->withSuccess('Item Edit Saved');
            }
        }else{
            return redirect()->route('manage_items')->withError('Item SKU already Exist');
        }
    }

    public function manage_items()
    {
        //$items = DB::select('select * from items');
        $items = Item::all();
        return view('manage_items',['items'=>$items]);
    }

    public function deactivate_items($id)
    {
        $clean_id = strip_tags($id);
        DB::update("update items set state ='inactive' where id = '$clean_id'");
        return redirect()->back()->withSuccess('Item Removed from Shelves');
    }

    public function activate_items($id)
    {
        $clean_id = strip_tags($id);
        DB::update("update items set state ='active' where id = '$clean_id'");
        return redirect()->back()->withSuccess('Item Added Back to Shelves');
    }

    public function delete_items($id)
    {
        $clean_id = strip_tags($id);
        DB::delete("delete from items where id = '$clean_id'");
        return redirect()->back()->withSuccess('Item Deleted');
    }

    public function add_new_item_process(Request $request)
    {
        if($request['category'] != '--Create New Category--'){
            $category = $request['category'];
        }

        if(isset($request['new_category'])){
            $category = $request['new_category'];
            DB::insert('insert into categories (category_name) values (?)', 
            [$category]);
        }

        $sku = strip_tags($request['sku']);

        //$sku_check = DB::select("select sku from items where sku = '$sku'");
        $sku_check = Item::where('sku', $sku);
        if(count($sku_check) != 0){
            return redirect()->back()->withError('Item SKU already Exist');
        }
        $item_name = strip_tags($request['item_name']);

        $price = strip_tags($request['price']);

        $stock = strip_tags($request['stock']);

        $state = strip_tags($request['state']);

        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('images'), $fileName);

        $img = "images/$fileName";

        DB::insert('insert into items (sku, item_name, state, category, price, img, stock) values (?, ?, ?, ?, ?, ?, ?)', 
        [$sku, $item_name, $state, $category, $price, $img, $stock]);

        return redirect()->back()->withSuccess('New Item Added');
    }

    public function admin_order_update(Request $request)
    {
        $order_id = strip_tags($request['order_id']);
        $status = strip_tags($request['status']);
        DB::update("update orders set order_status ='$status' where id = '$order_id'");
        
        return redirect()->back()->withSuccess('Status Updated Successfully');
    }

    public function stock_update_process(Request $request)
    {
        $id = strip_tags($request['id']);
        $results = DB::select("select stock from items where id = '$id'");
        $old_stock = $results[0]->stock;
        $quantity = strip_tags($request['quantity']);
        $new_stock = $old_stock + $quantity;
        
        DB::update("update items set stock ='$new_stock' where id = '$id'");
        
        return redirect()->back()->withSuccess('Stock Updated Successfully');
    }

    public function stock_remove_process(Request $request)
    {
        $id = strip_tags($request['id']);
        $results = DB::select("select stock from items where id = '$id'");
        $old_stock = $results[0]->stock;
        $quantity = strip_tags($request['quantity']);
        $new_stock = $old_stock - $quantity;
        
        DB::update("update items set stock ='$new_stock' where id = '$id'");
        
        return redirect()->back()->withSuccess('Stock Updated Successfully');
    }

    public function update_discount_process()
    {
        $today = date('Y-m-d');
        $items = DB::select("select * from items");
        foreach($items as $item){
            $id = $item->id;
            $default = 0;
            if($item->discount_setting > 0){    //Check whether setting is set
                $discount_setting = $item->discount_setting;
                if($today >= $item->start_date && $today <= $item->end_date){   //Check whether date is in range
                    DB::update("update items set 
                        discount ='$discount_setting'
                        where id = '$id'
                    ");
                }else{  //Expired
                    DB::update("update items set 
                        discount_setting ='$default',
                        start_date = '',
                        end_date = '',
                        discount ='$default'
                        where id = '$id'
                    ");
                }
            }else{
                DB::update("update items set 
                    discount ='$default'
                    where id = '$id'
                ");
            }
        }
        return redirect()->back()->withSuccess('Discount Updated Successfully');
    }
}