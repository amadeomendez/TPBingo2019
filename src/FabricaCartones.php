<?php
namespace Bingo;
class FabricaCartones {
    public function generarCarton() {
        // Algo de pseudo-código para ayudar con la evaluacion.
        $carton = $this->intentoCarton();
        while (!($this->cartonEsValido($carton))) {
            $carton = $this->intentoCarton();
        }
        return $carton;
    }
    public function formatoAFilas($columnas) {
        foreach ($columnas as $indice_columna => $fila) {
            foreach ($fila as $indice_fila => $numero) {
                $filas[$indice_fila][$indice_columna] = $numero;
            }
        }
        return $filas;
    }
    protected function cartonEsValido($carton) {
        if ($this->validarUnoANoventa($carton) && 
	    $this->validarCincoNumerosPorFila($carton) && 
	    $this->validarColumnaNoVacia($carton) && 
	    $this->validarColumnaCompleta($carton) && 
	    $this->validarTresCeldasIndividuales($carton) && 
	    $this->validarNumerosIncrementales($carton) && 
	    $this->validarFilasConVaciosUniformes($carton)) {
            return TRUE;
        }
        return FALSE;
    }
    protected function validarUnoANoventa($carton) {
        foreach ($carton as $fila) {
            foreach (array_filter($fila) as $num) {
                if ($num >= 1 && $num <= 90) {
                } else {
                    return false;
                }
            }
        }
        return true;
    }
    protected function validarCincoNumerosPorFila($carton) {
        $filas = $this->formatoAFilas($carton);
        foreach ($filas as $fila) {
            if (count(array_filter($fila)) != 5) return false;
        }
        return true;
    }
    protected function validarColumnaNoVacia($carton) {
        foreach ($carton as $columna) {
            if (count(array_filter($columna)) < 1) return false;
        }
        return true;
    }
    protected function validarColumnaCompleta($carton) {
        foreach ($carton as $columna) {
            if (count(array_filter($columna)) == 3) return false;
        }
        return true;
    }
    protected function validarTresCeldasIndividuales($carton) {
        $validas = 0;
        foreach ($carton as $columna) {
            if (count(array_filter($columna)) == 1) {
                $validas++;
            }
        }
        return ($validas == 3);
    }
    protected function validarNumerosIncrementales($carton) {
        $ordenado = function ($array) {
            $len = count($array);
            for ($i = 0;$i < $len - 1;$i++) {
                if ($array[$i] >= $array[$i + 1]) return false;
            }
            return true;
        };
        $carton = $this->formatoAFilas($carton);
        foreach ($carton as $fila) {
            $celdasOcupadas = array_values(array_filter($fila));
            if (!$ordenado($celdasOcupadas)) {
                return false;
            }
        }
        return true;
    }
    public function validarFilasConVaciosUniformes($carton) {
        $numMaxDeCeldasVaciasConsecutivas = function ($array) {
            $len = count($array);
            $cant = 0;
            $res = 0;
            foreach ($array as $num) {
                if ($num != 0) {
                    $cant = 0;
                } else {
                    $cant++;
                    $res = max($res, $cant);
                }
            }
            return $res;
        };
        $carton = $this->formatoAFilas($carton);
        foreach ($carton as $fila) {
            if (2 < $numMaxDeCeldasVaciasConsecutivas($fila)) {
                return false;
            } else {
                return true;
            }
        }
    }
    public function intentoCarton() {
        $contador = 0;
        $carton = [[0, 0, 0], [0, 0, 0], [0, 0, 0], [0, 0, 0], [0, 0, 0], [0, 0, 0], [0, 0, 0], [0, 0, 0], [0, 0, 0]];
        $numerosCarton = 0;
        while ($numerosCarton < 15) {
            $contador++;
            if ($contador == 50) {
                return $this->intentoCarton();
            }
            $numero = rand(1, 90);
            $columna = floor($numero / 10);
            if ($columna == 9) {
                $columna = 8;
            }
            $huecos = 0;
            for ($i = 0;$i < 3;$i++) {
                if ($carton[$columna][$i] == 0) {
                    $huecos++;
                }
                if ($carton[$columna][$i] == $numero) {
                    $huecos = 0;
                    break;
                }
            }
            if ($huecos < 2) {
                continue;
            }
            $fila = 0;
            for ($j = 0;$j < 3;$j++) {
                $huecos = 0;
                for ($i = 0;$i < 9;$i++) {
                    if ($carton[$i][$fila] == 0) {
                        $huecos++;
                    }
                }
                if ($huecos < 5 || $carton[$columna][$fila] != 0) {
                    $fila++;
                } else {
                    break;
                }
            }
            if ($fila == 3) {
                continue;
            }
            $carton[$columna][$fila] = $numero;
            $numerosCarton++;
            $contador = 0;
        }
        for ($x = 0;$x < 9;$x++) {
            $huecos = 0;
            for ($y = 0;$y < 3;$y++) {
                if ($carton[$x][$y] == 0) {
                    $huecos++;
                }
            }
            if ($huecos == 3) {
                return $this->intentoCarton();
            }
        }
        return $carton;
    }
}
