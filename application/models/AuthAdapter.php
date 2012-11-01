<?php
class Model_AuthAdapter implements Zend_Auth_Adapter_Interface
{
	protected $username;
	protected $password;
	protected $user;
	
	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
        $this->users = new Application_Model_DbTable_Users();
	}
	
	public function authenticate()
	{
		$match = $this->users->findCredentials($this->username, $this->password);
		if(!$match) {
			$result = new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null);
		} else {
			$user = current($match);
			$result = new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $user);
		}
		return $result;
	}
	
}
