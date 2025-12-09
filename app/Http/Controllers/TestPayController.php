<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestPayController extends Controller
{
    public function pay()
    {
        return view('user.paytest');
    }
    public function make_payment()
    {
        $formData = [
            'email' => request('email'),
            'amount' => request('amount') * 100, // Paystack expects amount in kobo
        ];


        $response = $this->initiate_payment($formData);

        // dd($response); // <- SEE EXACTLY WHAT PAYSTACK RETURNED

        $pay = json_decode($response);

        if ($pay->status) {
            return redirect($pay->data->authorization_url); 
        } else {
            return back()->withErrors($pay->message ?? 'Payment error');
        }
    }

    public function initiate_payment($formData)
    {
        $url = "https://api.paystack.co/transaction/initialize";
        $fields_string = http_build_query($formData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);

        if ($result === false) {
            dd('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);
        return $result;
    }

}
