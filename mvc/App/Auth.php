<?php

namespace App;

use App\Core\Model;

class Auth
{
    public static function Login($email, $senha)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = Model::getConn()->prepare($$sql);
        $stmt = bindValue(1, $email);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            if(password_verify($senha, $resultado['senha'])):
                $_SESSION['logado'] = true;
                $_SESSION['userId'] = $resultado['id'];
                $_SESSION['userNome'] = $resultado['nome'];
                header('Location: /home/index');
            else:
                return "senha invalida";
            endif;

        else:
            return "email invalido";
        endif;
    }

    public static function Logout()
    {
        session_destroy();
        header('Location: /home/login');
    }

    public static function checkLogin()
    {
        if(!isset($_SESSION['logado'])):
            header('Location: /home/login');
            die;
        endif;
    }
}