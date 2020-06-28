<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Http\Requests\TransactionRequest;

/**
 * Class TransactionService
 */
class TransactionService extends BaseService
{
    /**
     * @var TransactionRepository
     */
    protected $repository;

    protected $interest = 10;
    public $establishmentFee = 300;

    /**
     * TransactionService constructor.
     */
    public function __construct(
        TransactionRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Get transaction by Id.
     *
     * @param int $id
     *
     * @return Transaction
     */
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Saves a new Transaction.
     *
     * Prepares field data for storage.
     *
     * @param TransactionRequest $request
     *
     * @return Field
     */
    public function createTransaction(TransactionRequest $request)
    {
        return $this->repository->createTransaction($request->input());
    }

    /**
     * Updates a transaction.
     *
     * @param Transaction $request
     * @param int $id
     *
     * @return boolean
     */
    public function updateTransaction(TransactionRequest $request, int $id)
    {
        return $this->repository->updateTransaction($request->input(), $id);
    }

    /**
     * Updates a transaction repayment.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function updateTransacationRepayment(int $id)
    {
        $response = $this->getById($id);
        $totalMonthlyPayment = $this->calculatePMT(
            $response->term,
            $response->amount_required
        );
        $totalInterest = ($totalMonthlyPayment * ($response->term * 12)) - $response->amount_required;
        $totalRepayment = $response->amount_required + $totalInterest + $this->establishmentFee;

        $request = [
            'repayment_amount' => $totalRepayment,
            'interest' => $totalInterest,
            'establishment_fee' => 300
        ];
        
        return $this->repository->updateTransaction($request, $id);
    }

    /**
     * Updates a transaction repayment.
     *
     * @param array $request
     * @param int $id
     *
     * @return boolean
     */
    public function calculatePMT(int $term, int $loan) : float
    {
       $months = $term * 12;
       $interest = $this->interest / 1200;
       $amount = $interest * -$loan
        * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       return number_format($amount, 2);
    }

    /**
     * Calculate total loan and interest.
     *
     * @param $response
     *
     * @return object
     */
    public function calculateTotalLoanAndInterest($response) 
    {
        //interest rate default to 10 percent
        $response->montly_payment = $this->calculatePMT(
            $response->term,
            $response->amount_required
        );
        $response->weekly_payment =  $response->montly_payment / 4;
        $response->total_interest = ($response->montly_payment *
        ($response->term * 12)) - $response->amount_required;
        $response->total_repayment = $response->amount_required
        + $response->total_interest + $this->establishmentFee;
        $response->establishmentFee = $this->establishmentFee;
        return $response;
    }
}
