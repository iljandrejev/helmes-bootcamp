<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 9.03.16
 * Time: 12:05
 */
namespace Model;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="reservation")
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $_id;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="reservation")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="restaurant_id")
     *
     *
     */
    private $_restaurant;
    /**
     * @ORM\Column(name="details", length=500)
     *
     * @var string
     */
    private $_details;
    /**
     * @ORM\Column(name="reservation_added", type="datetime")
     *
     * @var string
     */
    private $_date;
    /**
     * @ORM\Column(name="reservation_datetime", type="datetime")
     *
     * @var string
     */
    private $_reservationDatetime;
    /**
     * @ORM\Column(name="duration", type="float")
     *
     * @var float
     */
    private $_duration;
    /**
     * @ORM\Column(name="guests_number", type="integer")
     *
     * @var int
     */
    private $_guestsNumber;
    /**
     * @ORM\Column(name="reservation_way", type="string")
     *
     * @var string
     */
    private $_reservationWay;
    /**
     * @ORM\Column(name="person_name")
     *
     * @var string
     */
    private $_personName;
    /**
     * @ORM\Column(name="person_phone")
     *
     * @var string
     */
    private $_personPhone;

    /**
     * @ORM\Column(name="status")
     *
     * @var string
     */
    private $_status;

    /**
     * @ORM\Column(name="last_modified", type="datetime")
     *
     * @var string
     */
    private $_lastModified;
    
    
    
    /*------------------*/
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }
    /**
     * @param datetime $date
     */
    public function setDate($date){
        $this->_date = $date;
    }
    /**
     * @return string
     */
    public function getDate(){
        return $this->_date->format('Y-m-d H:i:s');
    }
    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->_details;
    }
    /**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->_details = $details;
        
    }
    /**
     * @return string
     */
    public function getReservationDatetime()
    {
        return $this->_reservationDatetime->format("d.m.Y H:i");
    }
    /**
     * @param datetime $reservationDatetime
     */
    public function setReservationDatetime($reservationDatetime)
    {
        $this->_reservationDatetime = $reservationDatetime;
    }
    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->_duration;
    }
    /**
     * @param float $duration
     */
    public function setDuration($duration)
    {
        $this->_duration = $duration;
    }
    /**
     * @return int
     */
    public function getGuestsNumber()
    {
        return $this->_guestsNumber;
    }
    /**
     * @param int $guestsNumber
     */
    public function setGuestsNumber($guestsNumber)
    {
        $this->_guestsNumber = $guestsNumber;
    }
    /**
     * @return string
     */
    public function getReservationWay()
    {
        return $this->_reservationWay;
    }
    /**
     * @param string $reservationWay
     */
    public function setReservationWay($reservationWay)
    {
        $this->_reservationWay = $reservationWay;
    }
    /**
     * @return string
     */
    public function getPersonName()
    {
        return $this->_personName;
    }
    /**
     * @param string $personName
     */
    public function setPersonName($personName)
    {
        $this->_personName = $personName;
    }
    /**
     * @return string
     */
    public function getPersonPhone()
    {
        return $this->_personPhone;
    }
    /**
     * @param string $personPhone
     */
    public function setPersonPhone($personPhone)
    {
        $this->_personPhone = $personPhone;
    }
    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->_restaurant;
    }
    /**
     * @param mixed $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->_restaurant = $restaurant;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return datetime
     */
    public function getLastModified()
    {
        return $this->_lastModified;
    }

    /**
     * @param datetime $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->_lastModified = $lastModified;
    }



    public function addReservation($details){
        $this->setReservationDatetime(new \DateTime($details['reservation_datetime']));
        $this->setDuration($details['duration']);
        $this->setGuestsNumber($details['guests_number']);
        $this->setReservationWay($details['reservation_way']);
        $this->setPersonName($details['person_name']);
        $restaurant = new \Dao\Restaurant();
        $this->setRestaurant($restaurant->getRestaurant($details['restaurant']));
        if(!empty($details['person_phone'])){
            $this->setPersonPhone($details['person_phone']);
        }
        $this->setDetails($details['details']);
        $this->setDate(new \DateTime(date('Y-m-d H:i:s')));
        $this->setStatus('created');
    }
    
    public function updateReservation($details){
        $this->setReservationDatetime(new \DateTime($details['reservation_datetime']));
        $this->setDuration($details['duration']);
        $this->setGuestsNumber($details['guests_number']);
        $this->setReservationWay($details['reservation_way']);
        $this->setPersonName($details['person_name']);
        $restaurant = new \Dao\Restaurant();
        $this->setRestaurant($restaurant->getRestaurant($details['restaurant']));
        if(!empty($details['person_phone'])){
            $this->setPersonPhone($details['person_phone']);
        }
        $this->setDetails($details['details']);
        $lm = new \DateTime(date('Y-m-d H:i:s'));
        $this->setLastModified($lm);
        $this->setStatus("modified");
    }
    
    public function cancelReservation(){
        $this->setStatus('canceled');
        $lm = new \DateTime(date('Y-m-d H:i:s'));
        $this->setLastModified($lm);
    }
    
    /**
     * @return string
     */
    function __toString()
    {
        return 'ID: ' . $this->_id . ', Details: ' . $this->_details;
    }
}