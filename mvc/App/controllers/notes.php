<?php

// use App\Core\Controller;
use App\Auth;

class Notes extends App\Core\Controller
{
    public function criar()
    {
        Auth::checkLogin();
        $mensagem = array();

        if(isset($_POST['cadastrar'])):
            if(empty($_POST['titulo'])):
                $mensagem[] = "o campo titulo não pode ser em branco";
            elseif(isset($_POST['texto'])):
                $mensagem[] = "o campo texto não pode ser em branco";
            else:
                $note = $this->model('Note');
                $note->titulo = $_POST['titulo'];
                $note->titulo = $_POST['texto'];
                $mensagem[] = $note->save();
            endif;
        endif;

        $this->view('notas/criar', $dados = ['mensagem' => $mensagem]);
    }

    public function ver($id = '')
    {
        $note = $this->model('Note');
        $dados = $note->findId($id);

        $this->view('notes/ver', $dados);
    }

    public function editar($id)
    {
        Auth::checkLogin();
        $mensagem = array();
        $note = $this->model('Note');

        if(isset($_POST['atualizar'])):
            $note->titulo = $_POST['titulo'];
            $note->titulo = $_POST['texto'];
            $mensagem[] = $note->update($id);
        endif;

        $dados = $note->findId($id);
        $this->view('home/editar', $dados = ['registros' => $dados, 'mensagem' => $mensagem]);
    }

    public function excluir($id = '')
    {
        Auth::checkLogin();
        $mensagem = array();
        $note = $this->model('Note');
        $mensagem[] = $note->delete($id);
        $dados = $note->getAll();
        $this->view('home/index', $dados = ['registros' => $dados, 'mensagem' => $mensagem]);
    }
}