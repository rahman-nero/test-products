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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumer_id');
            $table->string('product_title');
            $table->integer('min_price');
            $table->integer('max_price');

            // Тут можно было бы создать отдельную таблицу где указать все качества которые может пользователь передавать
            // Но я оставил как есть, ибо обычно бывает только "новый" и "Б/у".
            $table->enum('product_quality', [
                'new',
                'used',
            ]);
            $table->timestamps();

            // Если удалим покупателя, то все его запросы удалятся
            $table->foreign('consumer_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
