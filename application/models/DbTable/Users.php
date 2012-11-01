<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'Users';

    public function readUser($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    public function createUser($login, $firstname, $lastname)
    {
        $data = array(
                'login' => $login,
                'firstname' => $firstname,
                'lastname' => $lastname,
                );
        $this->insert($data);
    }
    public function updateUser($id, $login, $firstname, $lastname)
    {
        $data = array(
                'login' => $login,
                'firstname' => $firstname,
                'lastname' => $lastname,
                );
        $this->update($data, 'id = '. (int)$id);
    }
    public function deleteUser($id)
    {
        $this->delete('id =' . (int)$id);
    }


}

