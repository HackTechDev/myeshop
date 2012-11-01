<?php

class Application_Model_DbTable_Websites extends Zend_Db_Table_Abstract
{

    protected $_name = 'Websites';

    public function readWebsite($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function createWebsite($name, $url, $description)
    {
        $data = array(
                'name' => $name,
                'url' => $url,
                'description' => $description,
                );
        $this->insert($data);
    }

    public function updateWebsite($id, $name, $url, $description)
    {
        $data = array(
                'name' => $name,
                'url' => $url,
                'description' => $description,
                );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteWebsite($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getWebsiteByUser($userid){
        $select = $this->select()
            ->from( array('u'  => 'Users'), array(Zend_Db_Select::SQL_WILDCARD) )
            ->join( array('uw' => 'UsersWebsites'), 'uw.user_id = u.id', array(Zend_Db_Select::SQL_WILDCARD) )
            ->join( array('w'  => 'Websites'),     'w.id = uw.website_id',     array(Zend_Db_Select::SQL_WILDCARD) )
            ->where('u.id = ?', $userid)
            ->setIntegrityCheck(false);

        return $this->fetchAll($select);
    }

}

