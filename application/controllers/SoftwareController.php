<?php

class SoftwareController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $softwares = new Application_Model_DbTable_Softwares();
        $this->view->softwares = $softwares->fetchAll();
        //$request->getParam('user');
        $identity = Zend_Auth::getInstance()->getIdentity();
        $this->view->softwaresByUser = $softwares->getSoftwareByUser($identity['id']);
    }

    public function createAction()
    {
        $form = new Application_Form_Software();
        $form->submit->setLabel('Create');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $url = $form->getValue('url');
                $description = $form->getValue('description');
 
                $softwares = new Application_Model_DbTable_Softwares();
                $softwares->createSoftware($name, $url, $description);
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
            $form = new Application_Form_Software();
            $form->submit->setLabel('Save');
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('id');

                $name = $form->getValue('name');
                $url = $form->getValue('url');
                $description = $form->getValue('description');
 

                    $softwares = new Application_Model_DbTable_Softwares();
                    $softwares->updateSoftware($id, $name, $url, $description);
                    $this->_helper->redirector('index');
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $softwares = new Application_Model_DbTable_Softwares();
                    $form->populate($softwares->readSoftware($id));
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
                $softwares = new Application_Model_DbTable_Softwares();
                $softwares->deleteSoftware($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $softwares = new Application_Model_DbTable_Softwares();
            $this->view->software = $softwares->readSoftware($id);
        }
    }

    public function installAction()
    {
        // action body
    }


}











