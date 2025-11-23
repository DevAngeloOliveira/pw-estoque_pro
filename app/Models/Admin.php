<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'super_admin',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'super_admin' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * Verifica se é super admin
     */
    public function isSuperAdmin()
    {
        return $this->super_admin === true;
    }

    /**
     * Verifica se está ativo
     */
    public function isActive()
    {
        return $this->active === true;
    }

    /**
     * Scope para admins ativos
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope para super admins
     */
    public function scopeSuperAdmins($query)
    {
        return $query->where('super_admin', true);
    }
}
