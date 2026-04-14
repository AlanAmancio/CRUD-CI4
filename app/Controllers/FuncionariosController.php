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

class FuncionariosController extends BaseController
{
    //instância do model de funcionários e de cargos
    protected $funcionarioModel;
    protected $cargoModel;


    // construtor: inicializa os models necessários
    public function __construct()
    {
        $this->funcionarioModel = new FuncionarioModel(); // para mexer na tabela de funcionários
        $this->cargoModel = new CargoModel(); // para buscar os cargos
    }


    //lista todos os funcionários com a descrição do cargo (JOIN)
    public function index()
    {
        $status = $this->request->getGet('status');

        $query = $this->funcionarioModel
            ->select('tbl_funcionario.*, tbl_cargo.cbo_codigo, tbl_cargo.cbo_descricao')
            ->join('tbl_cargo', 'tbl_cargo.CBOID = tbl_funcionario.fun_CBOID', 'left');

        if ($status !== null && $status !== '') {
            $query->where('tbl_funcionario.fun_flg_status', $status);
        }

        $data = [
            'titulo' => 'Lista de funcionários',
            'funcionarios' => $query->findAll(),
            'statusSelecionado' => $status
        ];

        return view('funcionarios/index', $data);
    }


    public function new() // abrir tela de cadastro, envia o titulo e envia também a lista de cargos
    {
        $data = [
            'titulo' => 'Novo Funcionário',
            'cargos' => $this->cargoModel->findAll() //essa parte, traz todos os cargos do banco para você usar no select da view 
        ];

        return view('funcionarios/new', $data);
    }


    public function create() // esse metodo recebe os dados enviados pelo formulario, valida e salva no banco depois redireciona para a listagem 
    {
        $regras = [
            'fun_codigo' => [
                'label' => 'Código',
                'rules' => 'required'
            ],
            'fun_cpf' => [
                'label' => 'CPF',
                'rules' => 'min_length[11]|required'
            ],
            'fun_nome_completo' => [
                'label' => 'Nome Completo',
                'rules' => 'required'
            ],
            'fun_CBOID' => [
                'label' => 'Cargo',
                'rules' => 'required'
            ],
            'fun_flg_status' => [
                'label' => 'Status',
                'rules' => 'required'
            ],

            // aqui são todos os campos que são obrigatórios código, cpf, nome, cargo e status.
        ];

        if (! $this->validate($regras)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
            // se der erro na validação volta para o formulario, mantém os dados que foi digitado e manda os erros pra tela 
        }

        $this->funcionarioModel->insert([ // aqui ele pega os valores do formulario, como fun_codigo e também grava as datas de cadastro e alteração.
            'fun_codigo' => $this->request->getPost('fun_codigo'),
            'fun_cpf' => $this->request->getPost('fun_cpf'),
            'fun_nome_completo' => $this->request->getPost('fun_nome_completo'),
            'fun_CBOID' => $this->request->getPost('fun_CBOID'),
            'fun_flg_status' => $this->request->getPost('fun_flg_status'),
            'fun_data_cadastro' => date('Y-m-d H:i:s'),
            'fun_data_ultima_alteracao' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/funcionarios')->with('sucesso', 'Funcionário cadastrado com sucesso.');
    }

    // busca o funcionário pelo ID, busca todos os cargos e mata tudo para a view de edição 
    public function edit($hash)
    {

        $id = decodeId($hash);

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
    public function update($hash)
    {

        $id = decodeId($hash);
        //verifica se o funcionário existe 
        $funcionario = $this->funcionarioModel->find($id);

        if (!$funcionario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Funcionário não encontrado.');
            // se o funcionario não for existente, erro na tela 
        }

        //regras de validação
        $regras = [
            'fun_codigo' => [
                'label' => 'Código',
                'rules' => 'required'
            ],
            'fun_cpf' => [
                'label' => 'CPF',
                'rules' => 'min_length[11]',
                'required'
            ],
            'fun_nome_completo' => [
                'label' => 'Nome Completo',
                'rules' => 'required'
            ],
            'fun_CBOID' => [
                'label' => 'Cargo',
                'rules' => 'required'
            ],
            'fun_flg_status' => [
                'label' => 'Status',
                'rules' => 'required'
            ],
        ];


        if (!$this->validate($regras)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
            // se falhar, retorna com erros 
        }


        $this->funcionarioModel->update($id, [
            'fun_codigo' => $this->request->getPost('fun_codigo'),
            'fun_cpf' => $this->request->getPost('fun_cpf'),
            'fun_nome_completo' => $this->request->getPost('fun_nome_completo'),
            'fun_CBOID' => $this->request->getPost('fun_CBOID'),
            'fun_flg_status' => $this->request->getPost('fun_flg_status'),
            'fun_data_ultima_alteracao' => date('Y-m-d H:i:s'),
        ]); // envia pro banco e muda a data da ultima alteração

        return redirect()->to('/funcionarios')
            ->with('sucesso', 'Funcionário atualizado com sucesso.');
    }


    //Remove um funcionário do banco
    public function delete($hash)
    {
        $id = decodeId($hash);
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
