<?php

namespace Controller;

/**
 * Error controller
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package Controller
 */
class ErrorController extends \LEA\MVC\Controller\BaseController {

    /**
     * @return void
     */
	public function indexAction() {
		
	}

    /**
     * @return void
     */
	public function controllerAction() {
        $this->view->assign('message', 'Controller not found');
		$this->view->setTemplateFile('Error/Exception/Controller.html');
	}

    /**
     * @return void
     */
	public function actionAction() {
        $this->view->assign('message', 'Action not found');
		$this->view->setTemplateFile('Error/Exception/Action.html');
	}

}
