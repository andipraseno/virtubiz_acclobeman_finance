<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefaultData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_act_cpy', function (Blueprint $table) {
            $table->datetime('tanggal')->nullable();
            $table->datetime('bulan_dari')->nullable();
            $table->datetime('bulan_sampai')->nullable();
            $table->datetime('tahun_dari')->nullable();
            $table->datetime('tahun_sampai')->nullable();
            $table->integer('periode_tahun')->nullable();
            $table->integer('periode_bulan')->nullable();
            $table->integer('tarif_pajak')->nullable()->default(11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_act_cpy', function (Blueprint $table) {
            $table->dropColumn('tanggal');
            $table->dropColumn('bulan_dari');
            $table->dropColumn('bulan_sampai');
            $table->dropColumn('tahun_dari');
            $table->dropColumn('tahun_sampai');
            $table->dropColumn('periode_tahun');
            $table->dropColumn('periode_bulan');
            $table->dropColumn('tarif_pajak');
        });
    }
}
