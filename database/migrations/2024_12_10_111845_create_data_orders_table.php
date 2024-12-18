<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts');
            $table->char('g_number', 20);
            $table->date('date');
            $table->date('last_change_date');
            $table->char('supplier_article', 16);
            $table->char('tech_size', 16);
            $table->Integer('barcode');
            $table->double('total_price');
            $table->tinyInteger('discount_percent')->nullable();
            $table->tinyText('warehouse_name');
            $table->tinyText('oblast')->nullable();
            $table->unsignedInteger('income_id')->nullable();
            $table->tinyInteger('odid');
            $table->Integer('nm_id');
            $table->char('subject', 16);
            $table->char('category', 16);
            $table->char('brand', 16);
            $table->boolean('is_cancel')->nullable();
            $table->date('cancel_dt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_orders');
    }
};
