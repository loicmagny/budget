<?php
//Model
/*
 * La class incomes_categories contient toutes les méthodes qui permettent de récupérer les informations liées aux utilisateurs. 
 * Elle est enfant de dataBase.
 */

class incomes_categories extends dataBase
{

    public $inc_cat_id = 0;
    public $inc_cat_name = '';
    private $tablename = 'incomes_categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function addCategory()
    {
        $query = 'INSERT INTO ' . $this->tablename . ' (`inc_cat_name`) VALUES (:inc_cat_name)';
        $addCategory = $this->db->prepare($query);
        $addCategory->bindValue(':inc_cat_name', $this->inc_cat_name, PDO::PARAM_STR);
        return $addCategory->execute();
    }

    public function getCategoriesList()
    {
        $categoriesListResult = array();
        $query = 'SELECT  `inc_cat_id`,`inc_cat_name` FROM ' . $this->tablename . '';
        $categoriesList = $this->db->query($query);
        if (is_object($categoriesList)) {
            $categoriesListResult = $categoriesList->fetchAll(pdo::FETCH_OBJ);
        }
        return $categoriesListResult;
    }

    public function updateCategory()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `inc_cat_name` = :inc_cat_name WHERE `inc_cat_id` = :inc_cat_id';
        $updateCategory = $this->db->prepare($query);
        $updateCategory->bindValue(':inc_cat_id', $this->inc_cat_id, PDO::PARAM_INT);
        $updateCategory->bindValue(':inc_cat_name', $this->inc_cat_name, PDO::PARAM_STR);
        return $updateCategory->execute();
    }

    public function removeCategory()
    {
        $query = 'DELETE FROM `incomes_categories` WHERE `inc_cat_id` = :inc_cat_id';
        $removeCategory = $this->db->prepare($query);
        $removeCategory->bindValue(':inc_cat_id', $this->inc_cat_id, PDO::PARAM_INT);
        return $removeCategory->execute();
    }

    public function countCategories()
    {
        $query = 'SELECT COUNT(*) FROM ' . $this->tablename . '';
        $catAmount = $this->db->prepare($query);
        if (is_object($catAmount)) {
            return $catAmount->fetch((pdo::FETCH_OBJ));
        }
    }

    function __destruct()
    {
        parent::__destruct();
    }
}
