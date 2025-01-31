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
        Schema::create('profesor', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre', length: 32)->nullable($value = false);
            $table->string('telefono', length: 16)->nullable($value = true);
            $table->integer('edad')->nullable($value = true);
            $table->string('password', length: 64)->nullable($value = false);
            $table->string('email', length: 64)->unique();
            $table->string('sexo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
