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

    public function getSoftwareByUser($userid){
        $select = $this->select()
            ->from( array('u'  => 'Users'), array(Zend_Db_Select::SQL_WILDCARD) )
            ->join( array('us' => 'UsersSoftwares'), 'us.userid = u.id', array(Zend_Db_Select::SQL_WILDCARD) )
            ->join( array('s'  => 'Softwares'),     's.id = us.softwareid',     array(Zend_Db_Select::SQL_WILDCARD) )
            ->where('u.id = ?', $userid)
            ->setIntegrityCheck(false);

        return $this->fetchAll($select);
    }

	// TODO: sql for getSoftwareNotUsedByUser
    public function getSoftwareNotUsedByUser($userid){
        $select = $this->select()
            ->from( array('u'  => 'Users'), array(Zend_Db_Select::SQL_WILDCARD) )
            ->join( array('us' => 'UsersSoftwares'), 'us.userid = u.id', array(Zend_Db_Select::SQL_WILDCARD) )
            ->join( array('s'  => 'Softwares'),     's.id = us.softwareid',     array(Zend_Db_Select::SQL_WILDCARD) )
            ->where('u.id = ?', $userid)
            ->setIntegrityCheck(false);

        return $this->fetchAll($select);
    }

}

