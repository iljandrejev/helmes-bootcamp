<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 03.04.2016
 * Time: 19:42
 */
namespace Dao;

use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

class Table
{
    private $_logger;
    private $_em;
    private $_repository;

    public function __construct()
    {
        $this->_logger = new Logger(get_class($this));
        $this->_logger->pushHandler(new ErrorLogHandler());
        $this->_em = EntityManager::getInstance()->getManager();
        $this->_repository = $this->_em->getRepository('Model\Table');
    }

    public function getTable($id)
    {
        $table = $this->_repository->findOneBy(array('_id' => $id));
        $this->_logger->info('Table loaded successfully, Table details=' );
        return $table;
    }

    public function getTables()
    {
        $tables = $this->_repository->findAll();
        foreach ($tables as $table) {
            $this->_logger->info('Table::' );
        }
        return $tables;
    }

    public function update($id, $details)
    {
        $table = $this->getTable($id);
        $table->addTable($details);
        $this->_em->persist($table);
        $this->_logger->info('Table record updated successfully,');
    }

    public function delete($id)
    {
        $table = $this->getTable($id);
        $this->_em->remove($table);
        $this->_logger->info('Table deleted successfully');
        $this->_em->flush();
    }

    public function add($details)
    {
        $table = new \Model\Table();
        $table->addTable($details);
        $this->_em->persist($table);
        $this->_em->flush($table);
        $this->_logger->info('Table record saved successfully');
        return $table;
    }

    function __destruct()
    {
        $this->_em->flush();
    }
}
