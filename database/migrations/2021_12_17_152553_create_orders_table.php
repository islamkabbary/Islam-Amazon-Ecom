<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('panding');
            $table->integer('total');
            $table->boolean('paid');
            $table->string('note');
            $table->integer('sub_total')->nullable();
            $table->integer('discount_value')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
