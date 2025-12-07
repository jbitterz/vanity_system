<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!DB::getSchemaBuilder()->hasIndex('products', 'products_brand_index')) {
            Schema::table('products', function (Blueprint $table) {
                $table->index('brand');
            });
        }

        if (!DB::getSchemaBuilder()->hasIndex('orders', 'orders_user_id_index')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->index('user_id');
            });
        }

        if (!DB::getSchemaBuilder()->hasIndex('order_items', 'order_items_order_id_index')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->index('order_id');
            });
        }

        // Addresses index already handled in its own migration
    }

    public function down(): void
    {
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropIndex('products_brand_index');
            });
        }

        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropIndex('orders_user_id_index');
            });
        }

        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropIndex('order_items_order_id_index');
            });
        }
    }
};
