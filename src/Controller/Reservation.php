<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 9.03.16
 * Time: 12:04
 */

namespace Controller;

class Reservation extends AbstractController
{
    /**
     * @var \Service\Reservation
     */
    private $_service;

    public function __construct()
    {
        parent::__construct();
        $this->setService(new \Service\Reservation());
    }

    public function setService($service)
    {
        $this->_service = $service;
    }

    public function defaultView()
    {
        $reservations = $this->_service->findAllOrderDate();

        $service = new \Service\Restaurant();
        $restaurants = $service->findAll();

        $this->setModel(array('reservations' => $reservations,"restaurants"=>$restaurants));
        return $this->display('reservations.twig');
    }

    public function detailsView($id)
    {
        $reservation = $this->_service->findOneById($id);
        $this->setModel(array('reservation' => $reservation));
        return $this->display('reservationDetails.twig');
    }

    public function editView($id)
    {
        $reservation = $this->_service->findOneById($id);

        $service = new \Service\Restaurant();
        $restaurants = $service->findAll();

        $date = new \DateTime(date('Y-m-d H:m'));
        $date->setTimestamp($date->getTimestamp() + 3600);

        $this->setModel(array('reservation' => $reservation, 'restaurants'=>$restaurants,'startDate'=>$date->format("Y-m-d H:00")));
        return $this->display('editReservation.twig');
    }

    public function deleteView($id)
    {
        $reservation = $this->_service->findOneById($id);
        $this->setModel(array('reservation' => $reservation));
        return $this->display('deleteReservation.twig');
    }

    public function createView()
    {
        $date = new \DateTime(date('Y-m-d H:m'));
        $date->setTimestamp($date->getTimestamp() + 3600);
        
        $service = new \Service\Restaurant();
        $restaurants = $service->findAll();

        $this->setModel(array('startDate' => $date->format("d.m.Y H:i"), "restaurants"=>$restaurants));
        return $this->display('newReservation.twig');
    }
    
    public function filterView(){
        $post = $_POST;
        $filter['filterFrom'] = $post['filterFrom'];
        $filter['filterTo'] = $post['filterTo'];
        if($post['filterRestaurant'] == "null"){
            $filter['restaurant'] = null;
        }else{
            $filter['restaurant'] = $post['filterRestaurant'];
        }

        if(empty($filter['filterFrom']) && empty($filter['filterTo']) && empty($filter['restaurant'])){
            return $this->defaultView();
        }
        $reservations = $this->_service->filter($filter);

        $service = new \Service\Restaurant();
        $restaurants = $service->findAll();
        
        
        $this->setModel(array('reservations'=>$reservations,'restaurants'=>$restaurants,"filter" => $filter, 'filterView'=>'This is filterview'));
        return $this->display('reservations.twig');
    }

    public function cancelAction(){
        $post = $_POST;
        $this->_service->cancel(@$post['id']);
        return $this->defaultView();

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
        $reservation = $this->_service->add($post);
        return $this->detailsView($reservation->getId());
    }
}