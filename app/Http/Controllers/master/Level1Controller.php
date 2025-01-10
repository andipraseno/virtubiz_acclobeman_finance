<?php

namespace App\Http\Controllers\master;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\tb_mst_coa_lv1 as tbLevel1;

class Level1Controller extends BaseController
{
    public function index()
    {
        $tbLevel1 = new tbLevel1();

        $post = $tbLevel1
            ->orderBy('nama')
            ->get();

        $addon = [
            "post" => $post,
        ];

        return view("master.level1.main", $addon);
    }

    public function add()
    {
        $addon = [
            "post" => []
        ];

        return view("master.level1.add", $addon);
    }

    public function edit($id)
    {
        $tbLevel1 = new tbLevel1();

        $post = $tbLevel1
            ->where('id', $id)
            ->get();

        $addon = [
            "post" => $post,
        ];

        return view("master.level1.add", $addon);
    }

    public function save(Request $request)
    {
        // Ambil input request
        $id = $request->input('id');
        $nama = $request->input('nama');
        $tipe = $request->input('tipe');

        // Validasi input
        $errList = [
            'nama' => ['required'],
        ];

        $errMessage = [
            'nama.required' => 'Tidak boleh kosong!',
        ];

        $errResult = Validator::make(
            $request->all(),
            $errList,
            $errMessage
        );

        // Handle error jika validasi gagal
        if ($errResult->fails()) {
            return back()->withErrors($errResult)
                ->withInput();
        }

        // Update atau insert data
        $tbLevel1 = new tbLevel1();

        if ($id == '') {
            $tbLevel1->create([
                'company_id' => Session::get('actasys_company_id'),
                'nama' => $nama,
                'tipe' => $tipe,
                'created_by' => Session::get('actasys_user_nama'),
            ]);
        } else {
            $tbLevel1
                ->where('id', $id)
                ->update([
                    'nama' => $nama,
                    'tipe' => $tipe,
                    'updated_by' => Session::get('actasys_user_nama'),
                ]);
        }

        return back()->with('formSuccess', 'Data telah disimpan!');
    }

    public function terminate($id)
    {
        $tbLevel1 = new tbLevel1();

        $tbLevel1
            ->where('id', $id)
            ->update([
                "status" => 0,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/level1');
    }

    public function activate($id)
    {
        $tbLevel1 = new tbLevel1();

        $tbLevel1
            ->where('id', $id)
            ->update([
                "status" => 1,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/level1');
    }
}
