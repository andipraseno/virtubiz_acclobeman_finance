<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NamaOnTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_trs_sls_krm', function (Blueprint $table) {
            $table->string('customer_nama', 100)->nullable();
            $table->string('customer_alamat', 200)->nullable();
            $table->string('customer_telepon', 100)->nullable();
        });

        Schema::table('tb_trs_sls_ord', function (Blueprint $table) {
            $table->string('customer_nama', 100)->nullable();
            $table->string('customer_alamat', 200)->nullable();
            $table->string('customer_telepon', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_trs_sls_krm', function (Blueprint $table) {
            $table->dropColumn('customer_nama');
            $table->dropColumn('customer_alamat');
            $table->dropColumn('customer_telepon');
        });

        Schema::table('tb_trs_sls_krm', function (Blueprint $table) {
            $table->dropColumn('customer_nama');
            $table->dropColumn('customer_alamat');
            $table->dropColumn('customer_telepon');
        });
    }
}
