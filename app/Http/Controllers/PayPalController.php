<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('transaction');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction()
    {
        $total = Session::get('total');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "SGD",
                        "value" => $total
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $address_unserialized = Session::get('address');
            $address = serialize($address_unserialized);
            $order_items = Session::get('cart');

            $total = 0;
    
            foreach($order_items as $item){
                $item_name = $item['item_name'];
                $result = DB::select("select * from items where item_name = '$item_name'");
                $price = $result[0]->price;
                $stock = $result[0]->stock;
                $sale = $item['quantity'];
                $left = $stock - $item['quantity'];
                DB::update("update items set sale ='$sale' where item_name = '$item_name'");
                DB::update("update items set stock ='$left' where item_name = '$item_name'");
                $item_total = $item['quantity'] * $price;
                $total += $item_total;
            }
    
            $user_email = Auth::user()->email;
            $order_date = date("Y-m-d");
            $receive_date = date('Y-m-d', strtotime($order_date . " + 7 day"));
            $order_status = "Processing";
    
            $order_items_serialized = serialize($order_items);
            $cart_check = 1;
    
            if(DB::insert('insert into orders (user_email, order_date, order_items, order_total, address, receive_date, order_status) values (?, ?, ?, ?, ?, ?, ?)', 
            [$user_email, $order_date, $order_items_serialized, $total, $address, $receive_date, $order_status])){
                $cart_check = 0;
                Session::forget('cart');
                Session::forget('total');
                Session::forget('address');
            }
            return view('thankyou');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}