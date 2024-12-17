<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableSupplierExpedisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mst_exp_spl', function (Blueprint $table) {
            $table->id();
            $table->integer('ekspedisi_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->timestamps();
            $table->string('created_by', 100)->nullable();
            $table->string('updated_by', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_mst_exp_spl');
    }
}
