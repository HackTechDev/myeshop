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
        $this->view->softwaresUsedByUser = $softwares->getSoftwareUsedByUser($currentuserid);
        $this->view->softwaresNotUsedByUser    = $softwares->getSoftwareNotUsedByUser($currentuserid);
    }

    public function createAction()
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $currentuserid = $identity['id'];
        $currentuserrole = $identity['role'];

        // Get id param from url
        $softwareid = $this->_getParam('id');

        $userssoftwares = new Application_Model_DbTable_UsersSoftwares();
        $userssoftwares->createUserSoftware($currentuserid, $softwareid);

        $this->_helper->redirector('index', 'usersoftware');
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
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $userssoftwares = new Application_Model_DbTable_UsersSoftwares();
                $userssoftwares->deleteUserSoftware($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $userssoftwares = new Application_Model_DbTable_UsersSoftwares();
            $this->view->usersoftware = $userssoftwares->readUserSoftware($id);
            $this->view->software = $userssoftwares->getSoftwareByUsersoftware($id);
        }
    }

    public function installAction()
    {
        $id = $this->_getParam('id', 0);
        $userssoftwares = new Application_Model_DbTable_UsersSoftwares();
        $this->view->usersoftware = $userssoftwares->readUserSoftware($id);
        $this->view->software = $userssoftwares->getSoftwareByUsersoftware($id);

        if ($this->getRequest()->isPost()) {
            $ins = $this->getRequest()->getPost('ins');
            if ($ins == 'Yes') {
                // Send variable to the view
                $this->view->softwareid = $this->getRequest()->getPost('softwareid');
                $this->_helper->viewRenderer('progress');
                AI_Log::write('Install Software #' . $this->getRequest()->getPost('softwareid'));               
            }
        } else {
            $softwareid = $this->_getParam('softwareid', 0);
        }
    }

    public function progressAction()
    {   
    }
}
