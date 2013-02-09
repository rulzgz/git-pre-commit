<?php

    function phpLinter ($file, $cfg)
    {

        $lint_output = array();
        $return = 0;

        exec("{$cfg['php']} -l " . escapeshellarg($file) . " 2> NUL", $lint_output, $return);

        if ($return != 0)
        {
            // Mostramos los errores
            echo "--( phpLinter )-----------------------------------------------------------------\n";
            echo "FILE: ".$file."\n";
            echo "--------------------------------------------------------------------------------";
            echo implode("\n", $lint_output)."\n";
            echo "--------------------------------------------------------------------------------\n\n\n";

            return 1;
        }
        else
        {
            return 0;
        }

    }
