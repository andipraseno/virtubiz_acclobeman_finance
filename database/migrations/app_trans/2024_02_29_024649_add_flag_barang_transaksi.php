<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagProdukTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_trs_prc_rcv_dtl', function (Blueprint $table) {
            $table->integer('flag')->nullable()->default(1);
        });

        Schema::table('tb_trs_prc_rcv_dtl_sub', function (Blueprint $table) {
            $table->integer('flag')->nullable()->default(1);
        });

        Schema::table('tb_trs_sls_krm_dtl', function (Blueprint $table) {
            $table->integer('flag')->nullable()->default(1);
        });

        Schema::table('tb_trs_sls_krm_dtl_sub', function (Blueprint $table) {
            $table->integer('flag')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_trs_prc_rcv_dtl', function (Blueprint $table) {
            $table->dropColumn('flag');
        });

        Schema::table('tb_trs_prc_rcv_dtl_sub', function (Blueprint $table) {
            $table->dropColumn('flag');
        });

        Schema::table('tb_trs_prc_rcv_dtl', function (Blueprint $table) {
            $table->dropColumn('flag');
        });

        Schema::table('tb_trs_sls_krm_dtl', function (Blueprint $table) {
            $table->dropColumn('flag');
        });

        Schema::table('tb_trs_sls_krm_dtl_sub', function (Blueprint $table) {
            $table->dropColumn('flag');
        });
    }
}
