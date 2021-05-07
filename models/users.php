<?php
//Model
/*
 * La class user contient toutes les méthodes qui permettent de récupérer les informations liées aux utilisateurs. 
 * Elle est enfant de dataBase.
 */

class user extends dataBase
{

    public $user_id = 0;
    public $first_name = '';
    public $last_name = '';
    public $birthdate = '01/01/1900';
    private $tablename = 'users';

    public function __construct()
    {
        parent::__construct();
    }


    public function addUser()
    {
        $query = 'INSERT INTO ' . $this->tablename . ' (`first_name`, `last_name`, `birth_date`) VALUES (:first_name, :last_name, :birthdate)';
        $addUser = $this->db->prepare($query);
        $addUser->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $addUser->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $addUser->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        try {
            return $addUser->execute();
        } catch (PDOException $u) {
            return $u->getMessage();
        }
    }

    public function getUserList()
    {
        // $userListResult = array();
        $query = 'SELECT `user_id`, `first_name`, `last_name`, DATE_FORMAT(birth_date, "%d/%m/%Y") AS birthdate FROM ' . $this->tablename . '';
        $userList = $this->db->query($query);
        if (is_object($userList)) {
            $userListResult = $userList->fetchAll(pdo::FETCH_OBJ);
        }
        return $userListResult;
    }


    public function getUsersIds()
    {
        $query = 'SELECT `user_id`FROM ' . $this->tablename . '';
        $idList = $this->db->query($query);
        if (is_object($idList)) {
            $idListResult = $idList->fetchAll(pdo::FETCH_OBJ);
        }
        return $idListResult;
    }

    public function updatefirstName()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `first_name` = :first_name WHERE `user_id` = :user_id';
        $updatefirstName = $this->db->prepare($query);
        $updatefirstName->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $updatefirstName->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        return $updatefirstName->execute();
    }

    public function updateLastName()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `last_name` = :last_name WHERE `user_id` = :user_id';
        $updateLastName = $this->db->prepare($query);
        $updateLastName->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $updateLastName->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        return $updateLastName->execute();
    }

    public function updateBirthdate()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `birth_date` = :birth_date WHERE `user_id` = :user_id';
        $updatePic = $this->db->prepare($query);
        $updatePic->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $updatePic->bindValue(':birth_date', $this->birthdate, PDO::PARAM_STR);
        return $updatePic->execute();
    }

    public function removeUser()
    {
        $query = 'DELETE FROM ' . $this->tablename . ' WHERE `user_id` = :user_id';
        $removeUSer = $this->db->prepare($query);
        $removeUSer->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        return $removeUSer->execute();
    }

    function __destruct()
    {
        parent::__destruct();
    }
}
