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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable();
            $table->string('title')->nullable();
            $table->string('website_name')->nullable();
            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('secondary_email')->nullable();
            $table->text('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('yahoo')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
