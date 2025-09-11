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

    public function entriesAsOperator2()
    {
        return $this->hasMany(Entry::class, 'operator_2');
    }

    public function entriesAsOperator3()
    {
        return $this->hasMany(Entry::class, 'operator_3');
    }

    public function entriesAsOperator4()
    {
        return $this->hasMany(Entry::class, 'operator_4');
    }

    public function entriesAsSupervisor()
    {
        return $this->hasMany(Entry::class, 'entry_supervisor');
    }
}
