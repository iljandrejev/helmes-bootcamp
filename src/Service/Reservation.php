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

    public function findAllOrderDate(){
        $reservations = $this->_dao->getReservationsByDate();
        return $reservations;

    }

    public function findOneById($id)
    {
        $reservation = $this->_dao->getReservation((int)$id);
        return $reservation;
    }
    
    public function filter($filter){
        $reservations = $this->_dao->filter(
            $this->getFilterCase($filter['filterFrom'],$filter['filterTo'],$filter['restaurant']),
            $filter['filterFrom'],$filter['filterTo'],$filter['restaurant']);
        return $reservations;
    }
    private function getFilterCase($from=null,$to=null,$restaurant=null){
        if(!empty($from) and empty($to) and empty($restaurant)){
            return 1;
        }elseif(empty($from) and !empty($to) and empty($restaurant)){
            return 2;
        }elseif(empty($from) and empty($to) and !empty($restaurant)){
            return 3;
        }elseif(!empty($from) and empty($to) and !empty($restaurant)){
            return 4;
        }elseif(empty($from) and !empty($to) and !empty($restaurant)){
            return 5;
        }if(!empty($from) and !empty($to) and empty($restaurant)){
            return 6;
        }elseif(!empty($from) and !empty($to) and !empty($restaurant)){
            return 7;
        }
            
    }

    public function update($post)
    {
        $id = (int)@$post['id'];
        $details = strip_tags(@$post['details']);
        $this->_dao->update($id, $post);
    }
    
    public function cancel($id){
        
        $this->_dao->cancel((int)$id);
    }

    public function delete($id)
    {
        $this->_dao->delete((int)$id);
    }

    public function add($post)
    {
        $details = strip_tags(@$post['details']);
        return $this->_dao->add($post);
    }
}