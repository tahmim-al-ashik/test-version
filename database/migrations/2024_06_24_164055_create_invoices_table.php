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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('invoice_category_id')->nullable();
            $table->unsignedBigInteger('invoice_setting_id'); // Add this line for the direct relationship
            $table->date('invoice_date');
            $table->date('delivery_date')->nullable();
            $table->json('products');
            $table->text('notes')->nullable();
            $table->text('payment_details')->nullable();
            $table->string('qr_link')->nullable();
            $table->enum('status', ['draft', 'complete','rejected'])->default('draft');
            $table->decimal('total_price_excluding_vat', 10, 2)->nullable();
            $table->decimal('total_price_including_vat', 10, 2)->nullable();
            $table->decimal('received_money', 10, 2)->default(0);
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->enum('transaction_type', ['in', 'out'])->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('invoice_category_id')->references('id')->on('invoice_categories')->onDelete('cascade');
            $table->foreign('invoice_setting_id')->references('id')->on('invoice_settings')->onDelete('cascade'); // Add this line for the foreign key constraint
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
