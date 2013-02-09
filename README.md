git-pre-commit
==============


Requisitos adicionales
-----------------------

Si quieres utilizar los filtros de CodeSniffer o PHPMessDetector, debes tenerlos instalados.

Puedes conseguirlos en:
http://pear.php.net/package/PHP_CodeSniffer/redirected
http://phpmd.org/download/index.html


Instalación
------------

Copiar todo el contenido al directorio <pre>.git/hooks/</pre> de tu repositorio.


Editar el archivo <pre>pre-commit</pre> y cambia las rutas por las correctas para tu caso:

<pre>
#!/bin/sh
c:\\wamp\\bin\\php\\php5.3.5\\php.exe "C:\\wamp\\www\\git-pre-commit\\.git\\hooks\\pre-commit-files\\pre-commit.php"
</pre>


También debes editar el archivo <pre>pre-commit-files/config.php</pre> si quieres usar filtros que necesitan ejecutables externos (phpLinter, phpMessDetector, phpCodeSniffer)

<pre>
    // Paths de los ejecutables
    'php'        => 'C:\\wamp\\bin\\php\\php5.3.5\\php.exe',
    'phpCS'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpcs.bat',
    'phpMD'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpmd.bat',	
</pre>



Configuración adicional
-----------------------

En el archivo de configuración <pre>pre-commit-files/config.php</pre> puedes configurar otros aspectos.


<pre>fileFilter</pre> sirve para especificar los archivos que serán procesados por los filtros, en este caso, solo los archivos .php

```
	'fileFilter' => '/\.php$/',
```


<pre>filters</pre> es el listado de filtros que procesarán los archivos que hemos elegido

```
    'filters'    => array(
        'phpLinter',        // Comprueba si hay errores de sintaxis 'php.exe -l'
        'phpCodeSniffer',   // CodeSniffer, se pueden definir una serie de reglas para hacer código homogeneo
        'phpMessDetector',  // MessDetector, se pueden definir una serie de reglas para hacer código homogeneo
        'debugWords'        // Comprueba si nos hemos dejado olvidadas palabras o funcionces que usamos para debuggear p. ej. fucker
    ),
```


El resto del archivo de configuración, es específico para cada filtro.