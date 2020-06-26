<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use App\Http\Transformers\TransactionTransformer;
use App\Models\Transaction;
#http://127.0.0.1:8001/api/transactions/1?fields[transactions]=first_name
class TransactionController extends Controller
{
    
     /**
     * Transaction Transformer.
     *
     * @var TransactionTransformer
     */
    protected $transactionTransformer = null;

    /**
     * Transaction service.
     *
     * @var TransactionService
     */
    protected $transactionService = null;

    public function __construct(
        TransactionTransformer $transactionTransformer,
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
        $this->transactionTransformer = $transactionTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return 'index';
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     *
     * @return JsonResponse
     */
    public function show(Request $request, Transaction $transaction)
    {
        return response()->item($transaction, $this->transactionTransformer, Transaction::RESOURCE_KEY);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     *
     * @return JsonResponse
     */
    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->createTransaction($request);
        return response()->item($transaction, $this->transactionTransformer, Transaction::RESOURCE_KEY)->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BusinessUnitRequest $request
     * @param BusinessUnit        $businessUnit
     *
     * @return JsonResponse
     */
    public function update(BusinessUnitRequest $request, BusinessUnit $businessUnit)
    {
        if ($request->user()->cannot('edit-business-unit', $businessUnit)) {
            return response()->errorForbidden('You do not have permission to edit business unit.');
        }

        if (!$this->businessUnitService->updateBusinessUnit($request, $businessUnit->id)) {
            return response()->errorInternal('Updating business unit failed.');
        }

        return response()->item($this->businessUnitService->getById($businessUnit->id), $this->transformer, BusinessUnit::RESOURCE_KEY);
    }
}
