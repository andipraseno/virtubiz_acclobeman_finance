<?php

namespace App\Http\Controllers\master;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\tb_mst_coa as tbAkun;
use App\Models\tb_mst_coa_lv3 as tbLevel3;
use App\Models\tb_mst_coa_lv2 as tbLevel2;
use App\Models\tb_mst_coa_lv1 as tbLevel1;

class AkunController extends BaseController
{
    public function index()
    {
        $tbAkun = new tbAkun();
        $tbLevel1 = new tbLevel1();
        $tbLevel2 = new tbLevel2();
        $tbLevel3 = new tbLevel3();

        $post = $tbLevel1
            ->join($tbLevel2->get_table() . ' AS A', $tbLevel1->get_table() . '.id', '=', 'A.level1_id')
            ->join($tbLevel3->get_table() . ' AS B', 'A.id', '=', 'B.level2_id')
            ->leftJoin($tbAkun->get_table() . ' AS C', 'B.id', '=', 'C.level3_id')
            ->selectRaw(
                $tbLevel1->get_table() . ".id AS level1_id,
            " . $tbLevel1->get_table() . ".nama AS level1_nama,
            A.id AS level2_id,
            A.nama AS level2_nama,
            B.id AS level3_id,
            B.nama AS level3_nama,
            COALESCE(C.id, '') AS id,
            COALESCE(C.nama, '') AS nama,
            COALESCE(C.status, '') AS status"
            )
            ->orderBy($tbLevel1->get_table() . '.nama')
            ->orderBy('A.nama')
            ->orderBy('B.nama')
            ->orderBy('C.nama')
            ->get();

        // Proses pengelompokan data berdasarkan level1, level2, level3
        $res_list = [];

        foreach ($post as $item) {
            // Cek apakah level1_id sudah ada di array
            if (!isset($res_list[$item->level1_id])) {
                // Jika belum, buat grup baru untuk level1
                $res_list[$item->level1_id] = [
                    'level1_id' => $item->level1_id,
                    'level1_nama' => $item->level1_nama,
                    'level2es' => []
                ];
            }

            // Cek apakah level2 sudah ada dalam level1
            $level2Exists = false;

            foreach ($res_list[$item->level1_id]['level2es'] as &$level2) {
                if ($level2['level2_id'] == $item->level2_id) {
                    // Jika level2 sudah ada, tambahkan level3 ke dalam level2 ini
                    $level2['level3es'][] = [
                        'level3_id' => $item->level3_id,
                        'level3_nama' => $item->level3_nama,
                        'akun' => []
                    ];
                    $level2Exists = true;
                    break;
                }
            }

            if (!$level2Exists) {
                // Jika level2 belum ada, buat level2 baru dan tambahkan level3 pertama
                $res_list[$item->level1_id]['level2es'][] = [
                    'level2_id' => $item->level2_id,
                    'level2_nama' => $item->level2_nama,
                    'level3es' => [
                        [
                            'level3_id' => $item->level3_id,
                            'level3_nama' => $item->level3_nama,
                            'akun' => []
                        ]
                    ]
                ];
            }

            // Cek apakah level3 sudah ada di dalam level2
            foreach ($res_list[$item->level1_id]['level2es'] as &$level2) {
                if ($level2['level2_id'] == $item->level2_id) {
                    // Cek apakah level3 sudah ada
                    $level3Exists = false;
                    foreach ($level2['level3es'] as &$level3) {
                        if ($level3['level3_id'] == $item->level3_id) {
                            // Tambahkan akun ke dalam level3
                            $level3['akun'][] = [
                                'id' => $item->id,
                                'nama' => $item->nama,
                                'status' => $item->status,
                            ];
                            $level3Exists = true;
                            break;
                        }
                    }
                    // Jika level3 belum ada, buat level3 baru
                    if (!$level3Exists) {
                        $level2['level3es'][] = [
                            'level3_id' => $item->level3_id,
                            'level3_nama' => $item->level3_nama,
                            'akun' => [
                                [
                                    'id' => $item->id,
                                    'nama' => $item->nama,
                                    'status' => $item->status,
                                ]
                            ]
                        ];
                    }
                    break;
                }
            }
        }

        $addon = [
            "post" => $res_list,
        ];

        return view("master.akun.main", $addon);
    }

