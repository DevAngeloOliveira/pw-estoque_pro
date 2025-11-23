<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'company_id',
        'category_id',
        'supplier_id',
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'sku',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    // Relacionamentos
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->sku)) {
                $product->sku = self::generateUniqueSku();
            }
        });
    }

    private static function generateUniqueSku()
    {
        do {
            $sku = 'PRD-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        } while (self::where('sku', $sku)->exists());

        return $sku;
    }
}
