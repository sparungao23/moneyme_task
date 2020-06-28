<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ThirdPartyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('thirdparty.index');
    }

    /**
     * Third Party Controller that consume the transaction api and redirect to moneyme website
     *
     * @param Request $request
     */
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
                'Accept' => 'application/vnd.pm.v1+json',
                'X-Shared-Secret' => env('SECRET_TOKEN')
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

        $responseBody = json_decode($response->getBody()->getContents(),true);

        if($response->getStatusCode() == 201) {
            return redirect('loan-request/' . $responseBody['data']['id']);
        }
    }
}
