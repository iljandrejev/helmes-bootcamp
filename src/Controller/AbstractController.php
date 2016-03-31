<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 9.03.16
 * Time: 12:47
 */

namespace Controller;

abstract class AbstractController
{
    protected $_model;

    public function __construct()
    {
        $this->_model = array();
    }

    /**
     * Display the Twig template with model
     *
     * @param $templateFileName
     *
     * @return string HTML template
     */
    public function display($templateFileName)
    {
        return $this->_getTwig()->render($templateFileName, $this->_model);
    }

    /**
     * Set view model
     *
     * @param $model
     */
    protected function setModel($model)
    {
        $this->_model = $model;
    }

    /**
     * Initialize and return Twig element
     *
     * @return \Twig_Environment
     */
    private function _getTwig()
    {
        $loader = new \Twig_Loader_Filesystem(REAL_PATH . 'docroot/html');
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig_Extension_Debug());
        return $twig;
    }

}