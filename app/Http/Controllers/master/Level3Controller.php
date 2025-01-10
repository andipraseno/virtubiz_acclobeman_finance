<?php

namespace App\Http\Controllers\master;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\tb_mst_coa_lv3 as tbLevel3;
use App\Models\tb_mst_coa_lv1 as tbLevel1;
use App\Models\tb_mst_coa_lv2 as tbLevel2;

class Level3Controller extends BaseController
{
    public function index()
    {
        $tbLevel3 = new tbLevel3();
        $tbLevel1 = new tbLevel1();
        $tbLevel2 = new tbLevel2();

        $post = $tbLevel1
            ->join($tbLevel2->get_table() . ' AS A', $tbLevel1->get_table() . '.id', '=', 'A.level1_id')
            ->leftjoin($tbLevel3->get_table() . ' AS B', 'A.id', '=', 'B.level2_id')
            ->selectRaw(
                $tbLevel1->get_table() . ".id AS level1_id," .
                    $tbLevel1->get_table() . ".nama AS level1_nama,
                A.id AS level2_id,
                A.nama AS level2_nama,
                COALESCE(B.id, '') AS id,
                COALESCE(B.nama, '') AS nama,
                COALESCE(B.status, '') AS status"
            )
            ->orderBy($tbLevel1->get_table() . '.nama')
            ->orderBy('A.nama')
            ->orderBy('B.nama')
            ->get();

        // Proses pengelompokan data berdasarkan level1 dan level2
        $level1edCategories = [];

        foreach ($post as $item) {
            // Cek apakah level1_id sudah ada di array
            if (!isset($level1edCategories[$item->level1_id])) {
                // Jika belum, buat grup baru
                $level1edCategories[$item->level1_id] = [
                    'level1_id' => $item->level1_id,
                    'level1_nama' => $item->level1_nama,
                    'level2es' => []
                ];
            }

            // Cek apakah level2 sudah ada di dalam level1
            $level2Exists = false;

            foreach ($level1edCategories[$item->level1_id]['level2es'] as &$level2) {
                if ($level2['level2_id'] == $item->level2_id) {
                    // Kategori sudah ada, tambahkan level3 ke dalam level2 ini
                    $level2['level3'][] = [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'status' => $item->status,
                    ];
                    $level2Exists = true;
                    break;
                }
            }

            if (!$level2Exists) {
                // Jika level2 belum ada, buat level2 baru dan tambahkan level3 pertama
                $level1edCategories[$item->level1_id]['level2es'][] = [
                    'level2_id' => $item->level2_id,
                    'level2_nama' => $item->level2_nama,
                    'level3' => [
                        [
                            'id' => $item->id,
                            'nama' => $item->nama,
                            'status' => $item->status,
                        ]
                    ]
                ];
            }
        }

        $addon = [
            "post" => $level1edCategories,
        ];

        return view("master.level3.main", $addon);
    }

    public function add($level2_id)
    {
        $tbLevel2 = new tbLevel2();
        $tbLevel1 = new tbLevel1();

        $post = $tbLevel2
            ->join($tbLevel1->get_table() . ' AS A', $tbLevel2->get_table() . '.level1_id', '=', 'A.id')
            ->select(
                $tbLevel2->get_table() . '.*',
                'A.nama AS level1_nama'
            )
            ->where($tbLevel2->get_table() . '.id', $level2_id)
            ->get();

        $level1_id = $post->pluck('level1_id')[0];
        $level1_nama = $post->pluck('level1_nama')[0];
        $level2_nama = $post->pluck('nama')[0];

        $addon = [
            "level2_id" => $level2_id,
            "level2_nama" => $level2_nama,
            "level1_id" => $level1_id,
            "level1_nama" => $level1_nama,
            "post" => []
        ];

        return view("master.level3.add", $addon);
    }

    public function edit($id)
    {
        $tbLevel3 = new tbLevel3();
        $tbLevel1 = new tbLevel1();
        $tbLevel2 = new tbLevel2();

        $post = $tbLevel3
            ->join($tbLevel2->get_table() . ' AS A', $tbLevel3->get_table() . '.level2_id', '=', 'A.id')
            ->join($tbLevel1->get_table() . ' AS B', 'A.level1_id', '=', 'B.id')
            ->select(
                $tbLevel3->get_table() . '.*',
                'A.nama AS level2_nama',
                'A.level1_id',
                'B.nama AS level1_nama'
            )
            ->where($tbLevel3->get_table() . '.id', $id)
            ->get();

        $level2_id = $post->pluck('level2_id')[0];
        $level2_nama = $post->pluck('level2_nama')[0];
        $level1_id = $post->pluck('level1_id')[0];
        $level1_nama = $post->pluck('level1_nama')[0];

        $addon = [
            "level2_id" => $level2_id,
            "level2_nama" => $level2_nama,
            "level1_id" => $level1_id,
            "level1_nama" => $level1_nama,
            "post" => $post,
        ];

        return view("master.level3.add", $addon);
    }

    public function add_save(Request $request)
    {
        // Ambil input request
        $id = $request->input('id');
        $nama = $request->input('nama');
        $level2_id = $request->input('level2_id');

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
        $tbLevel3 = new tbLevel3();

        $tbLevel3->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'nama' => $nama,
                'level2_id' => $level2_id,
                'create_by' => Session::get('actasys_user_nama'),
            ]
        );

        return back()->with('formSuccess', 'Data telah disimpan!');
    }

    public function terminate($id)
    {
        $tbLevel3 = new tbLevel3();

        $tbLevel3
            ->where('id', $id)
            ->update([
                "status" => 0,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/level3');
    }

    public function activate($id)
    {
        $tbLevel3 = new tbLevel3();

        $tbLevel3
            ->where('id', $id)
            ->update([
                "status" => 1,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/level3');
    }
}
