<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTenantIsolation
{
    /**
     * Handle an incoming request.
     * Garante que apenas a empresa logada tenha acesso aos próprios dados (tenant isolation)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se há uma empresa autenticada
        if (!auth()->guard('company')->check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado como empresa.');
        }

        // Disponibiliza o ID da empresa logada globalmente para uso em toda aplicação
        config(['app.current_tenant_id' => auth()->guard('company')->id()]);

        return $next($request);
    }
}
