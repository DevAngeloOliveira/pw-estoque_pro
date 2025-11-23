<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Company extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'password',
        'razao_social',
        'nome_fantasia',
        'email',
        'telefone',
        'endereco',
        'active',
        'use_global_suppliers',
    ];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'active' => 'boolean',
        'use_global_suppliers' => 'boolean',
    ];

    // Mutator para senha
    public function setPasswordAttribute($value)
    {
        // Só faz hash se a senha não estiver vazia e não for já um hash
        if (!empty($value) && !preg_match('/^\$2[ayb]\$.{56}$/', $value)) {
            $this->attributes['password'] = Hash::make($value);
        } elseif (!empty($value)) {
            $this->attributes['password'] = $value;
        }
    }

    // Relacionamentos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
    }

    // Método auxiliar para formatar CNPJ
    public function getFormattedCnpjAttribute()
    {
        $cnpj = preg_replace('/\D/', '', $this->cnpj);
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }

    // Validar CNPJ
    public static function validateCnpj($cnpj)
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Validação dos dígitos verificadores
        $soma = 0;
        $multiplicador = 5;
        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $multiplicador;
            $multiplicador = ($multiplicador == 2) ? 9 : $multiplicador - 1;
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        if ($cnpj[12] != $digito1) {
            return false;
        }

        $soma = 0;
        $multiplicador = 6;
        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $multiplicador;
            $multiplicador = ($multiplicador == 2) ? 9 : $multiplicador - 1;
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        return $cnpj[13] == $digito2;
    }

    /**
     * Relacionamento com fornecedores próprios
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class)->where('type', 'company');
    }

    /**
     * Relacionamento com categorias
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
