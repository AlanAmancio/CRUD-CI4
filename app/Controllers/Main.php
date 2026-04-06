<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TasksModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function index()
    {
        // echo "Hello world!";

        $model_usuarios = new UsuariosModel();
        $usuarios = $model_usuarios->findAll();

        // dd($usuarios);
        // ou
        echo '<pre>';
        print_r($usuarios);


        //tasks
        $model_tasks = new TasksModel();
        $tasks = $model_tasks->findAll();


        //dd($tasks);
        //ou
        echo '<pre>';
        print_r($tasks);
    }
}
