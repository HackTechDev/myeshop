<?php
class Model_Acl extends Zend_Acl 
{

    public function __construct() 
    {
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('user'), 'guest');
        $this->addRole(new Zend_Acl_Role('admin'), 'user');

        $this->add(new Zend_Acl_Resource('user'));
        $this->add(new Zend_Acl_Resource('software'));

        $this->allow('user', 'software', 'showmenu');
        $this->allow('user', 'software', 'createmysoftware');
        $this->allow('user', 'user', 'showmyprofile');
        $this->allow('user', 'software', 'mysoftware');
        $this->allow('user', 'software', 'read');
        $this->allow('user', 'software', 'update');
        $this->allow('user', 'software', 'delete');

        $this->allow('admin', 'user', 'showallusers');
        $this->allow('admin', 'software', 'create');
        $this->allow('admin', 'user', 'create');
        $this->allow('admin', 'user', 'read');
        $this->allow('admin', 'user', 'update');
        $this->allow('admin', 'user', 'delete');
    }

}
