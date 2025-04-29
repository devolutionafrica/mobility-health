<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{

    public function index()
    {
        return view('pages.dashboard.index');
    }

    public function app()
    {
        return view('pages.dashboard.app');
    }
}
