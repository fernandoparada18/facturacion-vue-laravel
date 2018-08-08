<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->decimal('iva', 10,2);
            $table->decimal('subTotal', 10,2);
            $table->decimal('total', 10,2);
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('quantity', 10,2);
            $table->decimal('unitPrice', 10,2);
            $table->decimal('total', 10,2);
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
    }
}
