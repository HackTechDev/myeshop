<?php

class Application_Model_DbTable_Softwares extends Zend_Db_Table_Abstract
{

    protected $_name = 'Softwares';

    public function readSoftware($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function createSoftware($name, $url, $description)
    {
        $data = array(
                'name' => $name,
                'url' => $url,
                'description' => $description,
                );
        return $this->insert($data);
    }

    public function updateSoftware($id, $name, $url, $description)
    {
        $data = array(
                'name' => $name,
                'url' => $url,
                'description' => $description,
                );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteSoftware($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getSoftwareUsedByUser($userid){
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        $select = "SELECT us.id AS id, s.name AS name, s.url AS url FROM `UsersSoftwares` AS us INNER JOIN Softwares AS s ON s.ID = us.softwareid WHERE `userid` = " . $userid ;
        return $db->fetchAll($select);
   }

    public function getSoftwareNotUsedByUser($userid){
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        $select = "SELECT * from Softwares WHERE id NOT IN ( SELECT softwareid FROM `UsersSoftwares` WHERE `userid` = " . $userid . ")";

        return $db->fetchAll($select);
    }

}

