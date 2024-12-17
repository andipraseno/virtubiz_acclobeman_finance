<?php

namespace App\Http\Controllers\actasys1;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Rules\actasys\LoginRule;

use App\Models\tb_act_usr as tbUser;
use App\Models\tb_act_cpy as tbCompany;

class ActasysController extends BaseController
{
    public function index()
    {
        return view('actasys1.welcome');
    }

    public function login(Request $request)
    {
        // ambil parameter
        $email = $request->input('email');
        $password = $request->input('password');

        // cek error
        $errList = array(
            'email' => ['required', 'email', new LoginRule($email, $password)],
            'password' => ['required'],
        );

        $errMessage = array(
            'email.required' => 'Tidak boleh kosong!',
            'email.email' => 'Format tidak valid!',
            'password.required' => 'Tidak boleh kosong!'
        );

        $errResult = Validator::make(
            $request->all(),
            $errList,
            $errMessage
        );

        if ($errResult->fails()) {
            // ada error
            return back()
                ->withErrors($errResult)
                ->withInput();
        } else {
            // sukses
            $this_user_id = '';
            $this_user_nama = '';
            $this_user_email = '';

            $this_company_id = '';
            $this_company_nama = '';

            // load user
            $tbUser = new tbUser();
            $tbCompany = new tbCompany();

            $post = $tbUser
                ->join($tbCompany->get_table() . ' AS A', $tbUser->get_table() . '.company_id', '=', 'A.id')
                ->select(
                    $tbUser->get_table() . '.*',
                    "A.nama AS company_nama",
                    "A.kode AS company_kode",
                )
                ->where($tbUser->get_table() . '.status', 1)
                ->where($tbUser->get_table() . '.email', $email)
                ->get();

            if (count($post) > 0) {
                $this_user_id = $post->pluck('id')[0];
                $this_user_nama = $post->pluck('nama')[0];
                $this_user_email = $post->pluck('email')[0];

                $this_company_id = $post->pluck('company_id')[0];
                $this_company_nama = $post->pluck('company_nama')[0];
                $this_company_kode = $post->pluck('company_kode')[0];

                Session::put('actasys_user_id', $this_user_id);
                Session::put('actasys_user_nama', $this_user_nama);
                Session::put('actasys_user_email', $this_user_email);

                Session::put('actasys_company_id', $this_company_id);
                Session::put('actasys_company_nama', $this_company_nama);
                Session::put('actasys_company_kode', $this_company_kode);
            }

            // load module
            return redirect()->intended('dashboard');
        }
    }

    public function logout()
    {
        Session::flush();
        Session::regenerate();

        return redirect('/');
    }
}
