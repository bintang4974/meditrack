<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'raw_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function succeeded(): bool
    {
        return in_array($this->transaction_status, ['capture', 'settlement']);
    }
}
