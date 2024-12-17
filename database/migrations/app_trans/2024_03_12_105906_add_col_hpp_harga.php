<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColHppHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_mst_hrg', function (Blueprint $table) {
            $table->double('hpp')->nullable();
            $table->double('qty11')->nullable();
            $table->double('qty12')->nullable();
            $table->double('harga1')->nullable();
            $table->double('qty21')->nullable();
            $table->double('qty22')->nullable();
            $table->double('harga2')->nullable();
            $table->double('qty31')->nullable();
            $table->double('qty32')->nullable();
            $table->double('harga3')->nullable();
            $table->double('qty41')->nullable();
            $table->double('qty42')->nullable();
            $table->double('harga4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
