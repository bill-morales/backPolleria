<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('platillos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('descripcion');
            $table->decimal('precio', 8, 2);
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();
            $table->foreign('subcategory_id')
                ->references('id')->on('subcategories')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platillos');
    }
};
