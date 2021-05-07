<?php
//Model
/*
 * La class expenses contient toutes les méthodes qui permettent de récupérer les informations liées aux utilisateurs. 
 * Elle est enfant de dataBase.
 */

class expenses extends dataBase
{

    public $exp_id = 0;
    public $exp_amount = 0;
    public $exp_date = '01/01/1900';
    public $exp_label = '';
    public $user_id = 0;
    private $tablename = 'expenses';

    public function __construct()
    {
        parent::__construct();
    }

    public function addExpenses()
    {
        $query = 'INSERT INTO ' . $this->tablename . ' (`exp_amount`, `exp_date`, `exp_label`, `user_id`) VALUES (:exp_amount, :exp_date, :exp_label, :user_id)';
        $addExpenses = $this->db->prepare($query);
        $addExpenses->bindValue(':exp_amount', $this->exp_amount, PDO::PARAM_STR);
        $addExpenses->bindValue(':exp_date', $this->exp_date, PDO::PARAM_STR);
        $addExpenses->bindValue(':exp_label', $this->exp_label, PDO::PARAM_STR);
        $addExpenses->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        return $addExpenses->execute();
    }

    public function getExpenseList()
    {
        $expenseListResult = array();
        $query = 'SELECT  `exp_id`,`exp_amount`, `exp_date`, `exp_label`, `user_id` FROM ' . $this->tablename . '';
        $expenseList = $this->db->query($query);
        if (is_object($expenseList)) {
            $expenseListResult = $expenseList->fetchAll(pdo::FETCH_OBJ);
        }
        return $expenseListResult;
    }

    public function getUserExpenses()
    {
        $userExpenses = array();
        $query = 'SELECT
        expense.`exp_id`,
        expense.`exp_amount`,
        DATE_FORMAT(expense.`exp_date`, "%d/%m/%Y") as exp_date,
        expense.`exp_label`,
        expense.`user_id` AS id,
        `users`.`first_name`,
        `users`.`last_name`
        FROM
        `expenses` AS expense
        INNER JOIN `users` ON `users`.`user_id` = expense.`user_id`';
        $expenseList = $this->db->query($query);
        if (is_object($expenseList)) {
            $userExpenses = $expenseList->fetchAll(pdo::FETCH_OBJ);
        }
        return $userExpenses;
    }

    public function updateAmount()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `exp_amount` = :exp_amount WHERE `exp_id` = :exp_id';
        $updateAmount = $this->db->prepare($query);
        $updateAmount->bindValue(':exp_id', $this->exp_id, PDO::PARAM_INT);
        $updateAmount->bindValue(':exp_amount', $this->exp_amount, PDO::PARAM_STR);
        return $updateAmount->execute();
    }

    public function updateDate()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `exp_date` = :exp_date WHERE `exp_id` = :exp_id';
        $updateDate = $this->db->prepare($query);
        $updateDate->bindValue(':exp_id', $this->exp_id, PDO::PARAM_INT);
        $updateDate->bindValue(':exp_date', $this->exp_date, PDO::PARAM_STR);
        return $updateDate->execute();
    }

    public function updateUser()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `user_id` = :user_id WHERE `exp_id` = :exp_id';
        $updateUser = $this->db->prepare($query);
        $updateUser->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $updateUser->bindValue(':exp_id', $this->exp_id, PDO::PARAM_STR);
        return $updateUser->execute();
    }

    public function updateLabel()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET exp_label = :exp_label WHERE `exp_id` = :exp_id';
        $updateLabel = $this->db->prepare($query);
        $updateLabel->bindValue(':exp_label', $this->exp_label, PDO::PARAM_STR);
        $updateLabel->bindValue(':exp_id', $this->exp_id, PDO::PARAM_STR);
        return $updateLabel->execute();
    }

    public function RemoveExpanse()
    {
        $query = 'DELETE FROM ' . $this->tablename . ' WHERE exp_id = :exp_id';
        $deleteExpanse = $this->db->prepare($query);
        $deleteExpanse->bindValue(':exp_id', $this->exp_id, PDO::PARAM_INT);
        $deleteExpanse->execute();
        return $deleteExpanse;
    }


    function __destruct()
    {
        parent::__destruct();
    }
}
