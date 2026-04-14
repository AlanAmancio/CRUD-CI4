<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CargoModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controller responsável por gerenciar os cargos
 * (CRUD: listar, criar, editar, atualizar e excluir)
 */

class CargosController extends BaseController
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
            'titulo' => 'Cargos',
            'cargos' => $this->cargoModel->findAll()
        ];

        return view('cargos/index', $data);
    }

    public function new()
    {
        // cria um array de dados que será enviado para a view
        $data = [
            'titulo' => 'Novo Cargo'
        ];

        // retorna a view "cargos/new" passando os dados 
        return view('cargos/new', $data);
    }

    public function create()
    {
        $regras = [

            'cbo_codigo' => [
                'label' => 'CBO',
                'rules' => 'required|max_length[6]'
            ],
            'cbo_descricao' => [
                'label' => 'Descrição',
                'rules' => 'required|max_length[150]'
            ],
        ];

        if (! $this->validate($regras)) {
            return redirect()
                ->back()
                ->withinput()
                ->with('errors', $this->validator->getErrors());
            // se os dados forem invalidos, volta para o formulário, mantém o que o usuário digitou e manda os erros pra tela 
        }

        $this->cargoModel->insert([
            'cbo_codigo' => $this->request->getPost('cbo_codigo'),
            'cbo_descricao' => $this->request->getPost('cbo_descricao'),
            // os dados foram aceitos dentro da validação, então irá inserir, pega os dados do formulário e salva no banco
        ]);

        return redirect()->to('/cargos')->with('sucesso', 'Cargo cadastrado com sucesso.');
        // volta para listagem, mostra mensagem de sucesso
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
            'cbo_codigo' => [
                'label' => 'CBO',
                'rules' => 'required|max_length[6]'
            ],
            'cbo_descricao' => [
                'label' => 'Descrição',
                'rules' => 'required|max_length[150]'
            ],
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
            'cbo_codigo' => $this->request->getPost('cbo_codigo'),
            'cbo_descricao' => $this->request->getPost('cbo_descricao'),
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
