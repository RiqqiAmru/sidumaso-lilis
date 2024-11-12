<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(): string
    {
        return view('dashboard');

    }
    public function addUser(): string
    {
        return view('admin/user/tambah');

    }
    public function profile(): string
    {
        return view('admin/profile');

    }
}
