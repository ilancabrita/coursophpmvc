<?php

// use App\Core\Controller;

class Api extends App\Core\Controller
{
    public function notes()
    {
        $note = $this->model('Note');
        $dados = $note->getAll();

        header('Content-Type: application.json; cherset:utf-8');
        echo json_encode($dados);
    }
}