<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'role' => 'string',
        ];
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    // Loan relationships
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function approvedLoans()
    {
        return $this->hasMany(Loan::class, 'approved_by');
    }

    // Payment relationships
    public function paymentsReceived()
    {
        return $this->hasMany(Payment::class, 'received_by');
    }

    // Notification relationships
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Audit log relationships
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin' || $this->is_admin;
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    public function isBorrower()
    {
        return $this->role === 'user';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function getUnreadNotificationsCount()
    {
        return $this->notifications()->unread()->count();
    }
}
