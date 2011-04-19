<?php
declare(ENCODING = 'utf-8');
namespace LEA\MVC;

/**
 * A generic and very basic request implementation
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC
 */
class Request implements \LEA\MVC\RequestInterface {

    protected $parameters;

    /**
     * Set Parameter
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setParameter($key, $value) {
        $this->parameters[trim($key)] = trim($value);
    }

    /**
     * Set Parameters
     *
     * @param array $paramaters
     * @return void
     */
    public function setParameters(array $parameters) {
        $this->parameters = $parameters;
    }

    /**
     * Liefert eine Liste der Namen aller im Request uebermittelten Parameter zurueck
     *
     * @return void
     */
    public function getParameterNames() {
        return array_keys($this->parameters);
    }

    /**
     * Ueberpruft, ob ein bestimmter Parameter uebermittelt wurde
     *
     * @param  $name
     * @return void
     */
    public function issetParameter($name) {
        return isset($this->parameters[$name]);
    }

    /**
     * Gibt den Wert eines uebermittelten Parameters zurueck
     *
     * @param  $name
     * @return void
     */
    public function getParameter($name) {
        if ($this->issetParameter($name)) {
            return $this->parameters[$name];
        }
        return NULL;
    }

}
?>