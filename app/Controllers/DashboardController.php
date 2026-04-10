<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'DashboardController'
        ];

        return view('dashboard/index', $data);
    }
}
