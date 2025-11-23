<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    /**
     * Boot do trait
     */
    public static function bootAuditable()
    {
        // Auditar quando criar
        static::created(function ($model) {
            $model->auditAction('created');
        });

        // Auditar quando atualizar
        static::updated(function ($model) {
            $model->auditAction('updated', $model->getOriginal());
        });

        // Auditar quando deletar
        static::deleted(function ($model) {
            $model->auditAction('deleted', $model->getOriginal());
        });
    }

    /**
     * Registra a ação de auditoria
     */
    protected function auditAction($action, $oldValues = [])
    {
        // Pega apenas atributos relevantes (remove timestamps se configurado)
        $newValues = $this->getAuditableAttributes();

        // Remove valores iguais quando for update
        if ($action === 'updated' && !empty($oldValues)) {
            $oldValues = array_intersect_key($oldValues, $newValues);
            $changes = [];
            foreach ($newValues as $key => $value) {
                if (!array_key_exists($key, $oldValues) || $oldValues[$key] != $value) {
                    $changes[$key] = $value;
                }
            }

            // Se não houve mudanças reais, não audita
            if (empty($changes)) {
                return;
            }

            $newValues = $changes;
            $oldValues = array_intersect_key($oldValues, $changes);
        }

        AuditLog::create([
            'company_id' => $this->company_id ?? tenant_id(),
            'user_type' => auth()->guard('company')->check() ? 'App\Models\Company' : null,
            'user_id' => auth()->guard('company')->id(),
            'action' => $action,
            'auditable_type' => get_class($this),
            'auditable_id' => $this->id,
            'old_values' => $action !== 'created' ? $oldValues : null,
            'new_values' => $action !== 'deleted' ? $newValues : null,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Retorna atributos auditáveis
     * Sobrescreva este método no model para customizar
     */
    protected function getAuditableAttributes()
    {
        $attributes = $this->getAttributes();

        // Remove atributos que não devem ser auditados
        $excluded = array_merge(
            ['created_at', 'updated_at', 'remember_token', 'password'],
            $this->excludeFromAudit ?? []
        );

        return array_diff_key($attributes, array_flip($excluded));
    }

    /**
     * Relacionamento com audit logs
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable')->latest();
    }
}
