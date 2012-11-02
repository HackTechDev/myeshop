<?php

class Application_Form_Software extends Zend_Form
{

    public function init()
    {
        $this->setName('software');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $url = new Zend_Form_Element_Text('url');
        $url->setLabel('Url')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $name, $url, $description, $submit));
    }


}

