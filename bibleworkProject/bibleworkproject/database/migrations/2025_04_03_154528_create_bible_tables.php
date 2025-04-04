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
        
        Schema::create('bible', function (Blueprint $table) {
            $table->id();
            $table->string('title_short');
            $table->string('c');
            $table->string('v');
            $table->string('t');
            $table->timestamps();
        });
         

        if (!Schema::hasTable('book_info')) {
            Schema::create('book_info', function (Blueprint $table) {
                $table->id();
                $table->string('order');
                $table->string('title');
                $table->timestamps();
            });
        }
    }

   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible');
        Schema::dropIfExists('book_info');
    }
};
