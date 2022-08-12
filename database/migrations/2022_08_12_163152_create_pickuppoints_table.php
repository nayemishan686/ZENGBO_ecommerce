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
        Schema::create('pickuppoints', function (Blueprint $table) {
            $table->id();
            $table->string('pickUpPointName');
            $table->string('pickUpPointAddress');
            $table->string('pickUpPointPhone');
            $table->string('pickUpPointPhoneTwo')->nullable();
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
        Schema::dropIfExists('pickuppoints');
    }
};
