<?php

    $config = array(

        // Paths de los ejecutables
        'php'        => 'C:\\wamp\\bin\\php\\php5.3.5\\php.exe',
        'phpCS'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpcs.bat',
        'phpMD'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpmd.bat',

        // Filtro de archivos que se procesarán
        'fileFilter' => '/\.php$/',

        // Acciones a realizar antes del commit
        'filters'    => array(
            'phpLinter',        // Comprueba si hay errores de sintaxis 'php.exe -l'
            'phpCodeSniffer',   // CodeSniffer, se pueden definir una serie de reglas para hacer código homogeneo
            'phpMessDetector',  // MessDetector, se pueden definir una serie de reglas para hacer código homogeneo
            'debugWords'        // Comprueba si nos hemos dejado olvidadas palabras o funcionces que usamos para debuggear p. ej. fucker
        ),

        // Standard de código a comprobar por CodeSniffer
        // Disponibles:  MySource, PEAR, PHPCS, PSR1, PSR2, Squiz y Zend
        'standard'   => 'PSR1',

        // Reglas MessDetector
        // - codesize       => Reglas sobre el tamaño del código
        // - controversial  => Reglas varias como camelcase, globales, et...
        // - design         => Reglas para buscar problemas de diseño en el código
        // - naming         => Reglas sobre nombres de funciones, variables, etc... 
        // - unusedcode     => Busca código inutil (Que no se usa)
        'rules'      => array('codesize', 'controversial', 'design', 'naming', 'unusedcode'),

        // Lista de palabras a buscar
        'debugWords' => array(
            'fucker',
            'TO-DO',
            'TODO',
            'FIXME',
            'die',
            'print_r',
            'var_dump',
            'Util::dump'
        )

    );
