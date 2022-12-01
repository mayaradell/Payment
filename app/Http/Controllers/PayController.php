<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayController extends Controller
{
    //

    public function show()
    {

        return view('templet.home');
    }

    public function store(PayRequest $request)
    {

        // store user info in database

        $user=new User();
        $user ->FirstName=$request ->FirstName;
        $user ->SecondName=$request ->SecondName;
        $user ->email=$request ->email;
        $user ->phone=$request ->phone;
        $user ->save();

        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRNNU9EVXlMQ0p1WVcxbElqb2lhVzVwZEdsaGJDSjkuQkN3akV6RkNKTDFnRzVCZDFucHRoOXkzUy1CUmdPYVFFYVh6MEE3YVpNLWt2UndiNzBIeDhwdWstUlFnNWRJc2RnUnVpbllTMmlTd3VrOXliTVBpSVE=',

        ]);

        $response = json_decode($response); // Using this you can access any key like below
        $token = $response->token; //access key


        $items=[];
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', [
            'auth_token' => $token,
            'delivery_needed' => false,
            'amount_cents' => 100,
            'items' =>$items
        ]);

      //  dd($response->body());

        $billing=[

            'apartment' => "NA",
            'email' => $user->email,
            'floor' => "NA",
            'first_name' => "$user->FirstName",
            'street' => "NA",
            'building' => "NA",
            'phone_number' => $user->phone,
            'shipping_method' => "NA",
            'postal_code' => "NA",
            'city' => "NA",
            'country' => "NA",
            'last_name' => $user->SecondName,
            'state' => "NA",


        ];

        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', [
            'auth_token' => $token,
            'expiration' => 3600,
            'amount_cents' => 100,
            'order_id' => 84076421,
            'billing_data' => $billing,
            'currency' => "EGP",
            'integration_id' => 1589290
        ]);

        //  dd($response->body());

        $response = json_decode($response); // Using this you can access any key like below
        $payment_token = $response->token; //access key

          return redirect('https://accept.paymob.com/api/acceptance/iframes/313615?payment_token='.$payment_token);





    }

    public function pay(){

    }
    public function state(){

    }


}
