git-pre-commit
==============

Hooks para git, que nos ayuda a mantener un código homogeneo incluso entre varios desarrolladores siguiendo alguna de los múltiples standares de codificación como MySource, PEAR, PHPCS, PSR1, PSR2, Squiz y Zend.

Además de homogeneizar el código, estos hooks también lo revisan por si hubiera algún error de sintaxis, incluso nos avisa de malas y potencialmente peligrosas prácticas, asi como de código duplicado o si hay partes inútiles en el código que no se emplean.

También podemos definir una lista de palabras o frases, para que el filtro detenga el commit y nos avise si la encuentra en algún archivo.
Esto puede resultar útil para localizar funciones que se pueden usar para depurar y que hemos olvidado eliminar, comentarios en el código, etc.. etc...



Modo de uso
------------

El funcionamiento es muy sencillo cada vez que hagamos commit de nuestros archivos modificados con <code>git commit -am 'mensaje'</code>, estos archivos modificados deberán pasar por todos los filtros definidos en la configuración.

Si hay algún problema o se detecta un error, el commit no llega a completarse. Deberemos solucionar los problemas y volver a hacer <code>git commit -am 'mensaje'</code> para que, ahora si, con los errores solucionados se completará.

Existe la posibilidad de saltarse los filtros en cualquier momento, por ejemplo si hay unos errores de indentación en el código pero tenemos que subir algo muy urgente y no podemos solucionarlo ahora.
En casos como este podemos hacer <code>git commit -am 'mensaje' --no-verify</code> y los filtros serán ignorados por completo y el commit se hará efectivo, igualmente cuando hagamos el siguiente commit nos volverá a avisar de los errores y asi sucesivamente hasta que se solucionen.




Requisitos adicionales
-----------------------

Si quieres utilizar los filtros de CodeSniffer o PHPMessDetector, debes tenerlos instalados.

Puedes conseguirlos en:
http://pear.php.net/package/PHP_CodeSniffer/redirected y
http://phpmd.org/download/index.html




Instalación
------------

Copiar todo el contenido al directorio <code>.git/hooks/</code> de tu repositorio.


Editar el archivo <code>pre-commit</code> y cambia las rutas por las correctas para tu caso:

```
    #!/bin/sh
    c:\\wamp\\bin\\php\\php5.3.5\\php.exe "C:\\wamp\\www\\git-pre-commit\\.git\\hooks\\pre-commit-files\\pre-commit.php"
```


También debes editar el archivo <code>pre-commit-files/config.php</code> si quieres usar filtros que necesitan ejecutables externos (phpLinter, phpMessDetector, phpCodeSniffer)

```php
    // Paths de los ejecutables
    'php'        => 'C:\\wamp\\bin\\php\\php5.3.5\\php.exe',
    'phpCS'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpcs.bat',
    'phpMD'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpmd.bat',	
```



Configuración adicional
-----------------------

En el archivo de configuración <code>pre-commit-files/config.php</code> puedes configurar otros aspectos.


<code>fileFilter</code> sirve para especificar los archivos que serán procesados por los filtros, en este caso, solo los archivos .php

```php
	'fileFilter' => '/\.php$/',
```


<code>filters</code> es el listado de filtros que procesarán los archivos que hemos elegido

```php
    'filters'    => array(
        'phpLinter',        // Comprueba si hay errores de sintaxis 'php.exe -l'
        'phpCodeSniffer',   // PHP CodeSniffer
        'phpMessDetector',  // PHP Mess Detector
        'debugWords'        // Comprueba si nos hemos dejado olvidadas palabras o funcionces que usamos para debuggear p. ej. Util::dump
    ),
```


El resto del archivo de configuración, es específico para cada filtro.


Por ejemplo <code>standard</code> sirve para decirle a CodeSniffer que reglas de codificación stantard debe comprobar.

```php
    'standard'   => 'PSR1',
```
Hay varios conjuntos de reglas disponibles: <code>MySource, PEAR, PHPCS, PSR1, PSR2, Squiz y Zend</code>


El siguiente parámetro <code>rules</code> define las reglas que usará PHP Mess Detector, de entre las disponibles podemos usar una, varias, todas o ninguna:

```php
    'rules'      => array('codesize', 'controversial', 'design', 'naming', 'unusedcode'),

    // Reglas PhpMessDetector
    // - codesize       => Reglas sobre el tamaño del código
    // - controversial  => Reglas varias como camelcase, globales, et...
    // - design         => Reglas para buscar problemas de diseño en el código
    // - naming         => Reglas sobre nombres de funciones, variables, etc... 
    // - unusedcode     => Busca código inutil (Que no se usa)
```


Por último podemos configurar el filtro <code>debugWords</code>, este filtro busca palabras como por ejemplo funciones que solemos usar al debuggear, palabras clave, etc...
Debemos poner en el array <code>debugWords</code> todas las palabras que queramos buscar en los archivos del commit.

```php
'debugWords' => array('TO-DO', 'FIXME', 'die', 'print_r', 'var_dump', 'Util::dump')
```