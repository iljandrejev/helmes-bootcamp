<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 9.03.16
 * Time: 12:41
 */

namespace Dao;

use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

class Reservation
{
    private $_logger;
    private $_em;
    private $_repository;

    public function __construct()
    {
        $this->_logger = new Logger(get_class($this));
        $this->_logger->pushHandler(new ErrorLogHandler());
        $this->_em = EntityManager::getInstance()->getManager();
        $this->_repository = $this->_em->getRepository('Model\Reservation');
    }

    public function getReservation($id)
    {
        $reservation = $this->_repository->findOneBy(array('_id' => $id));
        $this->_logger->info('Reservation loaded successfully, Reservation details=' . $reservation);

        return $reservation;
    }

    public function getReservations()
    {
        $reservations = $this->_repository->findAll();
        foreach ($reservations as $reservation) {
            $this->_logger->info('Reservation::' . $reservation);
        }
        return $reservations;
    }

    public function getReservationsByDate(){
        $reservations = $this->_repository->findBy(array(),array('_reservationDatetime'=>'ASC'));
        foreach ($reservations as $reservation) {
            $this->_logger->info('Reservation::' . $reservation);
        }
        return $reservations;
    }


    public function filter($case,$from=null, $to=null, $restaurant=null){
      $queryBuilder = $this->_em->createQuery("SELECT r FROM Model\Reservation r WHERE " . $this->filterDQL($case,$from,$to,$restaurant));

        return $queryBuilder->getResult();
    }

    private function filterDQL($case,$from=null,$to=null,$restaurant=null){
        switch ($case){
            case 1:
                // $from - NOT NULL | $to - NULL | $restaurant - NULL
                $date = new \DateTime($from);
                return "r._reservationDatetime > '" . $date->format("Y-m-d") . "'";
            case 2:
                $date = new \DateTime($to);
                return "r._reservationDatetime < '" . $date->format("Y-m-d") ."'";
            case 3:
                return "r._restaurant='".$restaurant ."'";
            case 4:
                return $this->filterDQL(1,$from) . " AND " . $this->filterDQL(3,null,null,$restaurant);
            case 5:
                return $this->filterDQL(2,null,$to) . " AND " . $this->filterDQL(3,null,null,$restaurant);
            case 6:
                return $this->filterDQL(1,$from) . " AND " . $this->filterDQL(2,null,$to);
            case 7:
                return $this->filterDQL(6,$from,$to) . " AND " . $this->filterDQL(3,null,null,$restaurant);
        }
    }

    public function update($id, $details)
    {
        
        $reservation = $this->getReservation($id);
        $reservation->updateReservation($details);
        $this->_em->persist($reservation);
        $this->_logger->info('Reservation record updated successfully, Reservation details=' . $reservation);
    }
    
    public function cancel($id){
        $reservation = $this->getReservation($id);
        $reservation->cancelReservation();
        $this->_em->persist($reservation);
        $this->_logger->info('Reservation record canceled successfully, Reservation details=' . $reservation);
        
    }

    public function delete($id)
    {
        $reservation = $this->getReservation($id);
        $this->_em->remove($reservation);
        $this->_logger->info('Reservation deleted successfully, Reservation details=' . $reservation);
        $this->_em->flush();
    }

    public function add($details)
    {
        $reservation = new \Model\Reservation();
        $reservation->addReservation($details);
        $this->_em->persist($reservation);
        $this->_em->flush($reservation);
        $this->_logger->info('Reservation record saved successfully');
        return $reservation;
    }

    function __destruct()
    {
        $this->_em->flush();
    }
}