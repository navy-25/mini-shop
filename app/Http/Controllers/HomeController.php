<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $page['title'] = 'Beranda';
        return view('backend.dashboard', compact('page'));
    }
}
