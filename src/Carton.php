<?php

namespace Bingo;

class Carton implements CartonInterface {
  
  protected $numeros_carton = [];

  public function __construct(array $carton_nuevo) {
    $this->numeros_carton = $carton_aleatorio;
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
      $columnas_carton = [[]];
      foreach($this->numeros_carton as $fila){
        foreach($fila as $pos_celda => $celda){
          $columnas_carton[$pos_celda][] = $celda;
        }
      }
    return $columnas_carton;
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
