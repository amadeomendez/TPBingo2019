# Respuestas del Informe

## ¿Para qué sirve el archivo `.gitignore` incluido en el repositorio? ¿Cuáles son sus limitaciones?

`.gitignore` hace que todos los archivos, directorios, o extensiones de archivos especificados sean ignorados en directorio del repositorio que Git va a trackear. En el caso actual, `.gitignore` ignora el directorio `vendor`. Una de las limitaciones que encontramos es que al haber añadido un archivo con `git add` no podremos ignorarlo a menos que se elimine.

## ¿Para qué sirve el archivo `.travis.yml`? Espeficique que hace cada linea del mismo.

El archivo `.travis.yml` añade información al repositorio para que TravisCI sepa cómo actuar a la hora de hacer los tests. Travis no sabe qué lenguaje estamos utilizando, así que el archivo indica que usamos PHP (versión 7.2). Además, indica que el código requiere `Composer` y que los tests a probar están en la carpeta `tests`.

## ¿Para qué sirve el archivo `composer.json`? ¿Qué diferencia tiene con `composer.lock`? ¿Cómo funciona el concepto de `psr-4` en el archivo `composer.json`? ¿Qué significa el concepto de `autoload`?

El archivo `composer.json` tiene la tarea de especificar las dependencias necesarias para el correcto funcionamiento del programa. `composer.lock`, por su parte, lleva un listado de todas las dependencias utilizadas con sus respectivas funciones, de modo que todos los contribuidores (y también Travis) sepan en qué versión de dichas requieren trabajar.

## Averigüe qué alternativas para composer existen en _NodeJS_ y _Ruby_ existen.

Como alternativas a Composer tenemos a **NPM** en NodeJS y a **Bundler** en Ruby.

## ¿Qué función cumple la palabra `namespace` que aparece al principio de todos los archivos de las carpetas `src` y `tests`? ¿Qué sucede si lo quitamos?

Cuando le damos un **namespace** a un archivo estamos especificando que pertenece a un "grupo", es decir, que de querer ser utilizada alguna de las clases declaradas en el mismo desde otros archivos en el mismo "entorno" no será necesario declararla de nuevo, ahorrando así preciado tiempo y líneas de código. Eliminar las menciones del `namespace Bingo` causaría que los tests dejen de funcionar, ya que PHPUnit referencia a los archivos con dicho namespace (los contenidos en `src` y `tests`). 

## Investigue qué significa el comentario `{@inheritdoc}` que figura en los métodos de la clase `CartonJs` y `CartonEjemplo`.

El comentario `{@inheritdoc}` marca la herencia de documentacion cuando un metodo de una clase es sobrescrito o añadido. Cuando hagamos la documentación de sus clases hijas detallaremos su comportamiento individual, pero no será necesario detallar el comportamiento básico ya que la tag hace que la subclase herede los detalles de su madre.

## ¿Por qué las clases del directorio `tests` extienden de la clase `TestCase`? ¿Qué significa que una clase extienda a otra clase?

La "extensión" de `TestCase` por parte de los archivos de `tests` se debe a que dichas clases requieren, para lograr el correcto funcionamiento del _unit testing_, "heredar" los métodos contenidos en `TestCase` (dichos sean `assertEquals`, `assertTrue`, etc.).
