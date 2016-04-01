<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 01.04.2016
 * Time: 6:34
 */
namespace Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="restaurants")
 */
class Restaurant{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $_id;

    /**
     * @ORM\Column(name="restaurant_name", length=30)
     *
     * @var string
     */
    private $_name;

    /**
     * @ORM\Column(name="aadress", length=100)
     *
     * @var string
     */
    private $_aadress;

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
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getAadress()
    {
        return $this->_aadress;
    }

    /**
     * @param string $aadress
     */
    public function setAadress($aadress)
    {
        $this->_aadress = $aadress;
    }

    public function addRestaurant($details){
        $this->setName($details['restaurant_name']);
        $this->setAadress($details['aadress']);
    }


}