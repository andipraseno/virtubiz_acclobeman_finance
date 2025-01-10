<?php

namespace App\Http\Controllers\actasys1;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\actasys1\LoginRule_User;
use App\Http\Controllers\actasys1\LoginRule_Password;

use App\Models\tb_act_usr as tbUser;
use App\Models\tb_act_cpy as tbCompany;

class LoginController extends BaseController
{
    // *********************************
    // login
    // *********************************
    public function index()
    {
        return view('actasys1.login');
    }

    public function start(Request $request)
    {
        // ambil parameter
        $email = $request->input('email');
        $password = $request->input('password');

        // cek error
        $errList = array(
            'email' => ['required', 'email', new LoginRule_User($email)],
            'password' => ['required', new LoginRule_Password($email, $password)],
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
            return back()
                ->withErrors($errResult)
                ->withInput()
                ->with('formError', 'Mohon periksa masukan anda!');
        } else {
            // sukses
            $this_user_id = '';
            $this_user_nama = '';
            $this_user_email = '';
            $this_user_handphone = '';

            $this_company_id = '';
            $this_company_nama = '';
            $this_company_kode = '';
            $this_company_alamat = '';
            $this_company_handphone = '';
            $this_company_email = '';

            // load user
            $tbUser = new tbUser();
            $tbCompany = new tbCompany();

            $post = $tbUser
                ->join($tbCompany->get_table() . ' AS A', $tbUser->get_table() . '.company_id', '=', 'A.id')
                ->select(
                    $tbUser->get_table() . '.*',
                    'A.nama AS company_nama',
                    'A.kode AS company_kode',
                    'A.alamat AS company_alamat',
                    'A.handphone AS company_handphone',
                    'A.email AS company_email'
                )
                ->where($tbUser->get_table() . '.status', 1)
                ->where($tbUser->get_table() . '.email', $email)
                ->get();

            if (count($post) > 0) {
                $this_user_id = $post->pluck('id')[0];
                $this_user_nama = $post->pluck('nama')[0];
                $this_user_email = $post->pluck('email')[0];
                $this_user_handphone = $post->pluck('handphone')[0];

                $this_company_id = $post->pluck('company_id')[0];
                $this_company_kode = $post->pluck('company_kode')[0];
                $this_company_nama = $post->pluck('company_nama')[0];
                $this_company_alamat = $post->pluck('company_alamat')[0];
                $this_company_handphone = $post->pluck('company_handphone')[0];
                $this_company_email = $post->pluck('company_email')[0];

                Session::put('actasys_user_id', $this_user_id);
                Session::put('actasys_user_nama', $this_user_nama);
                Session::put('actasys_user_email', $this_user_email);
                Session::put('actasys_user_handphone', $this_user_handphone);

                Session::put('actasys_company_id', $this_company_id);
                Session::put('actasys_company_kode', $this_company_kode);
                Session::put('actasys_company_nama', $this_company_nama);
                Session::put('actasys_company_alamat', $this_company_alamat);
                Session::put('actasys_company_handphone', $this_company_handphone);
                Session::put('actasys_company_email', $this_company_email);
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
