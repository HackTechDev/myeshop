<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
		$this->setName('UserLogin');
		$login = new Zend_Form_Element_Text('login');
		$login->setLabel('Login')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		$submit = new Zend_Form_Element_Submit('submit');
		$redirect = new Zend_Form_Element_Hidden('redirect');
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements( array ( $login, $password, $submit));
    }


}

