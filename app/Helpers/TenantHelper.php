<?php

if (!function_exists('tenant_id')) {
    /**
     * Retorna o ID da empresa (tenant) logada
     *
     * @return int|null
     */
    function tenant_id()
    {
        return auth()->guard('company')->id();
    }
}

if (!function_exists('tenant')) {
    /**
     * Retorna a empresa (tenant) logada
     *
     * @return \App\Models\Company|null
     */
    function tenant()
    {
        return auth()->guard('company')->user();
    }
}

if (!function_exists('tenant_check')) {
    /**
     * Verifica se há uma empresa logada
     *
     * @return bool
     */
    function tenant_check()
    {
        return auth()->guard('company')->check();
    }
}
