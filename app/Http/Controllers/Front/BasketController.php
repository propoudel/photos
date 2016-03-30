<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use App\Models\Price;
use Illuminate\Http\Request;
use Cart;
use Log;
use Mail;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => 'Please select one :attribute option.',
            ];

            $validator = Validator::make($request->all(), [
                'price' => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator, 'price')
                    ->withInput();
            }

            $item_id = $request->input('item');
            $price_id = $request->input('price');
            $item = Item::where('id', $item_id)
                ->where('status', '1')
                ->first();
            $price = Price::where('id', $price_id)->first();
            $cart_item = [
                'id' => $item->id,
                'name' => $item->name,
                'qty' => '1',
                'price' => $price->price,
                'options' => [
                    'size' => $price->size->name,
                    'thumbnail' => $item->thumbnail,
                ],
            ];

            Cart::add($cart_item);
            return redirect('/checkout/basket');
        }
        return view('errors.404');


    }

    public function update(Request $request)
    {
        $update = Cart::update($request->input('rowId'), $request->input('updateVal'));
        return 'success';
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function basket()
    {
        $cart = Cart::content();
        return view('front.basket.cart')
            ->withCart($cart);
    }

    public function delivery()
    {
        //first check if customer is logged in


    }
}
