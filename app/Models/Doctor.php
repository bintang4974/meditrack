<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function entriesAsOperator1()
    {
        return $this->hasMany(Entry::class, 'operator_1');
    }

    // bisa ditambahkan untuk operator_2,3,4
}
