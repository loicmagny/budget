<?php
$formError = array();
function getUsers()
{
    $user = new user();
    return $user->getUserList();
}
$users = getUsers();


if (isset($_POST['insertUser'])) {
    insertUser($formError);
}

if ((isset($_POST['updateUser']))) {

    updateUser((int)htmlspecialchars($_POST['updateUser']));
}

function updateUser($id)
{
    $user = new user();
    $user->user_id = $id;
    $success = 0;
    if (!empty($_POST['last_name']) || $_POST['last_name'] != '') {
        $user->last_name = htmlspecialchars($_POST['last_name']);
        if (!$user->updateLastName()) {
            $formError['lastNameUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }
    if (!empty($_POST['first_name']) || $_POST['first_name'] != '') {
        $user->first_name = htmlspecialchars($_POST['first_name']);
        if (!$user->updatefirstName()) {
            $formError['firstNameUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }

    if (!empty($_POST['birthdate']) || $_POST['birthdate'] != '') {
        $user->birthdate = htmlspecialchars($_POST['birthdate']);
        var_dump($user->birthdate);
        if (!$user->updateBirthdate()) {
            $formError['birthdateUpdateFailed'] = 'La modification a échoué';
        } else {
            $success++;
        }
    }
    if ($success < 0) {
        return true;
    }
    return false;
}

function insertUser(&$formError)
{

    $user = new user();
    if (isset($_POST['last_name'])) {
        $user->last_name = htmlspecialchars($_POST['last_name']);
        if (empty($_POST['last_name'])) {
            $formError['emptyLast_name'] = 'Veuillez entrer un nom de famille';
        }
    }
    if (isset($_POST['first_name'])) {
        if (empty($_POST['first_name'])) {
            $formError['emptyFirst_name'] = 'Veuillez entrer un prénom';
        } else {
            $user->first_name = htmlspecialchars($_POST['first_name']);
        }
    }
    if (isset($_POST['birthdate'])) {
        if (empty($_POST['birthdate'])) {
            $formError['emptyBirthdate'] = 'Veuillez choisir une date de naissance';
        } else {
            $user->birthdate = htmlspecialchars($_POST['birthdate']);
        }
    }
    //Si l'ajout ne se fait pas,
    if (count($formError) == 0) {
        $insertSuccess = true;
        if ($insertSuccess) {
            $user->addUser();
        } else {
            $user->last_name = '';
            $user->first_name = '';
            $user->birthdate = '';
        }
    }
}


function deleteUser()
{
    $user = new user();
    $user->user_id = (int)htmlspecialchars($_POST['user_id']);
    return $user->removeUser();
}


function getUsersIds()
{
    $user = new user();
    return $user->getUsersIds();
}