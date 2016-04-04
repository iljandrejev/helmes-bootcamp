<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 01.04.2016
 * Time: 7:22
 */
namespace Dao;

use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

class Restaurant 
{
    private $_logger;
    private $_em;
    private $_repository;

    public function __construct()
    {
        $this->_logger = new Logger(get_class($this));
        $this->_logger->pushHandler(new ErrorLogHandler());
        $this->_em = EntityManager::getInstance()->getManager();
        $this->_repository = $this->_em->getRepository('Model\Restaurant');
    }

    public function getRestaurant($id)
    {
        $restaurant = $this->_repository->findOneBy(array('_id' => $id));
        $this->_logger->info('Restaurant loaded successfully, Restaurant details=' );
        return $restaurant;
    }

    public function getRestaurants()
    {
        $restaurants = $this->_repository->findAll();
        foreach ($restaurants as $restaurant) {
            $this->_logger->info('Restaurant::' );
        }
        return $restaurants;
    }

    public function update($id, $details)
    {
        $restaurant = $this->getRestaurant($id);
        $restaurant->addRestaurant($details);
        $this->_em->persist($restaurant);
        $this->_logger->info('Restaurant record updated successfully, Restaurant details=' );
    }

    public function delete($id)
    {
        $restaurant = $this->getRestaurant($id);
        $this->_em->remove($restaurant);
        $this->_logger->info('Restaurant deleted successfully, Restaurant details=' );
        $this->_em->flush();
    }

    public function add($details)
    {
        $restaurant = new \Model\Restaurant();
        $restaurant->addRestaurant($details);
        $this->_em->persist($restaurant);
        $this->_em->flush($restaurant);
        $this->_logger->info('Restaurant record saved successfully');
        return $restaurant;
    }

    function __destruct()
    {
        $this->_em->flush();
    }
}
