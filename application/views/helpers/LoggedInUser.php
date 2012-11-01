<?php
class Zend_View_Helper_LoggedInUser
{
	protected $_view;
	function setView($view)
	{
	$this->_view = $view;
	}
	function loggedInUser()
	{
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity())
		{
			$logoutUrl = $this->_view->linkTo('index/logout');
			$user = $auth->getIdentity();
			$login = $this->_view->escape(ucfirst($user['login']));
			$string = 'Log as ' . $login . ' | <a href="' .
			$logoutUrl . '">Logout</a>';
		} else {
			$loginUrl = $this->_view->linkTo('index/login');
			$string = '<a href="'. $loginUrl . '">Login</a> | <a href="/user/create">Register</a>';
		}
		return $string;
	}
}
