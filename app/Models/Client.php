<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'gender',
        'birthdate',
        'age',
        'police_records',
        'current_job',
        'payroll',
        'payroll_picture',
        'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}