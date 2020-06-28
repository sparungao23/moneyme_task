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
        'title',
        'first_name',
        'last_name',
        'mobile_number',
        'amount_required',
        'term',
        'repayment_amount',
        'interest',
        'establishment_fee',
        'created_at',
        'updated_at'
    ];

    /**
     * Default fields.
     *
     * @var array
     */
    protected $defaultFields = [
        'email',
        'title',
        'first_name',
        'last_name',
        'mobile_number',
        'amount_required',
        'term',
        'repayment_amount',
        'interest',
        'establishment_fee',
        'created_at',
        'updated_at'
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
        $fields = $this->getFields($transaction);
        $fields['url'] = 'http://127.0.0.1:8001/loan-request/' . $fields['id'];
        return $fields;
    }
}
