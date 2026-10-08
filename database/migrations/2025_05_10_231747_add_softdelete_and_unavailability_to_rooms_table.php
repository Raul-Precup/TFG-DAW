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
        Schema::table('rooms', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
            $table->date('unavailable_from')->nullable();
            $table->date('unavailable_to')->nullable();
            $table->softDeletes(); // Esto crea la columna deleted_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'unavailable_from', 'unavailable_to', 'deleted_at']);
        });
    }

};
