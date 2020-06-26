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
     * @param int                 $id
     *
     * @return boolean
     */
    public function updateTransaction(TransactionRequest $request, int $id)
    {
        return $this->repository->updateTransaction($request, $id);
    }
}
