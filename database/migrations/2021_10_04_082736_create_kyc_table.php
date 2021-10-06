<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('address');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('id_card_attachment');
            $table->string('selfie_id_card_attachment');
            $table->enum('approval', ['Approved', 'Not Approved']);
            $table->text('message');
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
        Schema::dropIfExists('kyc');
    }
}
