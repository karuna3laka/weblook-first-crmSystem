<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public const STATUSES = ['lead', 'active', 'inactive'];

    protected $fillable = [
        'name', 'email', 'phone', 'company', 'address', 'status'
    ];

    public function invoices()
        {
             return $this->hasMany(Invoice::class);
        }

        public function transactions()
        {
            return $this->hasMany(\App\Models\Transaction::class);
        }

}
