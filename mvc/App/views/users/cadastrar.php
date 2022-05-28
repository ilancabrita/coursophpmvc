<h1>Criar bloce de anotações</h1>

<?php
if(!empty($data['mensagem'])):
    foreach($data['mensagem'] as $m):
        echo $m."<br>";
    endforeach;
endif;
?>

<form action="/users/cadastrar" method="POST">
    Nome: <input type="text" name="nome">
    <br>
    Email: <input type="text" name="email">
    <br>
    Senha: <input type="password" name="senha">
    <br>
    <button name="cadastrar">Cadastrar</button>
</form>