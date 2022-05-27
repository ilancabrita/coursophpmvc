<h1>Editar bloce de anotações</h1>

<?php
if(!empty($data['mensagem'])):
    foreach($data['mensagem'] as $m):
        echo $m."<br>";
    endforeach;
endif;
?>

<form action="/notes/editar/<?php echo $data['registro']['id']; ?>" method="POST">
    Titulo: <input type="text" value="<?php echo $data['registro']['titulo']; ?>" name="titulo">
    <br>
    Texto: <textarea name="texto" id="" cols="30" rows="10"><?php echo $data['registro']['texto']; ?></textarea>
    <br>
    <button name="atualizar">Atualizar</button>
</form>