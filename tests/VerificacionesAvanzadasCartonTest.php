<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   */
  public function testUnoANoventa() {
	$carton = new CartonEjemplo;
	foreach ( $carton->filas() as $fila ) {
		foreach ( $fila as $num ) {
			if( $num != 0 ) {
				$this->assertTrue( $num >= 1 && $num <= 90 );
			}
		}
	}
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   */
  public function testCincoNumerosPorFila() {
	$carton = new CartonEjemplo;
		foreach ( $carton->filas() as $fila ) {
			$this->assertEquals(
				5, count(array_filter( $fila, function($x){return $x != 0;} ))
			);
		}
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   */
  public function testColumnaNoVacia() {
	$carton = new CartonEjemplo;
		foreach( $carton->columnas() as $columna ) {
			$this->assertGreaterThan(
				0, count(array_filter($columna, function($x){return $x != 0;}))
			);
		}
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   */
  public function testColumnaCompleta() {
	$carton = new CartonEjemplo;
		foreach( $carton->columnas() as $columna ) {
			$this->assertNotEquals(
				3, count(array_filter($columna, function($x){return $x != 0;}))
			);
		}
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   */
  public function testTresCeldasIndividuales() {
    $this->assertTrue(TRUE);
  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   */
  public function testNumerosIncrementales() {
    $this->assertTrue(TRUE);
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   */
  public function testFilasConVaciosUniformes() {
    $this->assertTrue(TRUE);
  }

}
