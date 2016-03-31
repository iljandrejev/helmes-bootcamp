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
        $reservations = $this->_service->findAll();
        $this->setModel(array('reservations' => $reservations));
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
        $this->setModel(array('reservation' => $reservation));
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
        return $this->display('newReservation.twig');
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