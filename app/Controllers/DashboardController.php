<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'Cadastro RH'
        ];

        return view('dashboard/index', $data);
    }
}
