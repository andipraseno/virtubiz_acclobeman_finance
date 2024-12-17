<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomEkspedisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_mst_exp', function (Blueprint $table) {
            $table->string('alamat', 150)->nullable();
            $table->string('telepon', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_mst_exp', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('telepon');
        });
    }
}
