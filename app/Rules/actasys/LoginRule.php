<?php

namespace App\Rules\actasys;

use Illuminate\Contracts\Validation\Rule;

use App\Models\tb_act_usr as tbUser;

class LoginRule implements Rule
{
    protected $message;
    protected $email;
    protected $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function passes($attribute, $value)
    {
        $hasil = true;

        $tbUser = new tbUser();

        $post = $tbUser
            ->where('status', 1)
            ->where('email', $this->email)
            ->where('password', $this->password)
            ->get();

        if (count($post) <= 0) {
            $this->message = "Login gagal!";
            $hasil = false;
        }

        return $hasil;
    }

    public function message()
    {
        return $this->message;
    }
}