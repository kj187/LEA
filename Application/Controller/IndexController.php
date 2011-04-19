<?php
declare(ENCODING = 'utf-8');
namespace Controller;

/**
 * Index controller
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package Controller
 */
class IndexController extends \LEA\MVC\Controller\BaseController {

    protected $userRepository = NULL;

    /**
     *
     */
    public function initializeAction() {
        $this->userRepository = new \Domain\Repository\UserRepository();
    }

    /**
     * 
     */
	public function indexAction() {
	    $this->view->assign('users', $this->userRepository->findAll());
	}

    /**
     * Just a test, add a new dummy user
     *
     * @return void
     */
    public function addAction() {
        $this->userRepository->addUser();
        $this->redirect('index');
    }

}

?>
