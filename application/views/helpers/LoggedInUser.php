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
			$string = 'Connect&eacute; comme ' . $login . ' | <a href="' .
			$logoutUrl . '">D&eacute;connexion</a>';
		} else {
			$loginUrl = $this->_view->linkTo('index/login');
			$string = '<a href="'. $loginUrl . '">Connexion</a>';
		}
		return $string;
	}
}
