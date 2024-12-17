<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KatalogKolomHardCopy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_mst_prd_ktg', function (Blueprint $table) {
            $table->string('hard_copy', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_mst_prd_ktg', function (Blueprint $table) {
            $table->dropColumn('hard_copy');
        });
    }
}
