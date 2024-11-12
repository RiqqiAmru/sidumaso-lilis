<?php

namespace App\Controllers;

class Pengumuman extends BaseController
{
    public function index(): string
    {
        return view('pengumuman/index');

    }
}
