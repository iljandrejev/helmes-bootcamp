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

    public function update($id, $details)
    {
        $reservation = $this->getReservation($id);
        $reservation->setDetails($details);
        $this->_em->persist($reservation);
        $this->_logger->info('Reservation record updated successfully, Reservation details=' . $reservation);
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
        $reservation->setDetails($details);
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