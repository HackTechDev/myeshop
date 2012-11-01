<?php

class WebsiteController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $websites = new Application_Model_DbTable_Websites();
        $this->view->websites = $websites->fetchAll();
    }

    public function createAction()
    {
        $form = new Application_Form_Website();
        $form->submit->setLabel('Create');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $url = $form->getValue('url');
                $description = $form->getValue('description');
 
                $websites = new Application_Model_DbTable_Websites();
                $websites->createWebsite($name, $url, $description);
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
            $form = new Application_Form_Website();
            $form->submit->setLabel('Save');
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $id = (int)$form->getValue('id');

                $name = $form->getValue('name');
                $url = $form->getValue('url');
                $description = $form->getValue('description');
 

                    $websites = new Application_Model_DbTable_Websites();
                    $websites->updateWebsite($id, $name, $url, $description);
                    $this->_helper->redirector('index');
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    $websites = new Application_Model_DbTable_Websites();
                    $form->populate($websites->readWebsite($id));
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
                $websites = new Application_Model_DbTable_Websites();
                $websites->deleteWebsite($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $websites = new Application_Model_DbTable_Websites();
            $this->view->website = $websites->readWebsite($id);
        }
    }
}









