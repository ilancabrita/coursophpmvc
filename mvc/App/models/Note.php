<?php

// use App\Core\Model;

class Note extends App\Core\Model
{
    public $titulo;
    public $texto;
    public $imagem;

    public function getAll()
    {
        // $sql = "SELECT notes.id, notes.titulo, notes.texto, notes.imagem, users.nome FROM notes INNER JOIN users ON notes.id_users = users.id";
        $sql = "SELECT notes.id, notes.titulo, notes.texto, notes.imagem, users.nome FROM notes INNER JOIN users ON notes.id_users = users.id";
        $stmt = Model::getConn()->prepare($$sql);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;
    }

    public function findId($id)
    {
        $sql = "SELECT * FROM note WHERE id = ?";
        $stmt = Model::getConn()->prepare($$sql);
        $stmt = bindValue(1, $id);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;
    }

    public function save()
    {
        $sql = "INSERT INTO notas (titulo, texto, imagem) VALUES (?,?,?)";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->bindValue(1, $this->titulo);
        $stmt->bindValue(2, $this->texto);
        $stmt->bindValue(3, $this->imagem);

        if($stmt->execute()):
            return "cadastrado com sucesso!";
        else:
            return "erro ao cadastrar";
        endif;
    }

    public function update($id)
    {
        $sql = "UPDATE notas SET titulo = ?, texto = ? VALUES id = ?";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->bindValue(1, $this->titulo);
        $stmt->bindValue(2, $this->texto);
        $stmt->bindValue(3, $id);

        if($stmt->execute()):
            return "M.toast({html: 'atualizado com sucesso', classes: 'rounded, green'});!";
        else:
            return "M.toast({html: 'falha ao atualiza', classes: 'rounded, red'});";
        endif;
    }

    public function updateImagem($id)
    {
        $sql = "UPDATE notas SET titulo = ?, texto = ?, imagem = ? VALUES id = ?";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->bindValue(1, $this->titulo);
        $stmt->bindValue(2, $this->texto);
        $stmt->bindValue(2, $this->imagem);
        $stmt->bindValue(3, $id);

        if($stmt->execute()):
            return "atualizado com sucesso!";
        else:
            return "erro ao atualizar";
        endif;
    }

    public function deleteImagem($id)
    {
        $sql = "UPDATE notas SET imagem = ? VALUES id = ?";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->bindValue(1, "");
        $stmt->bindValue(2, $id);

        if($stmt->execute()):
            return "imagem excluida com sucesso!";
        else:
            return "erro ao excluir imagem";
        endif;
    }

    public function delete($id)
    {
        $resultado = $this->findId($id);

        if(!empty($resultado['imagem'])):
            unlink("uploads/".$resultado['imagem']);
        endif;

        $sql = "DELETE FROM note WHERE id = ?";
        $stmt = Model::getConn()->prepare($$sql);
        $stmt = bindValue(1, $id);

        if($stmt->execute()):
            return "excluido com sucesso!";
        else:
            return "erro ao excluir";
        endif;
    }

    public function search($search)
    {
        $sql = "SELECT * FROM note WHERE titulo LIKE ? COLATE utf8_general-ci";
        $stmt = Model::getConn()->prepare($$sql);
        $stmt = bindValue(1, "%{$search}%");
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;
    }
}