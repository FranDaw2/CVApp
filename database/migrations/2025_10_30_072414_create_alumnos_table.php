<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); 
            $table->string('apellidos', 150);
            $table->string('telefono', 30)->nullable();
            $table->string('correo', 150);
            $table->date('fecha_nacimiento')->nullable();
            $table->decimal('nota_media', 3, 2)->nullable(); 
            $table->text('experiencia')->nullable();
            $table->text('formacion')->nullable();
            $table->text('habilidades')->nullable();
            $table->string('fotografia', 255)->nullable(); // ruta en storage/app/public
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('alumnos');
    }
};
