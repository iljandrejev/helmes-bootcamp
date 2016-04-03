<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 03.04.2016
 * Time: 19:42
 */

namespace Controller;

class Table extends AbstractController{

    /**
     * @var \Service\Table
     */
    private $_service;

    public function __construct()
    {
        parent::__construct();
        $this->setService(new \Service\Table());
    }

    public function setService($service)
    {
        $this->_service = $service;
    }

    public function defaultView(){
        $service = new \Service\Restaurant();
        $restaurants = $service->findAll();

        $tables = $this->_service->findAll();
        $this->setModel(array('tables'=> $tables,'restaurants'=>$restaurants));
        return $this->display("tables.twig");
    }


    public function detailsView($id)
    {
        $table = $this->_service->findOneById($id);
        $this->setModel(array('table' => $table));
        return $this->display('tableDetails.twig');
    }

    public function editView($id)
    {
        $table = $this->_service->findOneById($id);
        $this->setModel(array('table' => $table));
        return $this->display('editTable.twig');
    }

    public function deleteView($id)
    {
        $table = $this->_service->findOneById($id);
        $this->setModel(array('table' => $table));
        return $this->display('deleteTable.twig');
    }

    public function createView()
    {
        return $this->display('newTable.twig');
    }

    public function editAction()
    {
        $post = $_POST;
        $this->_service->update($post);
        return $this->detailsView(@$post['id']);
    }

    public function deleteAction()
    {
        $post = $_POST;
        $this->_service->delete(@$post['id']);
        return $this->defaultView();
    }

    public function addAction()
    {
        $post = $_POST;
        $_POST = null;
        $table = $this->_service->add($post);
        return $this->defaultView();


    }



}