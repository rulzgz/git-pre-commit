<?php

	// Obtenemos los paths tanto de los hooks como de los archivos del repositorio
	$pathHooks = realpath(__DIR__);
	$pathFiles = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');

	// Cargamos la configuración
	require_once ($pathHooks.DIRECTORY_SEPARATOR.'config.php');

	// Si no hay acciones para ejecutar salimos para que prosiga el commit
	if (!is_array($config['filters']) || count($config['filters']) == 0) exit(0);

	// Se comprueba si ha habido algún commit previo
	$rc = 0;
	exec('git rev-parse --verify HEAD 2> NUL', $output, $rc); // Linux y macOs en vez de NUL sería /dev/null

	// Si $rc == 0 ha habido algún commit anterior
	// Si $rc == 1 no ha habido ningún commit, aqui lo que se hace es poner un identificador de commit falso 
	// con lo cual se procesarán todos los archivos, ya que 'todos han cambiado' respecto al commit inventado
	if ($rc == 0)  $against = 'HEAD';
	else           $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';

	// Obtenemos la lista de archivos que han cambiado desde el último commit o bien todos ellos
	$modifiedFiles = array();
	exec('git diff-index --cached --name-only --diff-filter=[ACMR] '. $against, $modifiedFiles);

	// Por defecto no hay errores
	$exit_status = 0;

	// Mostramos un banner
	echo "\n\n\n\n================================================================================\n";
	echo " Validación del commit antes de aceptarlo";
	echo "\n================================================================================\n";
	echo "\nSe comprobarán los siguientes archivos: \n\n";
	echo $pathFiles . DIRECTORY_SEPARATOR . implode("\n".$pathFiles . DIRECTORY_SEPARATOR, $modifiedFiles) . "\n";
	echo "\n================================================================================\n\n\n\n";

	// Vamos recorriendo todos los archivos y ejecutando las acciones con cada uno que pase el filtro de archivos
	foreach ($modifiedFiles as $file)
	{
		// Únicamente procesamos los archivos definidos en config.php
        if (!preg_match($config['fileFilter'], $file)) continue;

        // Añadimos el path completo al archivo, teniendo en cuenta la ruta del repositorio
        $filePath = $pathFiles . DIRECTORY_SEPARATOR . $file;

		// Pasamos los filtros		
		foreach ($config['filters'] as $filter) 
		{
			require_once('filter' . DIRECTORY_SEPARATOR . $filter . '.php');
			$resp = call_user_func($filter, $filePath, $config);

			// Con el primer error encontrado ya se bloquea el commit
			if ($resp == 1) $exit_status = 1;
		}
	}

	// Mostramos la conclusión
	if ($exit_status == 1)
	{
		echo "\n!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
		echo " ERROR! - Se han encontrado errores, por favor corrígelos y commitea de nuevo";
		echo "\n!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n\n\n\n";		
	}
	else
	{
		echo "\n!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
		echo " OK! - Todos los archivos han pasado la validación se continúa con el commit :)";
		echo "\n!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n\n\n\n";			
	}

	// Si ha habido errores paramos el commit
	exit($exit_status);
