<?php

	// Cargamos la configuración
	$cwd = dirname(__FILE__);
	require "{$cwd}/config.php";

	// Deshabilitamos los errores ya que interfieren con el linter
	error_reporting(0);

	// Si no hay acciones para ejecutar salimos para que prosiga el commit
	if (!is_array($actions) || count($actions) == 0) exit(0);

	// Variable que contendrá los archivos modificados
	$modifiedFiles = null;

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
	exec('git diff-index --cached --name-only '. $against, $modifiedFiles);

	// Por defecto no hay errores
	$exit_status = 0;

	// Cargamos los filtros 
	foreach ($filters as $filter)
	{
		require_once('./filter/'.$filter.'.php');
	}
	

	// Vamos recorriendo todos los archivos y ejecutando las acciones con cada uno que pase el filtro de archivos
	foreach ($modifiedFiles as $file)
	{
		// únicamente procesamos los archivos definidos en config.php
        if (!preg_match($fileFilter, $file)) continue;


	     
   
	    

		
	}

	exit(1);
	// Si ha habido errores paramos el commit
	exit($exit_status);
