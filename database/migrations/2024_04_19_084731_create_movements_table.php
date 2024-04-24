<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('warehouse')->default(false);
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('movement_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('flow');
            $table->timestamps();
        });

        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('product_variant_id');
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->integer('customer_id');
            $table->integer('store_id');
            $table->integer('pos_id');
            $table->integer('movement_type_id');
            $table->integer('qty');
            $table->decimal('total_db', total: 8, places: 2);
            $table->decimal('total_cr', total: 8, places: 2);
            $table->boolean('status');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
        Schema::dropIfExists('movement_types');
        Schema::dropIfExists('stores');
    }
};
