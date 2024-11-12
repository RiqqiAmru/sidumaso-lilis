<?php

namespace App\Controllers;

class Log extends BaseController
{
    public function index(): string
    {
        return view('log/index');

    }
}
