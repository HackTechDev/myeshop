<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {

        $this->setName('user');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('Password')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $role = new Zend_Form_Element_Text('role');
        $role->setLabel('Role')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $firstname = new Zend_Form_Element_Text('firstname');
        $firstname->setLabel('Firstname')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $lastname = new Zend_Form_Element_Text('lastname');
        $lastname->setLabel('Lastname')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $address1 = new Zend_Form_Element_Text('address1');
        $address1->setLabel('Address1')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $address2 = new Zend_Form_Element_Text('address2');
        $address2->setLabel('Address2')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('City')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $zipcode = new Zend_Form_Element_Text('zipcode');
        $zipcode->setLabel('Zipcode')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $state = new Zend_Form_Element_Text('state');
        $state->setLabel('State')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $country = new Zend_Form_Element_Text('country');
        $country->setLabel('Country')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Phone')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $mobile = new Zend_Form_Element_Text('mobile');
        $mobile->setLabel('Mobile')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $datecreation = new Zend_Form_Element_Text('datecreation');
        $datecreation->setLabel('Datecreation')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $login, $password, $role, $type, $firstname, $lastname, 
                                $address1, $address2, $city, $zipcode, $state, $country, $phone, $mobile, $email, $datecreation, $submit));
    }
}

