<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('publish_date');
            $table->string('image')->nullable(); // Para subir imágenes
            $table->integer('n_likes')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con users
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('posts');
    }
};

