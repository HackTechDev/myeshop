<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }


	public function loginAction()
	{
		$loginForm = new Application_Form_Login();
		$redirect = $this->getRequest()->getParam('redirect', 'index/index');
		$loginForm->setAttrib('redirect', $redirect );
		$auth = Zend_Auth::getInstance();
		if(Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect('/index/hello');
		} else if ($this->getRequest()->isPost()) {
			if ( $loginForm->isValid($this->getRequest()->getPost()) ) {
				$login = $this->getRequest()->getPost('login');
				$password = $this->getRequest()->getPost('password');
				$authAdapter = new Model_AuthAdapter($login, $password);
				$result = $auth->authenticate($authAdapter);
				if(!$result->isValid()) {
					switch ($result->getCode()) {
						case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
							$this->view->error = 'user credentials not found';
					}
				} else {
					$this->_redirect( $redirect );
				}
			}
		}
		$this->view->loginForm = $loginForm;
	}

	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		$this->_redirect('/');
	}

}





