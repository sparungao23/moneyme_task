<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ThirdPartyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('thirdparty.index');
    }

    public function store(Request $request) 
    {
        $request = $request->all();

        $requestData = [
            "email" => $request['Email'],
            "first_name" => $request['FirstName'],
            "last_name" => $request['LastName'],
            "mobile_number" => $request['Mobile'],
            "amount_required" => $request['AmountRequired'],
            "term" => $request['Term'],
            "title" => $request['Title']
        ];
    
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/vnd.api+json',
                'Accept' => 'application/vnd.pm.v1+json'
            ],
            'base_uri' => 'http://127.0.0.1:8004',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $response = $client->post('/api/transactions',
            [
                'body' => json_encode($requestData)
            ]
        );

        if($response->getStatusCode() == 201) {
            return redirect('loan-request?id=1');
        }

        
       # echo '<pre>' . var_export($response->getStatusCode(), true) . '</pre>';
       # echo '<pre>' . var_export(json_decode($response->getBody()->getContents(),true), true) . '</pre>';
      #  die;
    }
}
