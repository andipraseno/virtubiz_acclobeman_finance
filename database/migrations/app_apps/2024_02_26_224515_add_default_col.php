<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_act_brc', function (Blueprint $table) {
            $table->integer('gudang_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('customer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_act_brc', function (Blueprint $table) {
            $table->dropColumn('gudang_id');
            $table->dropColumn('supplier_id');
            $table->dropColumn('customer_id');
        });
    }
}
