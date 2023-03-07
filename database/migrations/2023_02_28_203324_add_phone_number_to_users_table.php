<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('enable_whatsapp')->after('discord_id')->default(false);
            $table->string('phone_number')->after('enable_whatsapp')->nullable();
            $table->boolean('phone_number_verified')->after('phone_number')->default(false);
        });
    }
};
