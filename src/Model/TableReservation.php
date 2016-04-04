<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 04.04.2016
 * Time: 2:47
 */
namespace Model;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="table_reservation")
 */
class TableReservation{

    /**
     * @ORM\Id
     * @ORM\Column(name="table_reservation_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $_id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Table",inversedBy="table_reservation")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="table_id")
     *
     *
     */
    private $_table;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="table_reservation")
     * @ORM\JoinColumn(name="id", referencedColumnName="reservation_id")
     *
     *
     */
    private $_reservation;

    /**
     * @ORM\Column(name="start_datetime", type="datetime")
     *
     * @var string
     */
    private $_startDatetime;

    /**
     * @ORM\Column(name="end_datetime", type="datetime")
     *
     * @var string
     */
    private $_endDatetime;
    /**
     * @ORM\Column(name="is_canceled", type="boolean")
     *
     * @var boolean
     */
    private $_isCanceled;

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
     * @return mixed
     */
    public function getTable()
    {
        return $this->_table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->_table = $table;
    }

    /**
     * @return mixed
     */
    public function getReservation()
    {
        return $this->_reservation;
    }

    /**
     * @param mixed $reservation
     */
    public function setReservation($reservation)
    {
        $this->_reservation = $reservation;
    }

    /**
     * @return string
     */
    public function getStartDatetime()
    {
        return $this->_startDatetime;
    }

    /**
     * @param string $startDatetime
     */
    public function setStartDatetime($startDatetime)
    {
        $this->_startDatetime = $startDatetime;
    }

    /**
     * @return string
     */
    public function getEndDatetime()
    {
        return $this->_endDatetime;
    }

    /**
     * @param string $endDatetime
     */
    public function setEndDatetime($endDatetime)
    {
        $this->_endDatetime = $endDatetime;
    }

    /**
     * @return boolean
     */
    public function isIsCanceled()
    {
        return $this->_isCanceled;
    }

    /**
     * @param boolean $isCanceled
     */
    public function setIsCanceled($isCanceled)
    {
        $this->_isCanceled = $isCanceled;
    }

    public function addTableReservation($details){
        $this->_isCanceled = false;
        
    }

}