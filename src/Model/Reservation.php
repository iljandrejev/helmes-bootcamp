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
     * @ORM\Column(name="details", length=2000)
     *
     * @var string
     */
    private $_details;

    /**
     * @ORM\Column(name="date", type="datetime")
     *
     * @var string
     */

    private $_date;

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
        return $this->_date . " ";
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
        $this->setDate(new \DateTime(date('Y-m-d H:i:s')));
    }

    /**
     * @return string
     */
    function __toString()
    {
        return 'ID: ' . $this->_id . ', Details: ' . $this->_details;
    }

}