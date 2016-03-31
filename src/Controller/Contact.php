<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 9.03.16
 * Time: 12:04
 */

namespace Controller;

class Contact extends AbstractController
{
    public function defaultView()
    {
        return $this->display('contacts.twig');
    }

}