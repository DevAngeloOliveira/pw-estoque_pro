<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_type',
        'user_id',
        'action',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Relacionamento com a empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relacionamento polimórfico com o registro auditado
     */
    public function auditable()
    {
        return $this->morphTo();
    }

    /**
     * Relacionamento polimórfico com o usuário que fez a ação
     */
    public function user()
    {
        return $this->morphTo();
    }

    /**
     * Retorna descrição legível da ação
     */
    public function getActionLabelAttribute()
    {
        $labels = [
            'created' => 'Criado',
            'updated' => 'Atualizado',
            'deleted' => 'Excluído',
        ];

        return $labels[$this->action] ?? $this->action;
    }

    /**
     * Retorna nome do modelo de forma legível
     */
    public function getModelNameAttribute()
    {
        $names = [
            'App\Models\Product' => 'Produto',
            'App\Models\ProductMovement' => 'Movimentação',
            'App\Models\Company' => 'Empresa',
        ];

        return $names[$this->auditable_type] ?? class_basename($this->auditable_type);
    }
}
