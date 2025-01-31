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
        Schema::create('asignatura_alumno', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('asignatura_id')->references("id")->on('asignatura');
            $table->foreignId('alumno_id')->references("id")->on('alumno');

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
