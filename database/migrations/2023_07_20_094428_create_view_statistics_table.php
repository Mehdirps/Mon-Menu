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
        Schema::create('view_statistics', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->string('url');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('viewed_at')->useCurrent();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_statistics');
    }
};
