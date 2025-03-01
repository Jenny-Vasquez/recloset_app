<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Creo las categorías por defecto
        DB::table('categories')->insert([
            ['name' => 'Ropa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Calzado', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bolsos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accesorios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tecnología', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Deporte', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Libros', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Otros', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
