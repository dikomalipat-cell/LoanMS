<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    public function clients()
    {
        return $this->hasMany(Client::class, 'admin_id');
    }
}
