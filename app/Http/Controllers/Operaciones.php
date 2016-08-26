<?php

namespace App\Http\Controllers;

class Operaciones
{

    /**
     * @var integer
     */
    public $operando1;

    /**
     * @var integer
     */
    public $operando2;


    /**
     * Operación de Suma
     *
     * @param integer $a
     * @param integer $b
     * @return integer
     */
    public function suma($a, $b)
    {
       return ($a + $b);
    }

    /**
     * Operación de Resta
     *
     * @param integer $a
     * @param integer $b
     * @return integer
     */
    public function resta($a, $b)
    {
        return ($a - $b);
    }

}