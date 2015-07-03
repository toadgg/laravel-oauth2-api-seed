<?php namespace App;

use Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'name'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}