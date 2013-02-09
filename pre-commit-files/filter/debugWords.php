<?php

	function debugWords ($file, $cfg)
	{
		$matches = array();
		$file_contents = file_get_contents($file);

		foreach ($cfg['debugWords'] as $word)
		{
			if (stripos($file_contents, $word) !== false)
			{
				$matches[] = $word;
			}
		}

		unset($file_contents);

		if (count($matches) > 0)
		{
			// Mostramos los errores
			echo "--( debugWords )----------------------------------------------------------------\n";
			echo "FOUND ".count($matches)." WORD(S) IN FILE: ".$file."\n";
			echo "--------------------------------------------------------------------------------\n";
			echo "'".implode('\', \'', $matches)."'\n";
			echo "--------------------------------------------------------------------------------\n\n\n";

			return 1;
		}
		else
		{
			return 0;
		}
	}