<?php

namespace App\Http\Controllers\master;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Helpers\bilangan;

use App\Models\tb_mst_cos as tbCostCenter;

class CostCenterController extends BaseController
{
    public function index()
    {
        $tbCostCenter = new tbCostCenter();

        $post = $tbCostCenter
            ->orderBy('nama')
            ->get();

        $addon = [
            "post" => $post,
        ];

        return view("master.costcenter.main", $addon);
    }

    public function add()
    {
        $addon = [
            "post" => []
        ];

        return view("master.costcenter.add", $addon);
    }

    public function edit($id)
    {
        $tbCostCenter = new tbCostCenter();

        $post = $tbCostCenter
            ->where('id', $id)
            ->get();

        $addon = [
            "post" => $post,
        ];

        return view("master.costcenter.add", $addon);
    }

    public function save(Request $request)
    {
        // Ambil input request
        $id = $request->id;
        $nama = $request->nama;
        $plafond = bilangan::format_angka($request->input('plafond'));

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
        $tbCostCenter = new tbCostCenter();

        if ($id == '') {
            $tbCostCenter->create([
                'company_id' => Session::get('actasys_company_id'),
                'nama' => $nama,
                'plafond' => $plafond,
                'created_by' => Session::get('actasys_user_nama'),
            ]);
        } else {
            $tbCostCenter
                ->where('id', $id)
                ->update([
                    'nama' => $nama,
                    'plafond' => $plafond,
                    'updated_by' => Session::get('actasys_user_nama'),
                ]);
        }

        return back()->with('formSuccess', 'Data telah disimpan!');
    }

    public function terminate($id)
    {
        $tbCostCenter = new tbCostCenter();

        $tbCostCenter
            ->where('id', $id)
            ->update([
                "status" => 0,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/costcenter');
    }

    public function activate($id)
    {
        $tbCostCenter = new tbCostCenter();

        $tbCostCenter
            ->where('id', $id)
            ->update([
                "status" => 1,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/costcenter');
    }
}
