<?php

class UsersoftwareController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $currentuserid = $identity['id'];
        $currentuserrole = $identity['role'];

        // Get softwares that are not use by the current user
        $softwares = new Application_Model_DbTable_Softwares();
        //$this->view->softwares = $softwares->fetchAll();
        $this->view->softwares = $softwares->getSoftwareNotUsedByUser($currentuserid);
    }

    public function createAction()
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $currentuserid = $identity['id'];
        $currentuserrole = $identity['role'];

        // Get id param from url
        $softwareid = $this->_getParam('id');

        $userssoftwares = new Application_Model_DbTable_UsersSoftwares();
        $userssoftwares->createUsersSoftwares($currentuserid, $softwareid);

        $this->_helper->redirector('index', 'software');
    }

    public function readAction()
    {
        // action body
    }

    public function updateAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}









