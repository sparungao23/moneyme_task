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

    public function loanDetails(Transaction $transaction)
    {

        $response = $transaction->first();
        //interest rate default to 10 percent
        $response->montly_payment = $this->calculatePMT(10, $response->term, $response->amount_required);
        $response->weekly_payment = money_format('$%i', $response->montly_payment/4);
        $response->total_interest = ($response->montly_payment * ($response->term * 12)) - $response->amount_required;
        $response->total_repayment = $response->amount_required + $response->total_interest + 300;
        return view('loan.details', compact('response'));
    }

    public function updateRepayment(Request $request)
    {
        $id = $request->all()['id'];
        $response = $this->transactionService->getById($id);
        $response->montly_payment = $this->calculatePMT(10, $response->term, $response->amount_required);
        $response->total_interest = ($response->montly_payment * ($response->term * 12)) - $response->amount_required;
        $response->total_repayment = $response->amount_required + $response->total_interest + 300;

        $request = [
            'repayment_amount' => $response->total_repayment,
            'interest' => $response->total_interest,
            'establishment_fee' => 300
        ];
        if (!$this->transactionService->updateTransacationRepayment($request, $id)) {
            return redirect('loan-request/' . $id);
        }
        return redirect('success');
    }

    public function success()
    {
        return 'success';
    }


    private function calculatePMT($interest, $years, $loan) 
    {
       $months = $years * 12;
       $interest = $interest / 1200;
       $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       return number_format($amount, 2);
    }


}
