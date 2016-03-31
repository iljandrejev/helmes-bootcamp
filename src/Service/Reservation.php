<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 9.03.16
 * Time: 12:41
 */

namespace Service;

class Reservation
{
    /**
     * @var \Dao\Reservation
     */
    private $_dao;

    public function __construct()
    {
        $this->setDao(new \Dao\Reservation());
    }

    public function setDao($dao)
    {
        $this->_dao = $dao;
    }

    public function findAll()
    {
        $reservations = $this->_dao->getReservations();
        return $reservations;
    }

    public function findOneById($id)
    {
        $reservation = $this->_dao->getReservation((int)$id);
        return $reservation;
    }

    public function update($post)
    {
        $id = (int)@$post['id'];
        $details = strip_tags(@$post['details']);
        $this->_dao->update($id, $details);
    }

    public function delete($id)
    {
        $this->_dao->delete((int)$id);
    }

    public function add($post)
    {
        $details = strip_tags(@$post['details']);
        return $this->_dao->add($details);
    }
}