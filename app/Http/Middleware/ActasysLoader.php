<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;

use App\Models\tb_acc_sfr as tbSoftware;

class ActasysLoader
{
    public function handle($request, Closure $next)
    {
        // general setup
        date_default_timezone_set('Asia/Jakarta');

        // software
        if (!Session::has('actasys_software_id')) {
            $tbSoftware = new tbSoftware();

            $post = $tbSoftware
                ->where('id', config('app.software.id'))
                ->first();

            Session::put('actasys_software_id', $post->id ?? '');
            Session::put('actasys_software_nama', $post->nama ?? '');
            Session::put('actasys_software_tagline', $post->tagline ?? '');
            Session::put('actasys_software_copyright', $post->copyright ?? '');
            Session::put('actasys_software_developer', $post->developer ?? '');
            Session::put('actasys_software_versi', $post->versi ?? '');
        }

        return $next($request);
    }
}
