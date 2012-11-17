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
                // Delete software

                $identity = Zend_Auth::getInstance()->getIdentity();

                $user = $identity['login'];
                $usersoftware = $userssoftwares->readUserSoftware($id);
                $softwareid = $usersoftware['softwareid'];                

                $softwares = new Application_Model_DbTable_Softwares();
                $softwarename = $softwares->readSoftware($softwareid);


                $version = 1; // By default : Joomla application
                $password = 'mot2passe';
                $db = $identity['login'];
                $dbprefix = 'joomla1';
 

                // Remove the directory software 
                
                // Remove the table software
            


                AI_Log::write("Delete software #" . $softwareid . " named '" . $softwarename['name'] . "' for " . $user);
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

                $identity = Zend_Auth::getInstance()->getIdentity();

                $version = 1; // By default : Joomla application
                $sitename = $identity['login'] . " Website";
                $user = $identity['login'];
                $password = 'mot2passe';
                $db = $identity['login'];
                $dbprefix = 'joomla';
                $mailfrom = 'version01@mapetiteboutique.pro';
                $fromname = 'Ma Petite Boutique Version01';

                AI_Log::write('Create user: ' . $user);
                AI_Administration::createUserSite("../../sites/" . $user);
                AI_Administration::createSqlUser($user, $password);
                AI_Administration::createUserDatabase($user);
                AI_Administration::setPermissionUserDatabase($user, $password);
            
                AI_Log::write("Install software for " . $user);
                AI_SoftwareManagement::installSoftware($version, $sitename, $user, $password, $db, $dbprefix, $mailfrom, $fromname);

                // Send variable to the view
                $this->view->softwareid = $this->getRequest()->getPost('softwareid');
                $this->_helper->viewRenderer('progress');
            }
        } else {
            $softwareid = $this->_getParam('softwareid', 0);
        }
    }

    public function progressAction()
    {   
    }
}
