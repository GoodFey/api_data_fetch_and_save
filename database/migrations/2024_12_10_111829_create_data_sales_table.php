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
        Schema::create('data_sales', function (Blueprint $table) {
            $table->id();
            $table->char('g_number', 20);
            $table->date('date');
            $table->date('last_change_date');
            $table->char('supplier_article', 16);
            $table->char('tech_size', 16);
            $table->Integer('barcode');
            $table->double('total_price');
            $table->tinyInteger('discount_percent');
            $table->boolean('is_supply')->nullable();
            $table->boolean('is_realization');
            $table->tinyText('promo_code_discount')->nullable();
            $table->tinyText('warehouse_name');
            $table->tinyText('country_name');
            $table->tinyText('oblast_okrug_name')->nullable();
            $table->tinyText('region_name')->nullable();
            $table->unsignedInteger('income_id')->nullable();
            $table->char('sale_id', 12);
            $table->tinyInteger('odid')->nullable();
            $table->tinyInteger('spp');
            $table->double('for_pay');
            $table->integer('finished_price');
            $table->integer('price_with_disc');
            $table->Integer('nm_id');
            $table->char('subject', 16);
            $table->char('category', 16);
            $table->char('brand', 16);
            $table->boolean('is_storno')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sales');
    }
};


