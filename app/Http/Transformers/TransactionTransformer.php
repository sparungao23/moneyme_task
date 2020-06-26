<?php

namespace App\Http\Transformers;

use App\Models\Transaction;
use App\Traits\SparseFieldsets;
use League\Fractal\TransformerAbstract;


class TransactionTransformer extends TransformerAbstract
{
    use SparseFieldsets;

    /**
     * Specifying the available includes
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Available fields.
     *
     * @var array
     */
    protected $availableFields = [
        'email',
        'first_name',
        'last_name',
        'mobile_number',
        'amount_required',
        'term',
        'created_at',
        'updated_at',
    ];

    /**
     * Default fields.
     *
     * @var array
     */
    protected $defaultFields = [
        'email',
        'first_name',
        'last_name',
        'mobile_number',
        'amount_required',
        'term',
        'created_at',
        'updated_at',
    ];

    /**
     * Do the transform.
     *
     * @param Transaction $transaction
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return $this->getFields($transaction);
    }
}
