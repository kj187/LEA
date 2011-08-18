<?php
namespace LEA\MVC;

/**
 * Response interface
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC
 */
interface ResponseInterface {

	/**
	 * Overrides and sets the content of the response
	 *
	 * @param string $content The response content
	 * @return void
	 */
	public function setContent($content);

	/**
	 * Appends content to the already existing content.
	 *
	 * @param string $content More response content
	 * @return void
	 */
	public function appendContent($content);

	/**
	 * Returns the response content without sending it.
	 *
	 * @return string The response content
	 */
	public function getContent();

	/**
	 * Sends the response
	 *
	 * @return void
	 */
	public function send();
}
?>