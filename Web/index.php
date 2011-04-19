<?php
declare(ENCODING = 'utf-8');

/**
 * Bootstrap for the LEA Framework
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 */

define('APPLICATION_CONTEXT', getenv('APPLICATION_CONTEXT'));

// Error reporting
error_reporting ( E_ALL ^ E_NOTICE );
ini_set ( 'display_errors', 'On' );

define('ROOT', __DIR__ . '/../');

if (APPLICATION_CONTEXT == '') {
    die('KEIN KONTEXT');
}

require __DIR__ . '/../Library/LEA/Core/Bootstrap.php';
$className = '\LEA\Core\Bootstrap';
$lea = new $className();
$lea->initialize();
$lea->run();

?>