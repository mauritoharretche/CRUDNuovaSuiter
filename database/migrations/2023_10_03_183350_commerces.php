<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commerces', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('categoria')->nullable();
            $table->foreign('categoria')->references('id')->on('categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        //
    }
};