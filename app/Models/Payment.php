<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'payslip_img',
        'payment_method',
        'transaction_id',
        'order_code',
        'total_amt',
    ];
}
