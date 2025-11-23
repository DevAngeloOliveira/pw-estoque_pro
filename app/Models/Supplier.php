<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Supplier extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'company_id',
        'is_global',
        'name',
        'legal_name',
        'cnpj',
        'email',
        'phone',
        'whatsapp',
        'website',
        'address',
        'address_number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'notes',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'is_global' => 'boolean',
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
     * Verifica se é um fornecedor global (do sistema)
     */
    public function isGlobal()
    {
        return $this->is_global;
    }

    /**
     * Verifica se é um fornecedor da empresa
     */
    public function isCompany()
    {
        return !$this->is_global;
    }

    /**
     * Scope para fornecedores globais
     */
    public function scopeGlobal($query)
    {
        return $query->where('is_global', true);
    }

    /**
     * Scope para fornecedores de uma empresa específica
     */
    public function scopeOfCompany($query, $companyId)
    {
        return $query->where('is_global', false)->where('company_id', $companyId);
    }

    /**
     * Scope para fornecedores ativos
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Retorna fornecedores disponíveis para uma empresa
     * (globais se use_global_suppliers = true, ou próprios da empresa)
     */
    public static function availableForCompany($companyId)
    {
        $company = Company::find($companyId);

        if (!$company) {
            return collect();
        }

        if ($company->use_global_suppliers) {
            return self::global()->active()->orderBy('name')->get();
        }

        return self::ofCompany($companyId)->active()->orderBy('name')->get();
    }

    /**
     * Formata o CNPJ
     */
    public function getFormattedCnpjAttribute()
    {
        if (!$this->cnpj) {
            return null;
        }

        return preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $this->cnpj);
    }

    /**
     * Formata o telefone
     */
    public function getFormattedPhoneAttribute()
    {
        if (!$this->phone) {
            return null;
        }

        $phone = preg_replace('/\D/', '', $this->phone);

        if (strlen($phone) === 11) {
            return preg_replace('/^(\d{2})(\d{5})(\d{4})$/', '($1) $2-$3', $phone);
        } elseif (strlen($phone) === 10) {
            return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '($1) $2-$3', $phone);
        }

        return $this->phone;
    }

    /**
     * Retorna o endereço completo formatado
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address,
            $this->address_number,
            $this->complement,
            $this->neighborhood,
            $this->city,
            $this->state,
            $this->zip_code,
        ]);

        return implode(', ', $parts);
    }

    /**
     * Contador de produtos
     */
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
}
