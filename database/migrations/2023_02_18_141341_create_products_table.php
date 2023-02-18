<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->string('title', 255);

            // Так как в ТЗ не было сказано про сохранений копеек, поэтому использовал integer
            $table->integer('price')->default(0);

            // Тут можно было бы создать отдельную таблицу где указать все качества которые может пользователь передавать
            // Но я оставил как есть, ибо обычно бывает только "новый" и "Б/у".
            $table->enum('quality', [
                'new',
                'used'
            ]);

            $table->timestamps();

            // Если удалим продавца, то все его товары удалятся
            $table->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });

        /*
         *     - id
    - title
    - price
    - quality
         * */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
