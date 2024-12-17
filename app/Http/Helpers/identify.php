<?php

namespace App\Http\Helpers;

use App\Models\tb_mst_prd as tbProduk;
use App\Models\tb_mst_prd_prc as tbHarga;
use App\Models\tb_mst_dsp as tbDisplay;
use App\Models\tb_act_set as tbSetting;

class identify
{
    public static function produk_harga($id)
    {
        $tbHarga = new tbHarga();
        $tbProduk = new tbProduk();
        $tbDisplay = new tbDisplay();

        $res_company = $tbHarga
            ->leftjoin($tbProduk->get_table() . ' AS A', $tbHarga->get_table() . '.produk_id', '=', 'A.id')
            ->leftjoin($tbDisplay->get_table() . ' AS B', 'A.display_id', '=', 'B.id')
            ->selectRaw(
                $tbHarga->get_table() . ".*,
                COALESCE(B.holder_id, '') AS holder_id"
            )
            ->where($tbHarga->get_table() . '.id', $id)
            ->get();

        return $res_company;
    }
}
