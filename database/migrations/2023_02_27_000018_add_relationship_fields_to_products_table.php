<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('etalase_id')->nullable();
            $table->foreign('etalase_id', 'etalase_fk_8093832')->references('id')->on('etalases');
        });
    }
}
