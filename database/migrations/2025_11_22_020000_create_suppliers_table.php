<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->boolean('is_global')->default(false);
            $table->string('name');
            $table->string('legal_name')->nullable();
            $table->string('cnpj', 18)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('website')->nullable();

            // Endereço
            $table->string('address')->nullable();
            $table->string('address_number', 20)->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip_code', 10)->nullable();

            // Informações adicionais
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Índices
            $table->index(['company_id', 'active']);
            $table->index(['is_global', 'active']);
            $table->index('cnpj');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
