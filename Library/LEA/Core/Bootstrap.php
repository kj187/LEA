<?php
declare(ENCODING = 'utf-8');
namespace LEA\Core;

/**
 * LEA Framework - Bootstrap
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\Core
 */
class Bootstrap {

    /**
     * @var string
     */
    protected $context = '';

	/**
	 * @var array
	 */
	protected $configuration = array();

    /**
     * Construct
     * 
     */
	public function __construct() {
        $this->context = APPLICATION_CONTEXT;
    }

    /**
     * Initialize bootstrap
     *
     * @return void
     */
	public function initialize() {
        $this->initializeClassLoader();
        $this->initializeDoctrine();
        $this->initializeConfiguration();

        if ($this->configuration['core']['siteLocked'] === TRUE) return;
    }

    /**
     * ClassLoader
     *
     * @return void
     */
    protected function initializeClassLoader() {
        require ROOT . 'Library/LEA/Resource/ClassLoader.php';
        $this->classLoader = new \LEA\Resource\ClassLoader();
        spl_autoload_register(array($this->classLoader, 'loadClass'), TRUE, TRUE);
    }

    /**
     * Initialize Doctrine
     *
     * @return void
     */
    protected function initializeDoctrine() {
        require ROOT . 'Library/Doctrine/Common/ClassLoader.php';
        $classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
        $classLoader->register();
    }

    /**
     * Initialize configuration
     *
     * @return void
     */
    protected function initializeConfiguration() {
        $configuration = new \LEA\Configuration\Configuration();
        $this->configuration = $configuration->initialize()->getConfiguration();
    }

    /**
     * Run application
     *
     * @return void
     */
	public function run() {
        if (!$this->configuration['core']['siteLocked']) {

            $request = new \LEA\MVC\Web\Request();
            $response = new \LEA\MVC\Web\Response();

            $dispatcher = new \LEA\MVC\Dispatcher($this->configuration);
            $dispatcher->dispatch($request, $response);

            $response->send();
            
		} else {
			header('HTTP/1.1 503 Service Temporarily Unavailable');
			readfile(ROOT . 'Resource/Private/Templates/Core/LockHoldingStackPage.html');
		}
    }

}

?>