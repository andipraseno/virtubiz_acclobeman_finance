<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTransferMutasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_trs_inv_mts', function (Blueprint $table) {
            $table->integer('gudanghasil_id')->nullable();
        });
        Schema::table('tb_trs_inv_ovz', function (Blueprint $table) {
            $table->integer('gudanghasil_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_trs_inv_mts', function (Blueprint $table) {
            $table->dropColumn('gudanghasil_id');
        });
        Schema::table('tb_trs_inv_ovz', function (Blueprint $table) {
            $table->dropColumn('gudanghasil_id');
        });
    }
}
