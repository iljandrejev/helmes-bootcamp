<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 03.04.2016
 * Time: 19:42
 */

namespace Service;

class Table
{
    /**
     * @var \Dao\Table
     */
    private $_dao;

    public function __construct()
    {
        $this->setDao(new \Dao\Table());
    }

    public function setDao($dao)
    {
        $this->_dao = $dao;
    }

    public function findAll()
    {
        $tables = $this->_dao->getTables();
        return $tables;
    }

    public function findOneById($id)
    {
        $table = $this->_dao->getTable((int)$id);
        return $table;
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