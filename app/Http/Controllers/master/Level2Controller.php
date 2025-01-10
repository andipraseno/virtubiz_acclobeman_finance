<?php

namespace App\Http\Controllers\master;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\tb_mst_coa_lv2 as tbLevel2;
use App\Models\tb_mst_coa_lv1 as tbLevel1;

class Level2Controller extends BaseController
{
    public function index()
    {
        $tbLevel2 = new tbLevel2();
        $tbLevel1 = new tbLevel1();

        $post = $tbLevel2
            ->join($tbLevel1->get_table() . ' AS A', $tbLevel2->get_table() . '.level1_id', '=', 'A.id')
            ->select(
                $tbLevel2->get_table() . '.*',
                'A.nama AS level1_nama',
            )
            ->orderBy('A.id')
            ->orderBy($tbLevel2->get_table() . '.id')
            ->get();

        $groupedCategories = [];

        foreach ($post as $category) {
            // Cek apakah level1_id sudah ada di array
            if (!isset($groupedCategories[$category->level1_id])) {
                // Jika belum, buat grup baru
                $groupedCategories[$category->level1_id] = [
                    'level1_id' => $category->level1_id,
                    'level1_nama' => $category->level1_nama,
                    'level2s' => []
                ];
            }

            // Tambahkan level ke dalam grup yang sesuai
            $groupedCategories[$category->level1_id]['level2s'][] = [
                'id' => $category->id,
                'nama' => $category->nama,
                'status' => $category->status
            ];
        }

        $addon = [
            "post" => $groupedCategories,
        ];

        return view("master.level2.main", $addon);
    }

    public function add($level1_id)
    {
        $tbLevel1 = new tbLevel1();

        $post = $tbLevel1
            ->where('id', $level1_id)
            ->get();

        $level1_nama = $post->pluck('nama')[0];

        $addon = [
            "level1_id" => $level1_id,
            "level1_nama" => $level1_nama,
            "post" => []
        ];

        return view("master.level2.add", $addon);
    }

    public function edit($level_id)
    {
        $tbLevel1 = new tbLevel1();
        $tbLevel2 = new tbLevel2();

        $post = $tbLevel2
            ->join($tbLevel1->get_table() . ' AS A', $tbLevel2->get_table() . '.level1_id', '=', 'A.id')
            ->select(
                $tbLevel2->get_table() . '.*',
                'A.nama AS level1_nama'
            )
            ->where($tbLevel2->get_table() . '.id', $level_id)
            ->get();

        $level1_id = $post->pluck('level1_id')[0];
        $level1_nama = $post->pluck('level1_nama')[0];

        $addon = [
            "level1_id" => $level1_id,
            "level1_nama" => $level1_nama,
            "post" => $post,
        ];

        return view("master.level2.add", $addon);
    }

    public function save(Request $request)
    {
        // Ambil input request
        $id = $request->input('id');
        $nama = $request->input('nama');
        $level1_id = $request->input('level1_id');

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
        $tbLevel2 = new tbLevel2();

        $tbLevel2->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'nama' => $nama,
                'level1_id' => $level1_id,
                'created_by' => Session::get('actasys_user_nama'),
            ]
        );

        return back()->with('formSuccess', 'Data telah disimpan!');
    }

    public function terminate($level_id)
    {
        $tbLevel2 = new tbLevel2();

        $tbLevel2
            ->where('id', $level_id)
            ->update([
                "status" => 0,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/level');
    }

    public function activate($level_id)
    {
        $tbLevel2 = new tbLevel2();

        $tbLevel2
            ->where('id', $level_id)
            ->update([
                "status" => 1,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/level');
    }
}
