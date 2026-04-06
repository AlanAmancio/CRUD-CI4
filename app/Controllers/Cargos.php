<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CargoModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controller responsável por gerenciar os cargos
 * (CRUD: listar, criar, editar, atualizar e excluir)
 */

class Cargos extends BaseController
{
    /**
     * Instância do model de cargos
     */
    protected $cargoModel;

    public function __construct()
    {
        $this->cargoModel = new CargoModel();
    }

    public function index() // busca todos os cargos e manda para view.
    {
        $data = [
            'titulo' => 'Lista de cargos',
            'cargos' => $this->cargoModel->findAll()
        ];

        return view('cargos/index', $data);
    }

    public function create() // Só abre a tela do formulário de criação de cargo
    {
        $data = [
            'titulo' => 'Novo Cargo'
        ];

        return view('cargos/create', $data);
    }


    public function store() //regra de validação dso campos
    {
        $regras = [
            'cbo_codigo' => 'required|max_length[6]',
            'cbo_descricao' => 'required|max_length[150]',
        ];


        // se falhar na validação, retorna para o furmulário com erros
        if (!$this->validate($regras)) {
            return redirect()->back()->withinput()->with('errors', $this->validator->getErrors());
        }

        // salva os dados no banco
        $this->cargoModel->save([
            'cbo_codigo' => $this->request->getPost('cbo_codigo'),
            'cbo_descricao' => $this->request->getPost('cbo_descricao'),
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->to('/cargos')->with('sucesso', 'Cargo cadastrado com sucesso.');
    }

    /**
     * Exibe o formulário de edição de um cargo
     */

    public function edit($id)
    {
        // Busca o cargo pelo ID
        $cargo = $this->cargoModel->find($id);

        // Se não existir, retorna erro 404
        if (!$cargo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Cargo não encontrado.');
        }

        $data = [
            'titulo' => 'Editar Cargo',
            'cargo' => $cargo
        ];

        return view('cargos/edit', $data);
    }

    /**
     * Atualiza um cargo existente
     */

    public function update($id)
    {
        $cargo = $this->cargoModel->find($id);

        // Verifica se o cargo existe
        if (!$cargo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Cargo não encontrado.');
        }

        // Regras de validação
        $regras = [
            'cbo_codigo' => 'required|max_length[6]',
            'cbo_descricao' => 'required|max_length[150]',
        ];

        // Se falhar, volta para o formulário com erros
        if (!$this->validate($regras)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Atualiza os dados no banco
        $this->cargoModel->update($id, [
            'cbo_codigo' => $this->request->getPost('cbo_descricao'),
        ]);

        return redirect()->to('/cargos')->with('sucesso', 'Cargo atualizado com sucesso.');
    }

    /**
     * Exclui um cargo do banco de dados
     */

    public function delete($id)
    {
        // Verifica se o cargo existe antes de excluir
        $cargo = $this->cargoModel->find($id);

        if (!$cargo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Cargo não encontrado.');
        }

        // Remove o registro
        $this->cargoModel->delete($id);

        return redirect()->to('/cargos')->with('sucesso', 'Cargo excluído com sucesso.');
    }
}
