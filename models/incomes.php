<?php
//Model
/*
 * La class incomes contient toutes les méthodes qui permettent de récupérer les informations liées aux revenus. 
 * Elle est enfant de dataBase.
 */

class incomes extends dataBase
{

    public $inc_id = 0;
    public $inc_amount = 0;
    public $inc_receipt_date = '01/01/1900';
    public $inc_cat_id = 0;
    public $user_id = 0;
    private $tablename = 'incomes';

    public function __construct()
    {
        parent::__construct();
    }

    public function addIncome()
    {
        $query = 'INSERT INTO ' . $this->tablename . ' (`inc_amount`, `inc_receipt_date`, `inc_cat_id`, `user_id`) VALUES (:inc_amount, :inc_receipt_date, :inc_cat_id, :user_id)';
        $addIncome = $this->db->prepare($query);
        $addIncome->bindValue(':inc_amount', $this->inc_amount, PDO::PARAM_INT);
        $addIncome->bindValue(':inc_receipt_date', $this->inc_receipt_date, PDO::PARAM_STR);
        $addIncome->bindValue(':inc_cat_id', $this->inc_cat_id, PDO::PARAM_INT);
        $addIncome->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        try {
            return $addIncome->execute();
        } catch (PDOException $u) {
            var_dump($this);
            return $u->getMessage();
        }
    }

    public function getIncomeList()
    {
        $incomeListResult = array();
        $query = 'SELECT  `inc_id`,`inc_amount`, DATE_FORMAT(`inc_receipt_date`, "%d/%m/%Y") AS receipt_date, `inc_cat_id`, `user_id` FROM ' . $this->tablename . '';
        $incomeList = $this->db->query($query);
        if (is_object($incomeList)) {
            $incomeListResult = $incomeList->fetchAll(pdo::FETCH_OBJ);
        }
        return $incomeListResult;
    }

    public function getUsersIncomes()
    {
        $userIncomes = array();
        $query = 'SELECT
        income.`inc_id`,
        income.`inc_amount`,
        DATE_FORMAT(
            income.`inc_receipt_date`,
            "%d/%m/%Y"
        ) AS receipt_date,
        income.`inc_cat_id`,
        income.`user_id` AS id,
        `users`.`first_name`,
        `users`.`last_name`,
        `incomes_categories`.`inc_cat_id`,
        `incomes_categories`.`inc_cat_name`
    FROM
    ' . $this->tablename . ' AS income
    INNER JOIN `users` ON `users`.`user_id` = income.`user_id`
    INNER JOIN `incomes_categories` ON `incomes_categories`.`inc_cat_id` = income.`inc_cat_id`
    ORDER BY receipt_date ASC';
        $incomeList = $this->db->query($query);
        if (is_object($incomeList)) {
            $userIncomes = $incomeList->fetchAll(pdo::FETCH_OBJ);
        }
        return $userIncomes;
    }
    public function getIncomesUser()
    {
        $query = 'SELECT
        income.`inc_id`,
        income.`inc_amount`,
        DATE_FORMAT(
            income.`inc_receipt_date`,
            "%d/%m/%Y"
        ) AS receipt_date,
        income.`inc_cat_id`,
        income.`user_id` AS id,
        `users`.`first_name`,
        `users`.`last_name`,
        `incomes_categories`.`inc_cat_id`,
        `incomes_categories`.`inc_cat_name`,
        `expenses`.`exp_amount`,
        DATE_FORMAT(`expenses`.`exp_date`, "%d/%m/%Y") AS exp_date,
        `expenses`.`exp_label`
    FROM
    ' . $this->tablename . ' AS income
    INNER JOIN `users` ON `users`.`user_id` = income.`user_id`
    INNER JOIN `incomes_categories` ON `incomes_categories`.`inc_cat_id` = income.`inc_cat_id`
    INNER JOIN `expenses` ON `expenses`.`user_id` = `users`.`user_id`
    WHERE
        `users`.`user_id` = income.`user_id` AND `users`.`user_id` = :user_id
    ORDER BY
        receipt_date ASC';
        $userIncomes = $this->db->prepare($query);
        $userIncomes->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        if ($userIncomes->execute()) {
            $userIncomesResult = $userIncomes->fetchAll(PDO::FETCH_OBJ);
            return $userIncomesResult;
        } else {
            return false;
        }
    }


    public function updateAmount()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `inc_amount` = :inc_amount WHERE `inc_id` = :inc_id';
        $updateAmount = $this->db->prepare($query);
        $updateAmount->bindValue(':inc_id', $this->inc_id, PDO::PARAM_INT);
        $updateAmount->bindValue(':inc_amount', $this->inc_amount, PDO::PARAM_STR);
        return $updateAmount->execute();
    }

    public function updateReceiptDate()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `receipt_date` = :receipt_date WHERE `inc_id` = :inc_id';
        $updateReceiptDate = $this->db->prepare($query);
        $updateReceiptDate->bindValue(':inc_id', $this->inc_id, PDO::PARAM_INT);
        $updateReceiptDate->bindValue(':receipt_date', $this->receipt_date, PDO::PARAM_STR);
        return $updateReceiptDate->execute();
    }

    public function updateUser()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `user_id` = :user_id WHERE `inc_id` = :inc_id';
        $updateUser = $this->db->prepare($query);
        $updateUser->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $updateUser->bindValue(':inc_id', $this->inc_id, PDO::PARAM_STR);
        return $updateUser->execute();
    }

    public function updateCat()
    {
        $query = 'UPDATE ' . $this->tablename . ' SET `inc_cat_id` = :inc_cat_id WHERE `inc_id` = :inc_id';
        $updateCat = $this->db->prepare($query);
        $updateCat->bindValue(':inc_cat_id', $this->inc_cat_id, PDO::PARAM_INT);
        $updateCat->bindValue(':inc_id', $this->inc_id, PDO::PARAM_STR);
        return $updateCat->execute();
    }

    public function RemoveIncome()
    {
        $query = 'DELETE FROM ' . $this->tablename . ' WHERE inc_id = :inc_id';
        $deleteIncome = $this->db->prepare($query);
        $deleteIncome->bindValue(':inc_id', $this->inc_id, PDO::PARAM_INT);
        $deleteIncome->execute();
        return $deleteIncome;
    }

    function __destruct()
    {
        parent::__destruct();
    }
}
