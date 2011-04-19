<?php
declare(ENCODING = 'utf-8');
namespace LEA\Persistence;

/**
 * A base repository
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\Persistence\Repository
 */
class Repository {

	/**
	 * @var string
	 */
	protected $objectType;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager = NULL;

    /**
     * @var array
     */
    protected $configuration = array();

    /**
     * Initializes a new Repository.
     * 
     */
    public function __construct() {
        $configuration = new \LEA\Configuration\Configuration();
        $this->configuration = $configuration->initialize()->getConfiguration();

        $this->objectType = str_replace(array('\\Repository\\', 'Repository'), array('\\Model\\', ''), get_class($this)) . 'Model';
        $this->initializeDoctrine();
    }

    /**
     * Initialize doctrine
     *
     * @return void
     */
    protected function initializeDoctrine() {
        $doctrineConfiguration = new \Doctrine\ORM\Configuration();

        // Proxy configuration
        $doctrineConfiguration->setProxyDir(ROOT . 'Data/Proxies/Doctrine/');
        $doctrineConfiguration->setProxyNamespace('LEA\Proxies');
        $doctrineConfiguration->setAutoGenerateProxyClasses((APPLICATION_CONTEXT == 'development'));

        // Mapping Configuration
        //$driverImpl = new Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__."/config/mappings/xml");
        //$driverImpl = new Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__."/config/mappings/yml");
        $driverImpl = $doctrineConfiguration->newDefaultAnnotationDriver(ROOT . 'Application/Domain/Model/');
        $doctrineConfiguration->setMetadataDriverImpl($driverImpl);

        // Caching Configuration
        //if (APPLICATION_CONTEXT == 'development') {
            $cache = new \Doctrine\Common\Cache\ArrayCache();
        //} else {
        //    $cache = new \Doctrine\Common\Cache\ApcCache();
        //}
        $doctrineConfiguration->setMetadataCacheImpl($cache);
        $doctrineConfiguration->setQueryCacheImpl($cache);

        // database configuration parameters
        $conn = array(
            'driver'    => $this->configuration['database']['driver'],
            'user'      => $this->configuration['database']['username'],
            'password'  => $this->configuration['database']['password'],
            'dbname'    => $this->configuration['database']['dbname'],
            'host'      => $this->configuration['database']['host']
        );

        // obtaining the entity manager
        $evm = new \Doctrine\Common\EventManager();
        $this->entityManager = \Doctrine\ORM\EntityManager::create($conn, $doctrineConfiguration, $evm);
    }

    /**
     * Finds all 
     *
     * @return
     */
	public function findAll() {
        $dql = 'SELECT t FROM ' . $this->objectType . ' t';
        return $this->entityManager->createQuery($dql)->getResult();
	}

    /**
     * Finds an Entity by its identifier
     *
     * @param integer $identifier
     * @return
     */
	public function findByIdentifier($identifier) {
        return $this->entityManager->find($this->objectType, $identifier);
	}
}

?>
