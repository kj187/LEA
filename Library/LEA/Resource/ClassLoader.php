<?php
namespace LEA\Resource;

/**
 * Autoloader
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\Resource
 */
class ClassLoader {

    protected $includePath = array('Library', 'Application');

    /**
     * @static
     * @param  $class
     * @return void
     */
    public function loadClass($className) {
        $classFound = FALSE;
        $class = str_replace('\\', '/', $className);
        $classArray = explode('/', $class);

        $rawClassName = array_pop($classArray);
        if (strtolower(substr($rawClassName, 0, 6)) == 'smarty') {
            $_class = strtolower($rawClassName);
            if (substr($_class, 0, 16) === 'smarty_internal_' || $_class == 'smarty_security') {
                include ROOT . 'Library/Smarty/sysplugins/' . $_class . '.php';
            }
            return;
        }        

        foreach ($this->includePath as $key => $value) {
            $file = ROOT . $value . DIRECTORY_SEPARATOR . $class . '.php';
            if (file_exists($file)) {
                require $file;
                $classFound = TRUE;
                break;
            }
        }

        if ($classFound === FALSE) {
            throw new \LEA\Resource\Exception('Class not found: ' . $class . '.php (' . $file . ')');
        }
    }

}

?>