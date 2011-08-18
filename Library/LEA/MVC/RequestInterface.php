<?php

namespace LEA\MVC;

/**
 * Request Interface
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package LEA\MVC
 */
interface RequestInterface {

    /**
     * Liefert eine Liste der Namen aller im Request uebermittelten Parameter zurueck
     *
     * @return void
     */
    public function getParameterNames();

    /**
     * ueberpruft, ob ein bestimmter Parameter uebermittelt wurde
     *
     * @param  $name
     * @return void
     */
    public function issetParameter($name);

    /**
     * Gibt den Wert eines uebermittelten Parameters zurueck
     *
     * @param  $name
     * @return void
     */
    public function getParameter($name);

}
?>
