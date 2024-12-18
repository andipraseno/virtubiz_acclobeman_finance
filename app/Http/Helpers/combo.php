<?php

namespace App\Http\Helpers;

use App\Models\tb_mst_bro_kti as tbKategoriIklan;
use App\Models\tb_mst_klp as tbKelasPengunjung;
use App\Models\tb_mst_dsp_res as tbDisplayResolution;
use App\Models\tb_mst_dsp_ori as tbDisplayOrientation;

use App\Models\tb_trs_shp as tbShop;

use App\Models\tb_mst_spt_grp as tbGroupSpot;
use App\Models\tb_mst_prd_grp as tbGroupProduk;
use App\Models\tb_mst_kry_jbt as tbJabatan;
use App\Models\tb_mst_coa_lv1 as tbAkunLevel1;
use App\Models\tb_mst_coa_lv2 as tbAkunLevel2;
use App\Models\tb_mst_coa_lv3 as tbAkunLevel3;
use App\Models\tb_mst_coa as tbAkun;
use App\Models\tb_mst_cos as tbCostCenter;
use App\Models\tb_mst_shf as tbShift;
use App\Models\tb_mst_prd as tbProduk;
use App\Models\tb_mst_ses as tbSesi;

class combo
{
    public static function kategoriiklan()
    {
        $tbKategoriIklan = new tbKategoriIklan();

        $list = $tbKategoriIklan
            ->where('status', 1)
            ->orderBy('nama')
            ->get();

        return $list;
    }

    public static function kelas_pengunjung()
    {
        $tbKelasPengunjung = new tbKelasPengunjung();

        $list = $tbKelasPengunjung
            ->where('status', 1)
            ->orderBy('urutan')
            ->get();

        return $list;
    }

    public static function resolution()
    {
        $tbDisplayResolution = new tbDisplayResolution();

        $list = $tbDisplayResolution
            ->where('status', 1)
            ->get();

        return $list;
    }

    public static function orientasi()
    {
        $tbDisplayOrientation = new tbDisplayOrientation();

        $list = $tbDisplayOrientation
            ->where('status', 1)
            ->get();

        return $list;
    }

    public static function hitung_shopping_cart($brand_id)
    {
        $tbShop = new tbShop();

        $post = $tbShop
            ->where('brand_id', $brand_id)
            ->get();

        $jumlah = count($post);

        return $jumlah;
    }



    public static function groupspot($company_id)
    {
        $tbGroupSpot = new tbGroupSpot();

        $list = $tbGroupSpot
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->get();

        return $list;
    }

    public static function groupproduk($company_id)
    {
        $tbGroupProduk = new tbGroupProduk();

        $list = $tbGroupProduk
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->get();

        return $list;
    }

    public static function jabatan($company_id)
    {
        $tbJabatan = new tbJabatan();

        $list = $tbJabatan
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->get();

        return $list;
    }

    public static function akunlevel1($company_id)
    {
        $tbAkunLevel1 = new tbAkunLevel1();

        $list = $tbAkunLevel1
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->get();

        return $list;
    }

    public static function akunlevel2($company_id, $akunlevel1_id)
    {
        $tbAkunLevel2 = new tbAkunLevel2();

        $list = $tbAkunLevel2
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->where('akunlevel1_id', $akunlevel1_id)
            ->get();

        return $list;
    }

    public static function akunlevel3($company_id, $akunlevel2_id)
    {
        $tbAkunLevel3 = new tbAkunLevel3();

        $list = $tbAkunLevel3
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->where('akunlevel2_id', $akunlevel2_id)
            ->get();

        return $list;
    }

    public static function akun($company_id, $akunlevel3_id)
    {
        $tbAkun = new tbAkun();

        $list = $tbAkun
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->where('akunlevel3_id', $akunlevel3_id)
            ->get();

        return $list;
    }

    public static function costcenter($company_id)
    {
        $tbCostCenter = new tbCostCenter();

        $list = $tbCostCenter
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->get();

        return $list;
    }

    public static function shift($company_id)
    {
        $tbShift = new tbShift();

        $list = $tbShift
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->get();

        return $list;
    }

    public static function produk_olahraga($company_id)
    {
        $tbProduk = new tbProduk();

        $list = $tbProduk
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->where('group_id', '62702be7-b621-48e9-908c-aac45b6f6de3')
            ->orderBy('nama')
            ->get();

        return $list;
    }

    public static function sesi($company_id)
    {
        $tbSesi = new tbSesi();

        $list = $tbSesi
            ->where('status', 1)
            ->where('company_id', $company_id)
            ->orderBy('jam_dari')
            ->get();

        return $list;
    }
}
