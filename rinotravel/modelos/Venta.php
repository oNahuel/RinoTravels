<?php

class Venta
{
    private int $pasaje_id;
    private int $cliente_id;

    public function __construct(int $pasaje_id, int $cliente_id)
    {
        $this->pasaje_id = $pasaje_id;
        $this->cliente_id = $cliente_id;
    }
     
}



