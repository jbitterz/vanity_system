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
        // Indexes already added in previous migration
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_brand_index'); // use actual index name
        });
    
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_user_id_index');
        });
    
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex('order_items_order_id_index');
        });
    
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropIndex('addresses_user_id_index');
        });
    }
};    