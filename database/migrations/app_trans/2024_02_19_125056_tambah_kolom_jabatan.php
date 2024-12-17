<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_act_kry_lev', function (Blueprint $table) {
            $table->integer('can_unlock')->nullable()->default(0);
            $table->integer('can_reject')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_act_kry_lev', function (Blueprint $table) {
            $table->dropColumn('can_unlock');
            $table->dropColumn('can_reject');
        });
    }
}
