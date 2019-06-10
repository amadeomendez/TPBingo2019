## Respuestas del Informe

- `.gitignore` hace que todos los archivos, directorios, o extensiones de archivos especificados sean ignorados en directorio del repositorio que Git va a trackear. En el caso actual, `.gitignore` ignora el directorio `vendor`. Una de las limitaciones que encontramos es que al haber añadido un archivo con `git add` no podremos ignorarlo a menos que se elimine.
- El archivo `.travis.yml` añade información al repositorio para que TravisCI sepa cómo actuar a la hora de hacer los tests. Travis no sabe qué lenguaje estamos utilizando, así que el archivo indica que usamos PHP (versión 7.2). Además, indica que el código requiere `Composer` y que los tests a probar están en la carpeta `tests`.
-