    public function add($level3_id)
    {
        $tbLevel3 = new tbLevel3();
        $tbLevel2 = new tbLevel2();
        $tbLevel1 = new tbLevel1();

        $post = $tbLevel3
            ->join($tbLevel2->get_table() . ' AS A', $tbLevel3->get_table() . '.level2_id', '=', 'A.id')
            ->join($tbLevel1->get_table() . ' AS B', 'A.level1_id', '=', 'B.id')
            ->select(
                $tbLevel3->get_table() . '.*',
                'A.nama AS level2_nama',
                'A.level1_id',
                'B.nama AS level1_nama'
            )
            ->where($tbLevel3->get_table() . '.id', $level3_id)
            ->get();

        $level1_id = $post->pluck('level1_id')[0];
        $level1_nama = $post->pluck('level1_nama')[0];
        $level2_id = $post->pluck('level2_id')[0];
        $level2_nama = $post->pluck('level2_nama')[0];
        $level3_id = $post->pluck('id')[0];
        $level3_nama = $post->pluck('nama')[0];

        $addon = [
            "level3_id" => $level3_id,
            "level3_nama" => $level3_nama,
            "level2_id" => $level2_id,
            "level2_nama" => $level2_nama,
            "level1_id" => $level1_id,
            "level1_nama" => $level1_nama,
            "post" => []
        ];

        return view("master.akun.add", $addon);
    }

    public function edit($id)
    {
        $tbAkun = new tbAkun();
        $tbLevel3 = new tbLevel3();
        $tbLevel2 = new tbLevel2();
        $tbLevel1 = new tbLevel1();

        $post = $tbAkun
            ->join($tbLevel3->get_table() . ' AS A', $tbAkun->get_table() . '.level3_id', '=', 'A.id')
            ->join($tbLevel2->get_table() . ' AS B', 'A.level2_id', '=', 'B.id')
            ->join($tbLevel1->get_table() . ' AS C', 'B.level1_id', '=', 'C.id')
            ->select(
                $tbAkun->get_table() . '.*',
                'A.nama AS level3_nama',
                'A.level2_id',
                'B.nama AS level2_nama',
                'B.level1_id',
                'C.nama AS level1_nama'
            )
            ->where($tbAkun->get_table() . '.id', $id)
            ->get();

        $level3_id = $post->pluck('level3_id')[0];
        $level3_nama = $post->pluck('level3_nama')[0];
        $level2_id = $post->pluck('level2_id')[0];
        $level2_nama = $post->pluck('level2_nama')[0];
        $level1_id = $post->pluck('level1_id')[0];
        $level1_nama = $post->pluck('level1_nama')[0];

        $addon = [
            "level3_id" => $level3_id,
            "level3_nama" => $level3_nama,
            "level2_id" => $level2_id,
            "level2_nama" => $level2_nama,
            "level1_id" => $level1_id,
            "level1_nama" => $level1_nama,
            "post" => $post,
        ];

        return view("master.akun.add", $addon);
    }

    public function add_save(Request $request)
    {
        // Ambil input request
        $id = $request->id;
        $nama = $request->nama;
        $level3_id = $request->level3_id;

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
        $tbAkun = new tbAkun();

        $post = $tbAkun
            ->where('id', $id)
            ->get();

        if (count($post) <= 0) {
            $tbAkun->create([
                'nama' => $nama,
                'level3_id' => $level3_id,
                'create_by' => Session::get('actasys_user_nama'),
            ]);
        } else {
            $tbAkun
                ->where('id', $id)
                ->update([
                    'nama' => $nama,
                    'updated_by' => Session::get('actasys_user_nama'),
                ]);
        }

        return back()->with('formSuccess', 'Data telah disimpan!');
    }

    public function terminate($id)
    {
        $tbAkun = new tbAkun();

        $tbAkun
            ->where('id', $id)
            ->update([
                "status" => 0,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/akun');
    }

    public function activate($id)
    {
        $tbAkun = new tbAkun();

        $tbAkun
            ->where('id', $id)
            ->update([
                "status" => 1,
                "updated_by" => Session::get('actasys_user_nama')
            ]);

        return redirect()->intended('master/akun');
    }
}
