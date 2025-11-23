<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMovement extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'product_id',
        'company_id',
        'type',
        'quantity',
        'unit_price',
        'total_price',
        'description',
        'movement_date',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'movement_date' => 'datetime',
    ];

    // Relacionamentos
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Atualizar estoque automaticamente
    protected static function boot()
    {
        parent::boot();

        static::created(function ($movement) {
            $product = $movement->product;

            if ($movement->type === 'entrada') {
                $product->quantity += $movement->quantity;
            } elseif ($movement->type === 'saida') {
                $product->quantity -= $movement->quantity;
            }

            $product->save();
        });
    }
}
