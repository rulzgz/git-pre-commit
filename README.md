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

Copiar todo el contenido al directorio <code>.git/hooks/</code> de tu repositorio.


Editar el archivo <code>pre-commit</code> y cambia las rutas por las correctas para tu caso:

<code>
#!/bin/sh
c:\\wamp\\bin\\php\\php5.3.5\\php.exe "C:\\wamp\\www\\git-pre-commit\\.git\\hooks\\pre-commit-files\\pre-commit.php"
</code>


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
        'phpCodeSniffer',   // CodeSniffer, se pueden definir una serie de reglas para hacer código homogeneo
        'phpMessDetector',  // MessDetector, se pueden definir una serie de reglas para hacer código homogeneo
        'debugWords'        // Comprueba si nos hemos dejado olvidadas palabras o funcionces que usamos para debuggear p. ej. fucker
    ),
```


El resto del archivo de configuración, es específico para cada filtro.