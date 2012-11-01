<?php

class UserController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll();
    }

    public function createAction()
    {
        $form = new Application_Form_User();
        $form->submit->setLabel('Create');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $login = $form->getValue('login');
                $firstname = $form->getValue('firstname');
                $lastname = $form->getValue('lastname');
                
                $users = new Application_Model_DbTable_Users();
                $users->createUser($login, $firstname, $lastname);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function readAction()
    {
    }

    public function updateAction()
    {
        {
            $form = new Application_Form_User();
            $form->submit->setLabel('Save');
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('id');
                    $login = $form->getValue('login');
                    $firstname = $form->getValue('firstname');
                    $lastname = $form->getValue('lastname');
                    $users = new Application_Model_DbTable_Users();
                    $users->updateUser($id, $login, $firstname, $lastname);
                    $this->_helper->redirector('index');
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $users = new Application_Model_DbTable_Users();
                    $form->populate($users->readUser($id));
                }
            }
        }
    }
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $users = new Application_Model_DbTable_Users();
                $users->deleteUser($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $users = new Application_Model_DbTable_Users();
            $this->view->user = $users->readUser($id);
        }
    }
}
