<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Couso php nvc</title>
</head>
<body>
    <h2>Bloco de anotações</h2>
    <a href="/">Home</a>
    
    <?php
    if(!isset($_SESSION['logado'])):
    ?>
    <a href="/notes/criar">Criar um bloco</a>
    <a href="/users/cadastrar">Cadastrar usuarioo</a>
    <?php
    endif;
    ?>

    <?php
    if(!isset($_SESSION['logado'])):
    ?>
    <a href="/home/login">Login</a>
    <?php
    else:
    ?>
    Ola <?php echo $_SESSION['userNome']; ?>
    <a href="/home/logout">Logout</a>
    <?php
    endif;
    ?>




    <?php
    require_once '../App/views'.$view.'.php';
    ?>
</body>
</html>