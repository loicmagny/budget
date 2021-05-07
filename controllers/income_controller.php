<?php
require_once 'expense-controller.php';

$insertSuccess  = false;
$formError = array();

function getAllIncomes()
{
    $income = new incomes();
    return $income->getIncomeList();
}

function getUsersIncomes()
{
    $income = new incomes();
    return $income->getUsersIncomes();
}

function getIncomesUser($id)
{
    $incomes = new incomes();
    $incomes->user_id = $id;
    // var_dump($incomes);
    return $incomes->getIncomesUser();
}


$incomes = getUsersIncomes();
$userIncomes = getUserTotalIncome($incomes);

$userBalance = (float)$userIncomes - (float)$userExpenses;


function getUserTotalIncome($incomes)
{
    $incomeList = array();
    $i = 0;
    $totalIncome = 0;
    foreach ($incomes as $income) {
        $incomeList[$i] = $income->inc_amount;
        $i++;
    }
    if (count($incomeList) == 1) {
        return $incomeList;
    } else {
        for ($i = 0; $i < count($incomeList); $i++) {
            if ($i == count($incomeList) - 1) {
                return $totalIncome;
            } else {
                $totalIncome = $incomeList[$i] + $incomeList[$i + 1];
            }
        }
    }
}

if (isset($_POST['user'])) {
    $userIncomeList = getUsersIncomes();
}


function insertIncome(&$formError)
{
    $income = new incomes();
    if (isset($_POST['inc_amount'])) {
        $income->inc_amount = (int)htmlspecialchars($_POST['inc_amount']);
        if (empty($_POST['inc_amount'])) {
            $formError['emptyAmount'] = 'Veuillez entrer un montant';
        }
    }
    if (isset($_POST['user_id'])) {
        if (empty($_POST['user_id'])) {
            $formError['emptyIncomeId'] = 'Veuillez choisir un utilisateur';
        } else {
            $income->user_id = (int)htmlspecialchars($_POST['user_id']);
        }
    }
    if (isset($_POST['inc_cat_id'])) {
        if (empty($_POST['inc_cat_id'])) {
            $formError['emptyCategory'] = 'Veuillez choisir une catégorie de revenus';
        } else {
            $income->inc_cat_id = (int)htmlspecialchars($_POST['inc_cat_id']);
        }
    }
    if (isset($_POST['inc_receipt_date'])) {
        if (empty($_POST['inc_receipt_date'])) {
            $formError['emptyDate'] = 'Veuillez choisir une catégorie de revenus';
        } else {
            $income->inc_receipt_date = htmlspecialchars($_POST['inc_receipt_date']);
        }
    }
    var_dump($income);
    //Si l'ajout ne se fait pas,
    if (count($formError) == 0) {
        $insertSuccess = true;
        if ($insertSuccess) {
            $income->addIncome();
        } else {
            $income->amount = '';
            $income->inc_cat_id = '';
            $income->user_id = '';
            $income->inc_receipt_date = '';
        }
    }
}

function updateIncome($id)
{
    $income = new incomes();
    $income->inc_id = $id;
    $success = 0;
    
    if (!empty($_POST['receipt_date']) || $_POST['receipt_date'] != '') {
        $income->receipt_date = htmlspecialchars($_POST['receipt_date']);
        if (!$income->updateReceiptDate()) {
            $formError['dateUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }

    if (!empty($_POST['inc_amount']) || $_POST['inc_amount'] != '') {
        $income->inc_amount = htmlspecialchars($_POST['inc_amount']);
        if (!$income->updateAmount()) {
            $formError['amountUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }
    if ($success < 0) {
        return true;
    }
    return false;
}


function deleteIncome()
{
    $income = new incomes();
    $income->inc_id = (int)htmlspecialchars($_POST['inc_id']);
    return $income->removeIncome();
}
