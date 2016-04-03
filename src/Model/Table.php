<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 03.04.2016
 * Time: 18:57
 */
namespace Model;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="restaurant_table")
 */
class Table
{
    /**
     * @ORM\Id
     * @ORM\Column(name="table_id", type="integer")
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
     * @ORM\Column(name="table_number", type="integer")
     *
     * @var int
     */
    private $_tableNumber;
    
    /**
     * @ORM\Column(name="max_seats", type="integer")
     * 
     * @var int
     */
    private $_maxSeats;

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
     * @return int
     */
    public function getTableNumber()
    {
        return $this->_tableNumber;
    }

    /**
     * @param int $tableNumber
     */
    public function setTableNumber($tableNumber)
    {
        $this->_tableNumber = $tableNumber;
    }

    /**
     * @return int
     */
    public function getMaxSeats()
    {
        return $this->_maxSeats;
    }

    /**
     * @param int $maxSeats
     */
    public function setMaxSeats($maxSeats)
    {
        $this->_maxSeats = $maxSeats;
    }

    public function addTable($details){
        $this->setTableNumber($details['table_number']);
        $this->setMaxSeats($details['max_seats_number']);
        $restaurant = new \Dao\Restaurant();
        $this->setRestaurant($restaurant->getRestaurant($details['restaurant']));


    }

  
    
    
    
    
}