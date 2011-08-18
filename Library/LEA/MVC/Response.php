<?php

namespace LEA\MVC;

/**
 * A generic and very basic response implementation
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC
 */
class Response implements \LEA\MVC\ResponseInterface {

	/**
	 * @var string The response content
	 */
	protected $content = NULL;

	/**
	 * Overrides and sets the content of the response
	 *
	 * @param string $content The response content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * Appends content to the already existing content.
	 *
	 * @param string $content More response content
	 * @return void
	 */
	public function appendContent($content) {
		$this->content .= $content;
	}

	/**
	 * Returns the response content without sending it.
	 *
	 * @return string The response content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sends the response
	 *
	 * @return void
	 */
	public function send() {
		if ($this->content !== NULL) {
			echo $this->getContent();
		}
	}

	/**
	 * Returns the content of the response.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getContent();
	}
}
?>