<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('stock')->after('price')->default(0);
            $table->integer('portion_size')->after('stock')->default(1);
            $table->boolean('backorder_allowed')->after('portion_size')->default(false);
        });
    }
};
