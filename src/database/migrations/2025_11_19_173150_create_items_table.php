<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('出品者ID');
            $table->string('name')->comment('商品名');
            $table->string('image_url')->nullable()->comment('商品画像URL');
            $table->boolean('is_sold')->default(false)->comment('購入済みフラグ');
            $table->integer('price')->comment('価格');
            $table->text('description')->nullable()->comment('商品説明');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
