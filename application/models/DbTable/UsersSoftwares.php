<?php

class Application_Model_DbTable_UsersSoftwares extends Zend_Db_Table_Abstract
{

    protected $_name = 'UsersSoftwares';

    public function createUsersSoftwares($userid, $softwareid)
    {
        $data = array(
					'userid' => $userid,
					'softwareid' => $softwareid,
                );
        $this->insert($data);
    }
}

