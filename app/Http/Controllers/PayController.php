<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
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

        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRNNU9EVXlMQ0p1WVcxbElqb2lhVzVwZEdsaGJDSjkuQkN3akV6RkNKTDFnRzVCZDFucHRoOXkzUy1CUmdPYVFFYVh6MEE3YVpNLWt2UndiNzBIeDhwdWstUlFnNWRJc2RnUnVpbllTMmlTd3VrOXliTVBpSVE=',

        ]);

        $response = json_decode($response); // Using this you can access any key like below
        $token = $response->token; //access key

        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', [
            'auth_token' => $token,
            'delivery_needed' => false,
            'amount_cents' => 10000,

        ]);

      //  dd($response->body());


        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', [
            'auth_token' => $token,
            'expiration' => 3600,
            'amount_cents' => 100,
            'order_id' => 103,
            'billing_data' =>$billing,
            'currency' => EGP,
            'integration_id' => 1
        ]);

        $billing=[

            'apartment' => "803",
            'email' => "claudette09@exa.com",
            'floor' => "42",
            'first_name' => "Clifford",
            'street' => "Ethan Land",
            'building' => "8028",
            'phone_number' => "+86(8)9135210487",
            'shipping_method' => "PKG",
            'postal_code' => "01898",
            'city' => "Jaskolskiburgh",
            'country' => "CR",
            'last_name' => "Nicolas",
            'state' => "Utah",


        ];


    }


}
