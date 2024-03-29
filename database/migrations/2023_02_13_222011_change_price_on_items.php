<?php

use Cknow\Money\Money;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Item::all()->each(function ($item) {
            $moneyObject = Money::parseByIntl($item->price, 'EUR');
            $item->price = $moneyObject;
            $item->save();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->integer('price')->change();
        });
    }
};
