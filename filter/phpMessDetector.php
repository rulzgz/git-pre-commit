<?php

    echo 'MessDetector cargado'."\n";

    /*
    // PHP MessDetector ***********************************************************************************
	$md_output = array();
	$md_return = 0;
	exec("{$phpMD} " . escapeshellarg($cwd .'\\'. $file) . " text codesize,controversial,design,naming,unusedcode", $md_output, $md_return);

	// ¿Hay algún error? Lo mostramos y cancelamos el commit
    if ($md_return != 0)
    {
    	echo "--( MessDetector )--------------------------------------------------------------\n";
    	echo "FILE: ".$cwd .'\\'. $file."\n";
    	echo "--------------------------------------------------------------------------------";
    	echo implode("\n", $md_output)."\n";
    	echo "--------------------------------------------------------------------------------\n\n\n";	    	
    	$exit_status = 1;
    } 
    // ****************************************************************************************************	  
    */