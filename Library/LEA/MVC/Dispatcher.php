<?php
declare(ENCODING = 'utf-8');
namespace LEA\MVC;

/**
 * Dispatches requests to the controller which was specified by the request and
 * returns the response the controller generated.
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC
 */
class Dispatcher {

	/**
	 * @var array
	 */
	protected $configuration = array();

	/**
	 * Constructs the global dispatcher
	 */
	public function __construct(array $configuration) {
        $this->configuration = $configuration;
	}

	/**
	 * Dispatches a request to a controller and initializes the security framework.
	 *
	 * @param \LEA\MVC\RequestInterface $request The request to dispatch
	 * @param \LEA\MVC\ResponseInterface $response The response, to be modified by the controller
	 * @return void
	 */
	public function dispatch(\LEA\MVC\RequestInterface $request, \LEA\MVC\ResponseInterface $response) {

		$class = '\Controller\\' . $request->getControllerName() . 'Controller';
		try {

            if (!method_exists($class, $request->getActionName() . 'Action')) {
                throw new \LEA\MVC\ActionException('Action not found: ' . $request->getActionName() . 'Action)');
            }
            $controller = new $class($this->configuration, $request, $response);

        } catch(\LEA\MVC\ActionException $e) {
            $request->setControllerName('Error');
            $request->setActionName('action');
            $controller = new \Controller\ErrorController($this->configuration, $request, $response);

        } catch(\LEA\Resource\Exception $e) {
            $request->setControllerName('Error');
            $request->setActionName('controller');
            $controller = new \Controller\ErrorController($this->configuration, $request, $response);
        }
        
        #$action = (is_callable(array($controller, $request->getActionName() . 'Action')) ? $request->getActionName() . 'Action' : 'indexAction' );
        $action = $request->getActionName() . 'Action';

        $controller->initializeAction();
		$controller->$action();
        
	}

}
    
?>