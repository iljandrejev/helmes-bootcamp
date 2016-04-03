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

    // This method supposed to  find all reservations witch corresponds to the condition of user needs.
    // Yet do not understand some syntacs rules.
    public function filter($from=null, $to=null, $restaurant=null){

        $reservations = $this->_repository->findBy(array('_reservationDatetime'=> new \DateTime('2016-04-11 10:30') ),array('_reservationDatetime'=>'ASC')); // Returns line where reservation datetime is equal 2016-04-11 10:30

         // SELECT * FROM reservation WHERE reservation_datetime BETWEEN '2016-04-02 AND 2016-04-22'

      $queryBuilder = $this->_em->createQuery(
            'SELECT r
            FROM Model::Reservation r
            WHERE r._reservationDatetime BETWEEN "2016-04-02" AND "2016-04-22"
            '
        );
        $result = $queryBuilder->getResult();
        $queryBuilder
            ->select('r') // Is it same as *
            ->from('Reservation','r')
            ->where('r.reservation_datetime BETWEEN :start AND :end')
            ->setParameter('end',2016-04-21) // Parameters not set
            ->setParameter('start',2016-04-02);

        //echo $queryBuilder->getDQL();

        var_dump($result);
        
        return $queryBuilder->getQuery()->getArrayResult();
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