<?php

require_once 'models/dataBase.php';
require_once 'models/users.php';
require_once 'models/expenses.php';
require_once 'models/incomes.php';
require_once 'models/incomes_categories.php';

if (isset($_POST['ajax'])) {
    require 'controllers/income_controller.php';
    echo json_encode(getIncomesUser((int)$_POST['user_id']));
    die();
}
if (isset($_POST['insertIncome'])) {
    require 'controllers/income_controller.php';
    insertIncome($formError);
    echo json_encode(getUsersIncomes());
    die();
}
if (isset($_POST['updateIncome'])) {
    require 'controllers/income_controller.php';
    updateIncome($_POST['inc_id']);
    echo json_encode(getUsersIncomes());
    die();
}

if (isset($_POST['deleteIncome'])) {
    require 'controllers/income_controller.php';
    echo json_encode(deleteIncome());
    die();
}

if (isset($_POST['insertUser'])) {
    require 'controllers/user-controller.php';
    insertUser($formError);
    echo json_encode(getUsers());
    die();
}

if (isset($_POST['updateUser'])) {
    require 'controllers/user-controller.php';
    updateUser($_POST['user_id']);
    echo json_encode(getUsers());
    die();
}

if (isset($_POST['deleteUser'])) {
    require 'controllers/user-controller.php';
    echo json_encode(deleteUser());
    die();
}

if (isset($_POST['insertExpense'])) {
    require 'controllers/expense-controller.php';
    insertExpense($formError);
    echo json_encode(getUsersExpense());
    die();
}
if (isset($_POST['updateExpense'])) {
    require 'controllers/expense-controller.php';
    updateExpense($_POST['exp_id']);
    echo json_encode(getUsersExpense());
    die();
}

if (isset($_POST['deleteExpense'])) {
    require 'controllers/expense-controller.php';
    echo json_encode(deleteExpense());
    die();
}

if (isset($_POST['insertCat'])) {
    require 'controllers/incomes_categories_controller.php';
    insertCategories($formError);
    echo json_encode(getIncomesCategoriesList());
    die();
}

if (isset($_POST['deleteCat'])) {
    require 'controllers/incomes_categories_controller.php';
    echo json_encode(deleteCategory());
    die();
}

if (isset($_POST['getUsersBalance'])) {
    require 'controllers/income_controller.php';
    echo json_encode(getIncomesUser((int)$_POST['user_id']));
    die();
}

if(isset($_POST['getUsersIds']))
{
    require 'controllers/user-controller.php';
    echo json_encode(getUsersIds());
    die();
}

require_once 'controllers/user-controller.php';
require_once 'controllers/income_controller.php';
require_once 'controllers/expense-controller.php';
require_once 'controllers/incomes_categories_controller.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion du budget</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/materialize/css/materialize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav>
        <div class="nav-wrapper blue-grey">
            <a href="#!" class="brand-logo">Logo</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="incomeList.php">Revenus</a></li>
                <li><a href="expensesList.php">Dépenses</a></li>
                <li><a href="userList.php">Famille</a></li>
                <li><a href="categoryList.php">Catégories</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="incomeList.php">Revenus</a></li>
        <li><a href="expensesList.php">Dépenses</a></li>
        <li><a href="userList.php">Famille</a></li>
        <li><a href="categoryList.php">Catégories</a></li>
    </ul>