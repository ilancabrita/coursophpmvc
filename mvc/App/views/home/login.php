<?php
if(!empty($data['mensagem'])):
    foreach($data['mensagem'] as $m):
        echo $m."<br>";
    endforeach;
endif;
?>

<div>
    <h1>Fazer login</h1>

    <form action="" method="POST">
        <div class="row">
            <div class="input-field col s12">
                <input id="email" type="email" name="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" type="password" name="senha" class="validate">
                <label for="password">Password</label>
                </div>
        </div>
        <br>
        <button name="entrar">Entrar</button>
    </form>
</div>