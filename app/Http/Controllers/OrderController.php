<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function payment(Order $order)
    {
        //Decodificamos el campo content para convertirlo de string a json 
        $items =json_decode($order->content);

        return view('orders.payment', compact('order', 'items'));
    }

    public function pay(Order $order, Request $request)
    {
        $payment_id = $request->get('payment_id');
        
        // Hacemos consulta a la api de mercadopago, enviando el id y el access_token
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-3553091843597130-010506-bbad9d4b782528192fef0287b6567128-1051407969");
        
        $response = json_decode($response);

        // Podemos ver la información convertida con el json_decode
        // dump($response);

        $status = $response->status;

        if($status == 'approved'){
            $order-> status = 2;
            $order->save();
        }
        
        return redirect()->route('orders.show', $order);
    }
}
