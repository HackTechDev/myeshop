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
    public function createUser($login, $password, $role, $type, $firstname, $lastname, 
									$address1, $address2, $city, $zipcode, $state, $country, $phone, $mobile, $email, $datecreation)
    {
        $data = array(
					'login' => $login,
					'password' => $password,
					'role' => $role,
					'type' => $type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'address1' => $address1,
					'address2' => $address2,
					'city' => $city,
					'zipcode' => $zipcode,
					'state' => $state,
					'country' => $country,
					'phone' => $phone,
					'mobile' => $mobile,
					'email' => $email,
					'datecreation' => $datecreation,
                );
        $this->insert($data);
    }
    public function updateUser($id, $login, $password, $role, $type, $firstname, $lastname, 
									$address1, $address2, $city, $zipcode, $state, $country, $phone, $mobile, $email, $datecreation)
    {
        $data = array(
					'login' => $login,
					'password' => $password,
					'role' => $role,
					'type' => $type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'address1' => $address1,
					'address2' => $address2,
					'city' => $city,
					'zipcode' => $zipcode,
					'state' => $state,
					'country' => $country,
					'phone' => $phone,
					'mobile' => $mobile,
					'email' => $email,
					'datecreation' => $datecreation,
                );
        $this->update($data, 'id = '. (int)$id);
    }
    public function deleteUser($id)
    {
        $this->delete('id =' . (int)$id);
    }

	public function findCredentials($login, $password)
	{
		$select = $this->select()->where('login= ?', $login)
			->where('password = ?', $this->hashPassword($password));
		$row = $this->fetchRow($select);
		if($row) {
			return $row;
		}
		return false;
	}

	protected function hashPassword($pwd)
	{
		return md5($pwd);
	}

}

