<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 01.04.2016
 * Time: 7:21
 */

namespace Service;

class Restaurant
{
    /**
     * @var \Dao\Restaurant
     */
    private $_dao;

    public function __construct()
    {
        $this->setDao(new \Dao\Restaurant());
    }

    public function setDao($dao)
    {
        $this->_dao = $dao;
    }

    public function findAll()
    {
        $restaurants = $this->_dao->getRestaurants();
        return $restaurants;
    }

    public function findOneById($id)
    {
        $restaurant = $this->_dao->getRestaurant((int)$id);
        return $restaurant;
    }

    public function update($post)
    {
        $id = (int)@$post['id'];
        $this->_dao->update($id, $post);
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