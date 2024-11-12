<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing');
    }
    public function saran(): string
    {
        return view('saran/index');
    }
}
