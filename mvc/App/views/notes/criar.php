<h1>Criar bloce de anotações</h1>

<?php
if(!empty($data['mensagem'])):
    foreach($data['mensagem'] as $m):
        echo $m."<br>";
    endforeach;
endif;
?>

<form action="/notes/criar" method="POST">
    Titulo: <input type="text" name="titulo">
    <br>
    Texto: <textarea name="texto" id="" cols="30" rows="10"></textarea>
    <br>
    <button name="cadastrar">Cadastrar</button>
</form>