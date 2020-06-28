<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionsTest extends TestCase
{
    private $transaction;

    /**
    * Test Invalid credential.
    */
    public function testInvalidCredential()
    {
        $this->transaction =  factory(Transaction::class)->create();

        $response = $this->get(
            'api/transactions/' . $this->transaction->id,
            $this->sharedSecretHeaders('token123')
        );
       
        $response->assertStatus(401);
    }
    
    /**
    * Test show() method response structure.
    */
    public function testViewTransactionById()
    {
        $this->transaction =  factory(Transaction::class)->create();

        $response = $this->get(
            'api/transactions/' . $this->transaction->id,
            $this->sharedSecretHeaders(env('SECRET_TOKEN'))
        );

       $response->assertJsonStructure(
            [
                'data' => [
                        'email',
                        'title',
                        'first_name',
                        'last_name',
                        'mobile_number',
                        'amount_required',
                        'term',
                        'repayment_amount',
                        'interest',
                        'establishment_fee'
                ],
            ]
        );
       
        $response->assertStatus(200);
    }
    
    /**
    * Test create transaction.
    */
    public function testCreateTransaction()
    {
        $data = [
            'email' => 'sonny@gmail.com',
            'title' => 'Mr.',
            'first_name' => 'sonny',
            'last_name' => 'parungao',
            'mobile_number' => 1,
            'amount_required' => 5000,
            'term' => 2,
            'repayment_amount' => 5500,
            'interest' => 500,
            'establishment_fee' => 300
        ];

        $response = $this->json(
            'POST',
            "api/transactions",
            $data,
            $this->sharedSecretHeaders(env('SECRET_TOKEN'))
        );

       $response->assertJsonStructure(
            [
                'data' => [
                        'email',
                        'title',
                        'first_name',
                        'last_name',
                        'mobile_number',
                        'amount_required',
                        'term',
                        'repayment_amount',
                        'interest',
                        'establishment_fee'
                ],
            ]
        );

        $response->assertStatus(201);
    }

    /**
    * Test update transaction.
    */
    public function testUpdateTransaction()
    {

        $this->transaction =  factory(Transaction::class)->create();

        $data = [
            'email' => 'sonny@gmail.com',
            'title' => 'Mr.',
            'first_name' => 'sonny',
            'last_name' => 'parungao',
            'mobile_number' => 1,
            'amount_required' => 5000,
            'term' => 2,
            'repayment_amount' => 5500,
            'interest' => 500,
            'establishment_fee' => 300
        ];

        $response = $this->json(
            'PATCH',
            "api/transactions/" . $this->transaction->id,
            $data,
            $this->sharedSecretHeaders(env('SECRET_TOKEN'))
        );

       $response->assertJsonStructure(
            [
                'data' => [
                        'email',
                        'title',
                        'first_name',
                        'last_name',
                        'mobile_number',
                        'amount_required',
                        'term',
                        'repayment_amount',
                        'interest',
                        'establishment_fee'
                ],
            ]
        );

        $response->assertStatus(200);

    }

    /*

    /**
     * Added header for api calls
     * @return array
     */
     protected function sharedSecretHeaders($token)
     {
         return [
             'Accept' => 'application/vnd.pm.v1+json',
             'X-Shared-Secret' => $token
         ];
     }
 
}
