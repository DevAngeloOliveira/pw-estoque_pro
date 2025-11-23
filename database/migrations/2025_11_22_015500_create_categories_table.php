<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#3b82f6'); // Cor em hexadecimal
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['company_id', 'active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
