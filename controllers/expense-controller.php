<?php
$formError = array();
$insertSuccess = false;
function getAllExpenses()
{
    $expense = new expenses();
    return $expense->getExpenseList();
}

function getUsersExpense()
{
    $expense = new expenses();
    return $expense->getUserExpenses();
}

$expenses = getUsersExpense();
$userExpenses = getUserTotalExpense($expenses);

function getUserTotalExpense($expenses)
{
    $expenseList = array();
    $i = 0;
    $totalexpense = 0;
    foreach ($expenses as $expense) {
        $expenseList[$i] = $expense->exp_amount;
        $i++;
    }
    if (count($expenseList) == 1) {
        return $expenseList[0];
    } else {
        for ($i = 0; $i < count($expenseList); $i++) {
            if ($i == count($expenseList) - 1) {
                return $totalexpense;
            } else {
                $totalexpense = $expenseList[$i] + $expenseList[$i + 1];
            }
        }
    }
}

function insertExpense(&$formError)
{
    $expense = new expenses();
    if (isset($_POST['exp_amount'])) {
        $expense->exp_amount = (int)htmlspecialchars($_POST['exp_amount']);
        if (empty($_POST['exp_amount'])) {
            $formError['emptyAmount'] = 'Veuillez entrer un montant';
        }
    }
    if (isset($_POST['user_id'])) {
        if (empty($_POST['user_id'])) {
            $formError['emptyIncomeId'] = 'Veuillez choisir un utilisateur';
        } else {
            $expense->user_id = (int)htmlspecialchars($_POST['user_id']);
        }
    }
    if (isset($_POST['exp_label'])) {
        if (empty($_POST['exp_label'])) {
            $formError['emptyCategory'] = 'Veuillez choisir une catégorie de revenus';
        } else {
            $expense->exp_label = htmlspecialchars($_POST['exp_label']);
        }
    }
    if (isset($_POST['exp_date'])) {
        if (empty($_POST['exp_date'])) {
            $formError['emptyDate'] = 'Veuillez choisir une catégorie de revenus';
        } else {
            $expense->exp_date = htmlspecialchars($_POST['exp_date']);
        }
    }
    //Si l'ajout ne se fait pas,
    if (count($formError) == 0) {
        $insertSuccess = true;
        if ($insertSuccess) {
            $expense->addExpenses();
        } else {
            $expense->exp_amount = '';
            $expense->exp_label = '';
            $expense->user_id = '';
            $expense->exp_date = '';
        }
    }
}

function updateExpense($id)
{
    $expense = new expenses();
    $expense->exp_id = $id;
    $success = 0;

    if (!empty($_POST['exp_date']) || $_POST['exp_date'] != '') {
        $expense->exp_date = htmlspecialchars($_POST['exp_date']);
        if (!$expense->updateDate()) {
            $formError['dateUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }

    if (!empty($_POST['exp_label']) || $_POST['exp_label'] != '') {
        $expense->exp_label = htmlspecialchars($_POST['exp_label']);
        if (!$expense->updateLabel()) {
            $formError['labelUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }

    if (!empty($_POST['exp_amount']) || $_POST['exp_amount'] != '') {
        $expense->exp_amount = htmlspecialchars($_POST['exp_amount']);
        if (!$expense->updateAmount()) {
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



function deleteExpense()
{
    $expense = new expenses();
    $expense->exp_id = (int)htmlspecialchars($_POST['exp_id']);
    return $expense->RemoveExpanse();
}
