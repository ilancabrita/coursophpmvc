<?php

// use App\Core\Controller;

class Home extends App\Core\Controller
{
    public function index($note = '')
    {
        $note = $this->model('Note');
        $dados = $note->getAll();

        $this->view('home/index', $dados = ['registros' => $dados]);
    }

    public function login()
    {
        $mensagem = array();

        if(isset($_POST['entrar'])):
            echo password_hash('12345', PASSWORD_DEFAULT);
        endif;

        $this->view('home/login', $dados = ['mensagem' => $mensagem]);
    }
}