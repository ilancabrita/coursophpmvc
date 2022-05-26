<?php

// use App\Core\Controller;

class home extends App\Core\Controller
{
    public function index($note = '')
    {
        $note = $this->model('Note');
        $dados = $note->getAll();

        $this->view('home/index', $dados);
    }
}