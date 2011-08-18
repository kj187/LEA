<?php
namespace LEA\MVC\Web;

/**
 * Request Interface
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC\Web
 */
class Request extends \LEA\MVC\Request {

    protected $SERVER = array();
    protected $controllerName = '';
    protected $actionName = '';

    /**
     * Konstruktor
     * Fuege das globale $_REQUEST Array hinzu
     *
     * @return void
     */
    public function __construct() {
        $this->SERVER = $_SERVER;

        $requestArray = explode('/', $this->SERVER['REQUEST_URI']);
        $request = array();
        foreach ($requestArray as $value) {
            if (trim($value) != '') $request[] = $value;
        }

        $this->controllerName = ($request[0] ? ucfirst($request[0]) : 'Index');
        $this->actionName = ($request[1] ? $request[1] : 'index');

        $countOfParameters = count($request);
        if ($countOfParameters > 2) {
            $parameter = array();
            for ($iterator = 2; $iterator <$countOfParameters; $iterator++) {
                $parameter[$request[$iterator]] = ($request[$iterator+1] ? $request[$iterator+1] : '-');
                $iterator++;
            }
            $this->setParameters($parameter);
        }
    }

    /**
     * Liefert schliesslich den Wert eines bestimmten HTTP Headers
     *
     * @param  $name
     * @return void
     */
    public function getHeader($name) {
        $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($_SERVER[$name])) {
            return $_SERVER[$name];
        }

        return NULL;
    }

	/**
	 * Returns the name of the Controller
	 *
	 * @return string
	 */
	public function getControllerName() {
        return $this->controllerName;
	}

	/**
	 * Set the name of the Controller
	 *
     * @param string $controllerName
	 * @return string
	 */
	public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;
	}

	/**
	 * Returns the name of the Action
	 *
	 * @return string
	 */
	public function getActionName() {
        return $this->actionName;
	}

	/**
	 * Set the name of the Action
	 *
     * @param string $actionName
	 * @return string
	 */
	public function setActionName($actionName) {
        $this->actionName = $actionName;
	}

	/**
	 * Returns the the request path relative to the base URI
	 *
	 * @return string
	 */
	public function getRoutePath() {
        return $this->getRequestProtocol() . '://' . $this->getHTTPHost() . str_replace('/index.php' , '', $this->SERVER['REQUEST_URI']);
	}

	/**
	 * Returns the protocol (http or https) used in the request
	 *
	 * @return string The used protol, either http or https
	 */
	public function getRequestProtocol() {
		$protocol = 'http';
		if (isset($this->SERVER['SSL_SESSION_ID'])) {
			$protocol = 'https';
		} elseif (isset($this->SERVER['HTTPS'])) {
			if ($this->SERVER['HTTPS'] === 'on' || strcmp($this->SERVER['HTTPS'], '1') === 0) {
				$protocol = 'https';
			}
		}
		return $protocol;
	}

	/**
	 * Returns the HTTP Host
	 *
	 * @return string The HTTP Host as found in _SERVER[HTTP_HOST]
	 */
	public function getHTTPHost() {
		return isset($this->SERVER['HTTP_HOST']) ? $this->SERVER['HTTP_HOST'] : NULL;
	}

}
