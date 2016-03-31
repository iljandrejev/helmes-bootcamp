<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 31.03.2016
 * Time: 17:14
 */

namespace Controller;


class Restaurant extends AbstractController
{

    public function defaultView(){
        return $this->display("restaurants.twig");
    }

}