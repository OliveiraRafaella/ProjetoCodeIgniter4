<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Main extends Controller
{
    public function index()
    {
        return view('home');
    }
}
