<?php

class Application_Model_DbTable_UsersSoftwares extends Zend_Db_Table_Abstract
{

    protected $_name = 'UsersSoftwares';

    public function readUserSoftware($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function createUserSoftware($userid, $softwareid)
    {
        $data = array(
					'userid' => $userid,
					'softwareid' => $softwareid,
                );
        $this->insert($data);
    }

    public function deleteUserSoftware($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getSoftwareByUsersoftware($id)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        $select = "SELECT * FROM Softwares WHERE id = (SELECT softwareid FROM `UsersSoftwares` WHERE `id` = " . $id . ")";
        return $db->fetchAll($select);
    }

}

