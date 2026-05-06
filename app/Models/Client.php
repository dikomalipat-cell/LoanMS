<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'birthdate',
        'age',
        'police_records',
        'current_job',
        'payroll',
        'payroll_picture',
        'admin_id',
        'loan_amount',
        'balance',
        'loan_date',
        'due_date',
        'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
