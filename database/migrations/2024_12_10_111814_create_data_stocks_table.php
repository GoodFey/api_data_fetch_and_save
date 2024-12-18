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
        Schema::create('data_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts');
            $table->date("date");
            $table->date("last_change_date")->nullable();
            $table->char("supplier_article", 16)->nullable();
            $table->char("tech_size", 16)->nullable();
            $table->Integer("barcode");
            $table->smallInteger("quantity")->nullable();
            $table->boolean("is_supply")->nullable();
            $table->boolean("is_realization")->nullable();
            $table->smallInteger("quantity_full")->nullable();
            $table->tinyText("warehouse_name");
            $table->smallInteger("in_way_to_client")->nullable();
            $table->smallInteger("in_way_from_client")->nullable();
            $table->Integer("nm_id");
            $table->char("subject", 16)->nullable();
            $table->char("category", 16)->nullable();
            $table->char("brand", 16)->nullable();
            $table->unsignedInteger("sc_code")->nullable();
            $table->unsignedInteger("price");
            $table->smallInteger("discount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_stocks');
    }
};
