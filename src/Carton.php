<?php

namespace Bingo;

class Carton {
  
  protected $numeros_carton;

  public function __construct( $numeros ) {
    foreach ( $numeros as $fila ) {
      array_push($this->numeros_carton, $fila);
    }
  }

  public function filas() {
    $res = [];
    foreach ( $this->numeros_carton as $fila ) {
      array_push($res, $fila);
    } return $res;
  }

    public function columnas() {
      return array_map(null, ...$this->numeros_carton);
    }
  
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

    public function tieneNumero(int $numero) {
      return in_array($numero, $this->numerosDelCarton());
    }

}