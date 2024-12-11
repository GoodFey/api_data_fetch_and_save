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
        Schema::create('data_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('income_id');
            $table->string('number')->nullable();
            $table->date('date');
            $table->date('last_change_date');
            $table->char('supplier_article', 16);
            $table->char('tech_size', 16);
            $table->Integer('barcode');
            $table->SmallInteger('quantity');
            $table->TinyInteger('total_price')->nullable();
            $table->date('date_close');
            $table->tinyText('warehouse_name');
            $table->integer('nm_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_incomes');
    }
};
