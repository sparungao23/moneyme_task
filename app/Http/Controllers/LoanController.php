<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;


class LoanController extends Controller
{

    /**
     * Transaction service.
     *
     * @var TransactionService
     */
    protected $transactionService = null;
    

    /**
     * Transaction service.
     *
     * @var TransactionService
     */
    public function __construct(
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
        $this->middleware('auth');
    }
   
    /**
     * Show the application loan processing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Transaction $transaction)
    {
        
        $response = $transaction->first();
      
        /*$data = [
            "email" => "sonny2@gmail.com",
            "first_name" => "sonny@gmail.com",
            "last_name" => "test@gmail.com",
            "mobile_number" => 1,
            "amount_required" => 2,
            "term" => 2,
            "title" => "test"
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
            ['body' => json_encode($data)]
        );

        echo '<pre>' . var_export($response->getStatusCode(), true) . '</pre>';
        echo '<pre>' . var_export($response->getBody()->getContents(), true) . '</pre>';
        die;*/

        return view('loan.index', compact('response'));
        #return view('home');
        #return 'loan page private';
    }

    public function update(TransactionRequest $request, Transaction $transaction) 
    {
        $id = $request->input()['id'];
        if (!$this->transactionService->updateTransaction($request, $id)) {
            return redirect('loan-request/' . $id);
        }
        
        return redirect('loan-details/' . $id);
    }

    public function loanDetails(Request $request)
    {
        echo 1;
    }

}
