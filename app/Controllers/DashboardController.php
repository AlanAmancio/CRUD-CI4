<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'DashboardController'
        ];

        return view('dashboard/index', $data);
    }
}
