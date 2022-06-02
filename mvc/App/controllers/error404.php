<?php

// use App\Core\Controller;

class Error404 extends App\Core\Controller
{
    public function index($note = '')
    {
        $this->view('erros/404');
    }
}