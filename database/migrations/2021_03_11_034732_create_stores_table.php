<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
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
            $table->string('business_name');
            $table->string('bussiness_id')->nullable();
            $table->string('country');
            $table->string('city');
            $table->longText('address');
            $table->string('lat');
            $table->string('lng');
            $table->boolean('is_open')->default(false);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_collaborator')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
