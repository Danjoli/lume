<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('gateway_customer_id')->nullable()->after('gateway_payment_id');
            $table->text('payment_url')->nullable();
            $table->text('bank_slip_url')->nullable();
            $table->longText('pix_payload')->nullable();
            $table->longText('pix_qr_code')->nullable();
            $table->date('payment_due_date')->nullable();
            $table->string('gateway_status')->nullable();
            $table->text('gateway_error')->nullable();
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->string('melhor_envio_order_id')->nullable()->index();
            $table->string('melhor_envio_protocol')->nullable();
            $table->text('label_url')->nullable();
            $table->text('tracking_url')->nullable();
            $table->unsignedSmallInteger('delivery_min_days')->nullable();
            $table->unsignedSmallInteger('delivery_max_days')->nullable();
            $table->json('tracking_history')->nullable();
            $table->json('gateway_payload')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['gateway_customer_id', 'payment_url', 'bank_slip_url', 'pix_payload', 'pix_qr_code', 'payment_due_date', 'gateway_status', 'gateway_error']);
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->dropIndex(['melhor_envio_order_id']);
            $table->dropColumn(['melhor_envio_order_id', 'melhor_envio_protocol', 'label_url', 'tracking_url', 'delivery_min_days', 'delivery_max_days', 'tracking_history', 'gateway_payload']);
        });
    }
};
