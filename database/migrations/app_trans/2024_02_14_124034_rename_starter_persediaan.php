<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStarterPersediaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('tb_str_stk', 'tb_trs_inv_str');
        Schema::rename('tb_str_stk_dtl', 'tb_trs_inv_str_dtl');
        Schema::rename('tb_str_stk_dtl_sub', 'tb_trs_inv_str_dtl_sub');
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
