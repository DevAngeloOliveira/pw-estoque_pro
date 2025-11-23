<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->string('user_type')->nullable(); // Tipo de usuário (Company, User, etc)
            $table->unsignedBigInteger('user_id')->nullable(); // ID do usuário que fez a ação
            $table->string('action'); // created, updated, deleted
            $table->string('auditable_type'); // Model afetado (Product, ProductMovement, etc)
            $table->unsignedBigInteger('auditable_id'); // ID do registro afetado
            $table->text('old_values')->nullable(); // JSON com valores antigos
            $table->text('new_values')->nullable(); // JSON com valores novos
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            // Índices para melhor performance
            $table->index(['company_id', 'created_at']);
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}
