<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMasterProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('tb_mst_prd', 'tb_mst_prd');
        Schema::rename('tb_mst_prd_brn', 'tb_mst_prd_brn');
        Schema::rename('tb_mst_prd_dtl', 'tb_mst_prd_dtl');
        Schema::rename('tb_mst_prd_grd', 'tb_mst_prd_grd');
        Schema::rename('tb_mst_prd_kat', 'tb_mst_prd_kat');
        Schema::rename('tb_mst_prd_ktg', 'tb_mst_prd_ktg');
        Schema::rename('tb_mst_prd_sat', 'tb_mst_prd_sat');
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
