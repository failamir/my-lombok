<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('condition')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('video_product')->nullable();
            $table->string('status_product')->nullable();
            $table->integer('stock')->nullable();
            $table->string('sku')->nullable();
            $table->integer('minimum_order')->nullable();
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->decimal('wholesale_price', 15, 2)->nullable();
            $table->float('weight', 15, 2)->nullable();
            $table->float('long', 15, 2)->nullable();
            $table->float('width', 15, 2)->nullable();
            $table->float('height', 15, 2)->nullable();
            $table->string('insurance')->nullable();
            $table->string('pre_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
