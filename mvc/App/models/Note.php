<?php

// use App\Core\Model;

class Note extends App\Core\Model
{
    public $titulo;
    public $texto;

    public function getAll()
    {
        $sql = "SELECT * FROM note";
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
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;
    }

    public function save()
    {
        $sql = "INSERT INTO notas (titulo, texto) VALUES";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->bindValue(1, $this->titulo);
        $stmt->bindValue(2, $this->texto);

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
        $stmt->bindValue(3, $this->id);

        if($stmt->execute()):
            return "atualizado com sucesso!";
        else:
            return "erro ao atualizar";
        endif;
    }

    public function delete($id)
    {
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