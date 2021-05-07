<?php
$formError = array();
function getIncomesCategoriesList()
{
    $categories = new incomes_categories();
    return $categories->getCategoriesList();
}

$categories = getIncomesCategoriesList();


function insertCategories(&$formError)
{
    $categories = new incomes_categories();
    if (isset($_POST['inc_cat_name'])) {
        $categories->inc_cat_name = htmlspecialchars($_POST['inc_cat_name']);
        if (empty($_POST['inc_cat_name'])) {
            $formError['emptycatName'] = 'Veuillez entrer un nom de famille';
        }
    }
    //Si l'ajout ne se fait pas,
    if (count($formError) == 0) {
        $insertSuccess = true;
        if ($insertSuccess) {
            $categories->addCategory();
        } else {
            $categories->inc_cat_name = '';
        }
    }
}
function deleteCategory()
{
    $category = new incomes_categories();
    $category->inc_cat_id = (int)htmlspecialchars($_POST['inc_cat_id']);
    return $category->removeCategory();
}
