<?php

    // Paths de los ejecutables
    $php        = 'C:\\wamp\\bin\\php\\php5.3.5\\php.exe';
    $phpCS      = 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpcs.bat';

    // Filtro de archivos que se procesarán
    $fileFilter = '/\.php$/';

    // Acciones a realizar antes del commit
    $actions = array(
            'phpLint',      // Comprueba si hay errores de sintaxis
            'phpCs',        // CodeSniffer, se pueden definir una serie de reglas para hacer código homogeneo
            'debugWords'    // Comprueba si nos hemos dejado olvidadas palabras o funcionces que usamos para debuggear p. ej. fucker
    );

    // Lista de palabras que pueden indicar problemas
    $debugWords = array(
        'fucker',
        'TO-DO',
        'TODO',
        'FIXME',
        'die(',
        'print_r(',
        'var_dump('
    );
