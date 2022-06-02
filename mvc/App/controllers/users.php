<?php

// use App\Core\Controller;
use App\Auth;

class Users extends App\Core\Controller
{
    public function cadastrar()
    {
        Auth::CheckLogin();
        Auth::CheckLoginAdmin();
        $mensagem = array();

        if(!isset($_POST['cadastrar'])):
            $nome = $_POST['nome'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $email = $_POST['email'];

            $user = $this->model('User');
            $user->nome = $nome;
            $user->email = $email;
            $user->senha = $senha;

            $mensagem[] = $user->save();
        endif;

        $this->view('users/cadastrar', $dados = ['mensagem' => $mensagem]);
    }
}