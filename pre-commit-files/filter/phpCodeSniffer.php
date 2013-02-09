<?php

	function phpCodeSniffer ($file, $cfg)
	{

		$cs_output = array();
		$cs_return = 0;
		exec("{$cfg['phpCS']} --standard=". $cfg['standard'] ." ". escapeshellarg($file), $cs_output, $cs_return);

		// ¿Hay algún error? Lo mostramos y cancelamos el commit
	    if ($cs_return != 0)
	    {
	    	echo "--( CodeSniffer )---------------------------------------------------------------";
	    	echo implode("\n", $cs_output)."\n\n";
	    	
	    	return 1;
	    } 
	    else
	    {
	    	return 0;
	    }
		
	}
