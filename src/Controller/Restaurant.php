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

    public function defaultView(){
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

    public function deleteView($id)
    {
        $restaurant = $this->_service->findOneById($id);
        $this->setModel(array('restaurant' => $restaurant));
        return $this->display('deleteRestaurant.twig');
    }

    public function createView()
    {
        $hour = (int)date("H");
        if($hour == 23){
            $hour = "00";
        }else{
            $hour = $hour;
        }
        $this->setModel(array('startDate' => date("Y-m-d") . " " . $hour . ":00"));
        return $this->display('newRestaurant.twig');
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
        $restaurant = $this->_service->add($post);
        return $this->detailsView($restaurant->getId());
       

    }

}