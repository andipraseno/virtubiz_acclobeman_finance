<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiskon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_trs_prc_ord_dtl', function (Blueprint $table) {
            $table->double('disc_persen')->nullable()->default(0);
            $table->double('disc_nilai')->nullable()->default(0);
        });

        Schema::table('tb_trs_prc_rcv_dtl', function (Blueprint $table) {
            $table->double('disc_persen')->nullable()->default(0);
            $table->double('disc_nilai')->nullable()->default(0);
        });

        Schema::table('tb_trs_sls_ord_dtl', function (Blueprint $table) {
            $table->double('disc_persen')->nullable()->default(0);
            $table->double('disc_nilai')->nullable()->default(0);
        });

        Schema::table('tb_trs_sls_krm_dtl', function (Blueprint $table) {
            $table->double('disc_persen')->nullable()->default(0);
            $table->double('disc_nilai')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_trs_prc_ord_dtl', function (Blueprint $table) {
            $table->dropColumn('disc_persen');
            $table->dropColumn('disc_nilai');
        });

        Schema::table('tb_trs_prc_rcv_dtl', function (Blueprint $table) {
            $table->dropColumn('disc_persen');
            $table->dropColumn('disc_nilai');
        });

        Schema::table('tb_trs_sls_ord_dtl', function (Blueprint $table) {
            $table->dropColumn('disc_persen');
            $table->dropColumn('disc_nilai');
        });

        Schema::table('tb_trs_sls_krm_dtl', function (Blueprint $table) {
            $table->dropColumn('disc_persen');
            $table->dropColumn('disc_nilai');
        });
    }
}
