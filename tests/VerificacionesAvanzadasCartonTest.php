<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   * @dataProvider cartones
   */
  public function testUnoANoventa( CartonInterface $carton ) {
	  var_dump($carton);
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
   * @dataProvider cartones
   */
  public function testCincoNumerosPorFila( CartonInterface $carton ) {
		foreach ( $carton->filas() as $fila ) {
			$this->assertEquals(
				5, count(array_filter( $fila, function($x){return $x != 0;} ))
			);
		}
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   * @dataProvider cartones
   */
  public function testColumnaNoVacia( CartonInterface $carton ) {
		foreach( $carton->columnas() as $columna ) {
			$this->assertGreaterThan(
				0, count(array_filter($columna, function($x){return $x != 0;}))
			);
		}
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   * @dataProvider cartones
   */
  public function testColumnaCompleta( CartonInterface $carton ) {
		foreach( $carton->columnas() as $columna ) {
			$this->assertNotEquals(
				3, count(array_filter($columna, function($x){return $x != 0;}))
			);
		}
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   * @dataProvider cartones
   */
  public function testTresCeldasIndividuales( CartonInterface $carton ) {
	$columnasConUnaCeldaOcupada = 0;
		foreach( $carton->columnas() as $columna ) {
			if( count(array_filter($columna, function($x){return $x != 0;}))
			== 1) $columnasConUnaCeldaOcupada += 1;
		}
		$this->assertEquals( 3, $columnasConUnaCeldaOcupada );
  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   * @dataProvider cartones
   */
  public function testNumerosIncrementales( CartonInterface $carton ) {
	$ordenado = function( $array ) {
		$len = count($array);
		for( $i = 0; $i < $len-1; $i++ ) {
			if( $array[$i] >= $array[$i+1] ) return false;
		} return true;
	};
	foreach ( $carton->filas() as $fila ) {
		$celdasOcupadas = array_values(array_filter(
			$fila, function($x){return $x != 0;}
		));
		$this->assertTrue( $ordenado($celdasOcupadas) );
	}
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   * @dataProvider cartones
   */
  public function testFilasConVaciosUniformes( CartonInterface $carton ) {
	$numMaxDeCeldasVaciasConsecutivas = function( $array ) {
		$len = count( $array );
		$cant = 0; $res = 0;
		foreach( $array as $num ) {
			if( $num != 0 ) $cant = 0;
			else{           $cant++  ; $res = max($res, $cant); }
		} return $res;
	};
	foreach ( $carton->filas() as $fila ) {
		$this->assertLessThanOrEqual(
			2, $numMaxDeCeldasVaciasConsecutivas( $fila )
		);
	}
  }

  public function cartones () {
	  return[
	  	[new CartonEjemplo],
		[new CartonJs],
		[new Carton((new FabricaCartones)->generarCarton())]
	  ];
  }

}
