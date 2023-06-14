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
        Schema::create('profile_users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('apellidos',255);
            $table->string('dni',9)->unique();
            $table->string('poblacion',255);
            $table->string('provincia',255);
            $table->string('direccion',255);
            $table->string('telefono',9);
            $table->string('facebook',255)->nullable();
            $table->string('instagram',255)->nullable();
            $table->string('twitter',255)->nullable();
            $table->string('linkedin',255)->nullable();
            $table->boolean('active')->default('1');
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_users');
    }
};
