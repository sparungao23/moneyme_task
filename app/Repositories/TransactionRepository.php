<?php

namespace App\Repositories;

use App\Models\Transaction;

/**
 * Class TransactionRepository
 */
class TransactionRepository
{
    /**
     * @var Transaction
     */
    protected $model;

    /**
     * TransactionRepository constructor.
     *
     * @param Transaction $model
     */
    public function __construct(
        Transaction $model
    ) {
        $this->model = $model;
    }

    /**
     * Get object by id.
     *
     * @param int $id
     *
     * @return Transaction
     */
    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create new transaction.
     *
     * @param array $data
     *
     * @return Transaction
     */
    public function createTransaction(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update transaction in database.
     *
     * @param array $data
     *
     * @return boolean
     */
    public function updateTransaction(array $data, int $id)
    {
        $transaction = $this->model->findOrFail($id);
        return $transaction->update($data);
    }
}
