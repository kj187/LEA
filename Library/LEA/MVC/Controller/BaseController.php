<?php

namespace LEA\MVC\Controller;

/**
 * A base controller
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC\Controller
 */
abstract class BaseController {

	protected $view = '';
    protected $configuration = array();
    protected $request = NULL;
    protected $response = NULL;

    /**
     * Construct the base controller
     *
	 * @param \LEA\MVC\RequestInterface $request The request to dispatch
	 * @param \LEA\MVC\ResponseInterface $response The response, to be modified by the controller
     * @param array $configuration
     */
	public function __construct(array $configuration, \LEA\MVC\RequestInterface $request, \LEA\MVC\ResponseInterface $response) {
        $this->request = $request;
        $this->response = $response;
        $this->configuration = $configuration;
        $this->view = new \LEA\MVC\View\BaseView($this->configuration, ucfirst($this->request->getControllerName()) . '/' . ucfirst($this->request->getActionName()) . '.html');
	}

    /**
     * Destruct
     * Execute the templating render process
     *
     * @return void
     */
	public function __destruct() {
		$this->view->render();
	}

    /**
     * 
     */
    public function initializeAction() {

    }

    /**
     * @abstract
     * @return void
     */
	abstract function indexAction();

    /**
     * @return void
     */
    public function redirect($action = 'index', $controller = 'index') {

        // TODO
        // Quick and Dirty solution
        header('Location: /' . $controller . '/' . $action);
    }
    
}

?>