<?php

    $config = array(


        // Paths de los ejecutables
        'php'        => 'C:\\wamp\\bin\\php\\php5.3.5\\php.exe',            // Path del ejecutable de PHP
        'phpCS'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpcs.bat',    // Path de PHP CodeSniffer (Sólo si queremos usar ese filtro)
        'phpMD'      => 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpmd.bat',    // Path de PHP MessDetector


        // Filtro de archivos que se procesarán
        'fileFilter' => '/\.php$/',


        // Acciones a realizar antes del commit
        // Si no se quiere usar alguna, basta con comentar la linea
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
        'rules'      => array('naming', 'codesize', 'controversial', 'design', 'unusedcode'),

        // Lista de palabras a buscar
        'debugWords' => array('TO-DO', 'FIXME', 'die', 'print_r', 'var_dump', 'Util::dump')

    );
