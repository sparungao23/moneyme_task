<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    const RESOURCE_KEY = 'transactions';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'title',
        'mobile_number',
        'amount_required',
        'term'
    ];
}
