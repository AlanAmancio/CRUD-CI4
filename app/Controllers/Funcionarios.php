<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FuncionarioMOdel;
use App\Models\CargoModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controller responsável por gerenciar os funcionários
 * (CRUD + relacionamento com cargos)
 */

class Funcionarios extends BaseController
{
    //instância do model de funcionários e de cargos
    protected $funcionarioModel;
    protected $cargoModel;


    // construtor: inicializa os models necessários
    public function __construct()
    {
        $this->funcionarioModel = new FuncionarioModel();
        $this->cargoModel = new CargoModel();
    }


    //lista todos os funcionários com a descrição do cargo (JOIN)
    public function index()
    {
        // Busca funcionários com o nome do cargo vinculado
        $funcionarios = $this->funcionarioModel
            ->select('tbl_funcionario.*, tbl_cargo.cbo_descricao')
            ->join('tbl_cargo', 'tbl_cargo.CBOID = tbl_funcionario.fun_CBOID', 'left')
            ->findAll();

        $data = [
            'titulo' => 'Lista de Funcionários',
            'fucnionarios' => $funcionarios
        ];

        return view('funcionarios/index', $data);
    }

    // exibe o formulario de criação de funcionário
    public function create()
    {
        $data = [
            'titulo' => 'Novo Funcionário',
            'cargos' => $this->cargoModel->findAll()
        ];

        return view('funcionarios/create', $data);
    }


    // salva um novo funcionário no banco
    public function store()
    {

        // regras de validação
        $regras = [
            'fun_codigo' => 'required',
            'fun_cpf' => 'required|max_length[11]',
            'fun_nome_completo' => 'required|max_length[150]',
            'fun_CBOID' => 'required',
            'fun_flg_status' => 'required',
        ];


        // se falhar, retorna para o formulário com erros
        if (!$this->validate($regras)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // salva no banco com data de criação e atualização
        $this->funcionarioModel->save([
            'fun_codigo' => $this->request->getPost('fun_codigo'),
            'fun_cpf' => $this->request->getPost('fun_cpf'),
            'fun_nome_completo' => $this->request->getPost('fun_nome_completo'),
            'fun_CBOID' => $this->request->getPost('fun_CBOID'),
            'fun_flg_status' => $this->request->getPost('fun_flg_status'),
            'fun_data_cadastro' => date('Y-m-d H:i:s'),
            'fun_data_ultima_alteracao' => date('Y-m-d H:i:s'),

        ]);

        return redirect()->to('funcionarios')->with('sucesso', 'Funcionário cadastrado com sucesso');
    }

    // exibe o formulario de edição de um funcionario
    public function edit($id)
    {
        //busca o funcionário pelo ID
        $funcionario = $this->funcionarioModel->find($id);

        // se não existir, retorna erro 404
        if (!$funcionario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Funcionário não encontrado.');
        }

        $data = [
            'titulo' => 'Editar Funcionário',
            'funcionario' => $funcionario,
            'cargos' => $this->cargoModel->findAll() // necessário para editar o cargo
        ];

        return view('funcionarios/edit', $data);
    }

    //atualiza um funcionário existente
    public function update($id)
    {
        //verifica se o funcionário existe 
        $funcionario = $this->funcionarioModel->find($id);

        if (!$funcionario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Funcionário não encontrado.');
        }

        //regras de validação
        $regras = [
            'fun_codigo' => 'required',
            'fun_cpf' => 'required|max_length[11]',
            'fun_nome_completo' => 'required|max_length[150]',
            'fun_CBOID' => 'required',
            'fun_flg_status' => 'required',
        ];

        // se falhar, retorna com erros 
        if (!$this->validate($regras)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Atualiza os dados no banco
        $this->funcionarioModel->update($id, [
            'fun_codigo' => $this->request->getPost('fun_codigo'),
            'fun_cpf' => $this->request->getPost('fun_cpf'),
            'fun_nome_completo' => $this->request->getPost('fun_nome_completo'),
            'fun_CBOID' => $this->request->getPost('fun_CBOID'),
            'fun_flg_status' => $this->request->getPost('fun_flg_status'),
            'fun_data_ultima_alteracao' => date('Y-m-d H:i:s'), // controla histórico de alterações
        ]);

        return redirect()->to('/funcionarios')
            ->with('sucesso', 'Funcionário atualizado com sucesso.');
    }


    //Remove um funcionário do banco
    public function delete($id)
    {
        //verifica se existe antes de excluir
        $funcionario = $this->funcionarioModel->find($id);

        if (!$funcionario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Funcionário não encontrado.');
        }

        // Exclui o registro
        $this->funcionarioModel->delete($id);

        return redirect()->to('/funcionarios')->with('sucesso', 'Funcionário excluído com sucesso.');
    }
}
