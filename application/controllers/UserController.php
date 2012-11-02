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
                $password = $form->getValue('password');
                $role = $form->getValue('role');
                $type = $form->getValue('type');
                $firstname = $form->getValue('firstname');
                $lastname = $form->getValue('lastname');
                $address1 = $form->getValue('address1');
                $address2 = $form->getValue('address2');
                $city = $form->getValue('city');
                $zipcode = $form->getValue('zipcode');
                $state = $form->getValue('state');
                $country = $form->getValue('country');
                $phone = $form->getValue('phone');
                $mobile = $form->getValue('mobile');
                $email = $form->getValue('email');
                $datecreation = $form->getValue('datecreation');

                $users = new Application_Model_DbTable_Users();
                $users->createUser($login, $password, $role, $type, $firstname, $lastname, 
                        $address1, $address2, $city, $zipcode, $state, $country, $phone, $mobile, $email, $datecreation);
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
        $identity = Zend_Auth::getInstance()->getIdentity();
        $currentuserid = $identity['id'];
        $currentuserrole = $identity['role'];

        $form = new Application_Form_User();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');

                $login = $form->getValue('login');
                $password = $form->getValue('password');
                $role = $form->getValue('role');
                $type = $form->getValue('type');
                $firstname = $form->getValue('firstname');
                $lastname = $form->getValue('lastname');
                $address1 = $form->getValue('address1');
                $address2 = $form->getValue('address2');
                $city = $form->getValue('city');
                $zipcode = $form->getValue('zipcode');
                $state = $form->getValue('state');
                $country = $form->getValue('country');
                $phone = $form->getValue('phone');
                $mobile = $form->getValue('mobile');
                $email = $form->getValue('email');
                $datecreation = $form->getValue('datecreation');

                $users = new Application_Model_DbTable_Users();
                $users->updateUser($id, $login, $password, $role, $type, $firstname, $lastname, 
                        $address1, $address2, $city, $zipcode, $state, $country, $phone, $mobile, $email, $datecreation);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            $users = new Application_Model_DbTable_Users();
            if($currentuserrole == "admin"){
                $form->populate($users->readUser($id));
            }
            if($currentuserrole == "user"){
                if ($id > 0 && $id == $currentuserid) {
                    $form->populate($users->readUser($id));
                }else{
                    $form->populate($users->readUser($currentuserid));
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
