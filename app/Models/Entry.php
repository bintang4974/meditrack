<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $guarded = [];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function operator1()
    {
        return $this->belongsTo(Doctor::class, 'operator_1');
    }
    public function operator2()
    {
        return $this->belongsTo(Doctor::class, 'operator_2');
    }
    public function operator3()
    {
        return $this->belongsTo(Doctor::class, 'operator_3');
    }
    public function operator4()
    {
        return $this->belongsTo(Doctor::class, 'operator_4');
    }

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Doctor::class, 'entry_supervisor');
    }

    public function metadata()
    {
        return $this->hasMany(Metadata::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_key', 'voucher_code');
    }
}
