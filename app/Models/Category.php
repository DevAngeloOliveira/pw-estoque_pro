<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'color',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Relacionamento com a empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relacionamento com produtos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Conta produtos da categoria
     */
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
}
