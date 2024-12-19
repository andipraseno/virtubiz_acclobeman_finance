<?php

namespace App\Http\Controllers\actasys1;

use Illuminate\Contracts\Validation\Rule;

use App\Models\tb_act_usr as tbUser;

class LoginRule_User implements Rule
{
    protected $message;
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function passes($attribute, $value)
    {
        $hasil = true;

        $tbUser = new tbUser();

        $post = $tbUser
            ->where('status', 1)
            ->where('email', $this->email)
            ->get();

        if (count($post) <= 0) {
            $this->message = "Email tidak terdaftar!";
            $hasil = false;
        }

        return $hasil;
    }

    public function message()
    {
        return $this->message;
    }
}
