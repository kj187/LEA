<?php
namespace LEA\MVC\View;
require_once ROOT . '/Library/Smarty/Smarty.class.php';

/**
 * A base view
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC\View
 */
class BaseView extends \Smarty {

    protected $configuration = array();
    protected $templateFile = '';

    /**
     *
     */
    public function __construct(array $configuration, $templateFile) {
        parent::__construct();
        $this->configuration = $configuration;
        $this->templateFile = $templateFile;
        $this->left_delimiter = $this->configuration['templating']['left_delimiter'];
        $this->right_delimiter = $this->configuration['templating']['right_delimiter'];

        $this->setTemplateDir(ROOT . $this->configuration['templating']['path']['templates']);
        $this->setCompileDir(ROOT . $this->configuration['templating']['path']['compiled']);
        $this->setCacheDir(ROOT . $this->configuration['templating']['path']['cached']);

        $this->assign('_layoutPath', ROOT . $this->configuration['templating']['path']['layouts']);
    }
    
    /**
     * Set a templateFile
     *
     * @param string $templateFile
     * @return void
     */
    public function setTemplateFile($templateFile) {
        $this->templateFile = $templateFile;
    }

    /**
     * @throws Exception
     *
     * @return void
     */
	public function render() {

		try {
            $this->display($this->templateFile);
		} catch(\SmartyException $e) {
			$this->assign('message', $e->getMessage());
            $this->display('Error/Exception/Smarty.html');
			exit(0);
		} catch(Exception $e) {
			echo $e->getMessage();
			exit(0);
		}
	}
}
