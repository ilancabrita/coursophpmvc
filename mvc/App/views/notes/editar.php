<div class="row container">
    <div class="clo s12 m6 push-m3">
        <h4 class="light">Editar bloco</h4>

        <?php
        if(!empty($data['mensagem'])):
            // Remover divs
            echo "<script>";
            foreach($data['mensagem'] as $m):
                echo $m."<br>";
            endforeach;
            echo "</script>";
        endif;
        ?>

        <form action="/notes/editar/<?php echo $data['registro']['id']; ?>" method="POST" enctype="multipart/form-data">
            Titulo: <input type="text" value="<?php echo $data['registro']['titulo']; ?>" name="titulo">
            <br>

            Texto: <textarea name="texto" id="" cols="30" rows="10"><?php echo $data['registro']['texto']; ?></textarea>
            <br>

            <?php
            if(!empty($data['registro']['id'])):
            ?>

            <button name="deletarImagem" class="bnt orange">Deletar imagem</button>
            <button name="atualizar" class="bnt">Atualizar</button>
            
            <?php
            else:
            ?>

            <input type="file" name="foo" value=""/>
            <button name="atualizarImagem" class="bnt">Atualizar</button>

            <?php
            endif;
            ?>

        </form>

    </div>

</div>