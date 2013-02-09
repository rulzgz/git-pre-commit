<?php

    // Paths de los ejecutables
    $php        = 'C:\\wamp\\bin\\php\\php5.3.5\\php.exe';
    $phpcs      = 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\phpcs.bat';
    $phpcsfixer = 'C:\\wamp\\bin\\php\\php5.3.5\\PEAR\\php-cs-fixer.phar';

    // Acciones a realizar antes del commit
    $actions = array(
            'phpLint',
            'phpCs',
            'debugWords',
    );
