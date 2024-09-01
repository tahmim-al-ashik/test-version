<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('company_person_name');
            $table->json('emails')->nullable();
            $table->json('phones')->nullable();
            $table->unsignedBigInteger('base_currency_id');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->json('social_media_links')->nullable();
            $table->string('invoice_created_by')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('watermark_logo_path')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('base_currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};
