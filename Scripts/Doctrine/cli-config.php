<?php

/**
 * Get SQL dump
 * ./doctrine orm:schema-tool:create --dump-sql > ../../Data/Persistence/MySQL_Structure.sql
 *
 *
 *
 */


require_once '../../Library/Doctrine/Common/ClassLoader.php';
define('APPLICATION_CONTEXT', 'development');
define('ROOT', __DIR__ . '/../../');


 // Setup Autoloader (1)
// Define application environment
define('APPLICATION_ENV', "development");

/*
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
*/

// Autoloader (1)
 $classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
 $classLoader->register();

 $classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__);
 $classLoader->register();
 $classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__);
 $classLoader->register();

// configuration (2)
 $doctrineConfiguration = new \Doctrine\ORM\Configuration();

 $doctrineConfiguration->setProxyDir(ROOT . 'Data/Proxies/Doctrine/');
 $doctrineConfiguration->setProxyNamespace('LEA\Proxies');
 $doctrineConfiguration->setAutoGenerateProxyClasses((APPLICATION_CONTEXT == 'development'));

// Driver (4)
 $driverImpl = $doctrineConfiguration->newDefaultAnnotationDriver(ROOT . 'Application/Domain/Model/');
 $doctrineConfiguration->setMetadataDriverImpl($driverImpl);

// Caching Configuration (5)
 if (APPLICATION_ENV == "development") {

     $cache = new \Doctrine\Common\Cache\ArrayCache();

 } else {

     $cache = new \Doctrine\Common\Cache\ApcCache();
 }

 $doctrineConfiguration->setMetadataCacheImpl($cache);
 $doctrineConfiguration->setQueryCacheImpl($cache);

$connectionOptions = array(
	'driver'    => 'pdo_mysql',
	'user'      => 'lea',
	'password'  => 'lea',
	'dbname'    => 'lea',
	'host'      => 'localhost'
);

 $em = \Doctrine\ORM\EntityManager::create($connectionOptions, $doctrineConfiguration);

 $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
     'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
     'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
 ));

?>