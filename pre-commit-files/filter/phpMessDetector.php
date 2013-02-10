<?php

	function phpMessDetector ($file, $cfg)
	{
		$md_output = array();
		$md_return = 0;

		// Preparamos la llamada al ejecutable externo
		$command = $cfg['phpMD'] . ' ' . $file . ' text ' . implode(',', $cfg['rules']);
		exec($command , $md_output, $md_return);

		// ¿Hay algún error? Lo mostramos y cancelamos el commit
	    if ($md_return != 0)
	    {
	    	echo "--( MessDetector )--------------------------------------------------------------\n";
	    	echo "FILE: ".$file."\n";
	    	echo "--------------------------------------------------------------------------------";
	    	echo implode("\n", $md_output)."\n";
	    	echo "--------------------------------------------------------------------------------\n\n\n";	    	
	    	return 1;
	    } 
	    else
	    {
	    	return 0;
	    }
	}

