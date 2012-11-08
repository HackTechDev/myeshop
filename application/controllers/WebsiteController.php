<?php

class WebsiteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
        // action body
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
                $login = $this->getRequest()->getPost('login');

                //TODO: Delete user directory
                AI_Log::write('Delete website user: ' . $login);
                AI_Administration::deleteUserSite("../../sites/" . $login);
                // Send variable to the view
                $this->view->login = $login;
                $this->_helper->viewRenderer('delete');
            }
            $this->_helper->redirector('index', 'user');
        } 
           else {
           $login = $this->_getParam('login', 0);
$this->view->login = $login;
                $this->_helper->viewRenderer('delete');
           }
    }
}

