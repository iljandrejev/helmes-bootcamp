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

    /**
     * @var \Service\Restaurant
     */
    private $_service;

    public function __construct()
    {
        parent::__construct();
        $this->setService(new \Service\Restaurant());
    }

    public function setService($service)
    {
        $this->_service = $service;
    }

    public function defaultView(){
        $restaurants = $this->_service->findAll();
        $this->setModel(array('restaurants'=> $restaurants));
        return $this->display("restaurants.twig");
    }
    
    
    public function detailsView($id)
    {
        $restaurant = $this->_service->findOneById($id);
        $this->setModel(array('restaurant' => $restaurant));
        return $this->display('restaurantDetails.twig');
    }

    public function editView($id)
    {
        $restaurant = $this->_service->findOneById($id);
        $this->setModel(array('restaurant' => $restaurant));
        return $this->display('editRestaurant.twig');
    }

    public function editAction()
    {
        $post = $_POST;
        $this->_service->update($post);
        return $this->detailsView(@$post['id']);
    }

    public function deleteAction()
    {
        $post = $_POST;
        $this->_service->delete(@$post['id']);
        return $this->defaultView();
    }

    public function addAction()
    {
        $post = $_POST;
        $_POST = null;
        $restaurant = $this->_service->add($post);
        return $this->detailsView($restaurant->getId());
       

    }

}