<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->text('images')->nullable(); // O puedes usar json si prefieres
        });
    }
    
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
    
};
