<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_no')->unsigned()->unique();
            $table->string('customer_name');
            $table->string('customer_type');
            $table->string('personal_id');
            $table->string('address');
            $table->string('postcode');
            $table->string('city');
            $table->string('gln')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email_invoice')->nullable();
            $table->string('email_cc')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
