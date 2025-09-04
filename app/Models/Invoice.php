<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
    'customer_id','invoice_number','amount','status','due_date',
    'stripe_session_id','stripe_payment_intent_id'
];

    public function customer()
        {
         return $this->belongsTo(Customer::class);
        }

        public function transactions()
        {
            return $this->hasMany(\App\Models\Transaction::class);
        }

}
