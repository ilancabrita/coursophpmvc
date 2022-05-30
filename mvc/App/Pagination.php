<?php

namespace App;

class Pagination extends Core\App
{
    public $dados;
    public $atual;
    public $quandidade;
    public $registrosPagina;
    public $contar;

    public function __construct($dados, $atual, $quandidade)
    {
        $this->dados = $dados;
        $this->atual = $atual;
        $this->quandidade = $quandidade;
    }

    // resoltados
    public function resultado()
    {
        $this->registrosPagina = array_chunk( $this->dados,  $this->quandidade);
        $this->contar = count( $this->registrosPagina);
        
        if($this->contar > 0):
            $this->resultado =  $this->registrosPagina[$this->atual-1];
            return $this->resultado;
        else:
            return[];
        endif;
    }

    // $this->currentURL() antes do ?page por
    public function navigator()
    {
        echo "<ul class='pagination'>";
            for($i = 1; $i <= $this->contar; $i++):
                if($i == $this->atual):
                    echo "<li class='active'><a href='#'>".$i."</a></li>";
                else:
                    echo "<li><a href='".$this->curr."?page=".$i."'>".$i."</a></li>";
                endif;
            endfor;
        echo "</ul>";
    }
}