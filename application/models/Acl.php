<?php
class Model_Acl extends Zend_Acl 
{

	public function __construct() 
	{
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('user'), 'guest');
		$this->addRole(new Zend_Acl_Role('admin'), 'user');

		$this->add(new Zend_Acl_Resource('user'));
		$this->add(new Zend_Acl_Resource('website'));

		$this->allow('user', 'website', 'create');
		$this->allow('user', 'website', 'read');
		$this->allow('user', 'website', 'update');
		$this->allow('user', 'website', 'delete');
		
		$this->allow('admin', 'user', 'create');
		$this->allow('admin', 'user', 'read');
		$this->allow('admin', 'user', 'update');
		$this->allow('admin', 'user', 'delete');
	}
	
}
