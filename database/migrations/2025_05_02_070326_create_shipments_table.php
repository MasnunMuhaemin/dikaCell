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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->dateTime('shipment_date');
            $table->string('alamat_lengkap', 100);
            $table->string('kota', 100);
            $table->string('kecamatan', 20);
            $table->string('desa', 50);
            $table->string('kode_pos', 10);
            $table->decimal('shipping_cost', 12, 2);
            $table->enum('shipping_status', ['belum dikirim', 'dikirim', 'diterima'])->default('belum dikirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
