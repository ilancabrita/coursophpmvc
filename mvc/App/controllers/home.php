<?php

// use App\Core\Controller;
use App\Auth;

class Home extends App\Core\Controller
{
    public function index($note = '')
    {
        $note = $this->model('Note');
        $dados = $note->getAll();

        $this->view('home/index', $dados = ['registros' => $dados]);
    }

    public function buscar()
    {
        $busca = isset($_POST['search']) ? $_POST['search'] : $_SESSION['search'];
        $_SESSION['search'] = $busca;

        $note = $this->model('Note');
        $dados = $note->search($busca);
        $this->view('home/index', $dados = ['registros' => $dados]);
    }

    public function login()
    {
        $mensagem = array();

        if(isset($_POST['entrar'])):
            if((empty($_POST['email'])) or (empty($_POST['senha']))):
                $mensagem[] = "o campo email e senhe são obrigatorios";
            else:
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $mensagem[] = Auth::Login($email, $senha);
            endif;
        endif;

        $this->view('home/login', $dados = ['mensagem' => $mensagem]);
    }

    public function logout()
    {
        Auth::Logout();
    }
}