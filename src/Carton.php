<?php

namespace Bingo;

class Carton implements CartonInterface {
  
  protected $numeros_carton = [];

  public function __construct(array $columnas) {
    foreach ($columnas as $i_columna => $fila){
      foreach($fila as $i_fila => $numero) {
        $carton_rearmado[$i_fila][$i_columna] = $numero;
      }
    }
    $this->numeros_carton = $carton_rearmado;
  }
  
  /**
   * {@inheritdoc}
   */  
  public function filas() {
    return $this->numeros_carton;
  }
  
  /**
   * {@inheritdoc}
   */ 
    public function columnas() {
      return array_map(null, ...$this->numeros_carton);
    }
  
  /**
   * {@inheritdoc}
   */ 
    public function numerosDelCarton() {
      $numeros = [];
      foreach ($this->filas() as $fila) {
        foreach ($fila as $celda) {
          if ($celda != 0) {
            $numeros[] = $celda;
          }
        }
      }
      return $numeros;
    }

  /**
   * {@inheritdoc}
   */ 
    public function tieneNumero(int $numero) {
      return in_array($numero, $this->numerosDelCarton());
    }

}
