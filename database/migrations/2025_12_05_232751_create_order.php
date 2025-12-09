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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            // USER
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // NOMOR ORDER
            $table->string('order_number')->unique();

            // CONTACT INFORMATION
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');

            // ALAMAT PENGIRIMAN
            $table->text('address');

            // SHIPPING
            $table->string('shipping_method');
            // contoh: JNE Regular, SiCepat, GoSend
            $table->decimal('shipping_cost', 12, 2);

            // PAYMENT
            $table->enum('payment_method', ['transfer', 'qris', 'cod']);
            $table->string('payment_proof')->nullable();
            // untuk upload bukti transfer
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

            // TOTAL
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total_price', 12, 2);

            // STATUS ORDER
            $table->enum('status', [
                'pending',       // baru dibuat
                'paid',          // sudah dibayar
                'processed',     // dikemas
                'shipped',       // dikirim
                'delivered',     // diterima
                'cancelled',
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
