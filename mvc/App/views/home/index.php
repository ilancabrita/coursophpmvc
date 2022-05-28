<br>

<?php
if(!empty($data['mensagem'])):
    foreach($data['mensagem'] as $m):
        echo $m."<br>";
    endforeach;
endif;
?>

<?php
foreach($data['registros'] as $note);
?>

    <h1>
        <a href="/notes/ver/<?php echo $note['id']; ?>">
        <?php
        echo $note['titulo'];
        ?>
        </a>
    </h1>

    <p>
        <?php
        echo $note['texto'];
        ?>
    </p>

    <?php
    if(!isset($_SESSION['logado'])):
    ?>
    <a href="/notes/editar/<?php echo $note['id']; ?>">excluir</a>

    <a href="/notes/excluir/<?php echo $note['id']; ?>">excluir</a>
    <?php
    endif;
    ?>


    <br>

<?php 
?>