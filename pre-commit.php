<?php

	// Cargamos la configuración
	$dirname = dirname(__FILE__);
	require "{$dirname}/Config.php";

	// Si no hay acciones para ejecutar salimos para que prosiga el commit
	if (!is_array($actions) || count($actions) == 0) exit(0);

	// setup up variables for input output, namely an output array and resource control temporary variable
	$output = array();
	$rc     = 0;
	// gets the sha1 for the previous to the last current commit if not the head
	exec('git rev-parse --verify HEAD 2> NUL', $output, $rc); // Linux y mac os
echo($output);

	// if resource controle is found then use HEAD else use an unknown sha1
	if ($rc == 0)  $against = 'HEAD';
	else           $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';

	// gets the list of the files that have changed
	exec('git diff-index --cached --name-only '. $against, $output);

	var_dump($output);

	exit(0);


	foreach ($commandsToRun as $command) {
	$output = array();
	$return = 0;
	exec("{$dirname}/{$command}", $output, $return);
	if ($return != 0) {
	    echo implode("\n", $output) . "\n";
	    exit(1);
	}
	}
