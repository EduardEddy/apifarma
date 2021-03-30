<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->decimal('subtotal', 10, 2)->default(0.0);
            $table->enum('status', [
                'pedido enviado',
                'aceptado',
                'cancelado tienda',
                'cancelado usuario',
                'enviado',
                'entregado'])->default('pedido enviado');
            $table->enum('delivery', ['domicilio', 'local'])->default('domicilio');
            $table->text('comment_store')->nullable();
            $table->text('comment_user')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
