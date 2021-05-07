<?php
include 'header.php';
?>
<div class="container">
    <h1 class="center-align">Liste des utilisateurs</h1>
    <div class="row">
        <div class="col s12 center-align">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) {
                    ?>
                        <tr id="user_id_<?= $user->user_id ?>">
                            <td id="userLastName_id_<?= $user->user_id ?>"><?= ucfirst($user->last_name) ?></td>
                            <td id="userFirstName_id_<?= $user->user_id ?>"><?= ucfirst($user->first_name) ?></td>
                            <td id="userBirthdate_id_<?= $user->user_id ?>"><?= $user->birthdate ?></td>
                            <td id="actionsUser_id_<?= $user->user_id ?>">
                                <form enctype="multipart/form-data" method="POST">
                                    <a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier" name="updateUser" id="updateUser" type="submit" ><i class="material-icons">edit</i></a>
                                    <a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer" name="deleteUser" id="deleteUser" type="submit" ><i class="material-icons">delete</i></a>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr id="user_list">
                        <form method="POST" enctype="multipart/form-data">
                            <td id="last_name">
                                <input name="lastName" type="text" id="lastName" class="validate">
                                <label for="lastName">Nom de famille</label>
                            </td>
                            <td id="first_name">
                                <input name="firstName" type="text" id="firstName" class="validate">
                                <label for="firstName">Prénom</label>
                            </td>
                            <td id="birthdate">
                                <input type="text" class="datepicker" name="birthDate" id="birthDate">
                                <label for="birthdate">Date de naissance</label>
                            </td>
                            <td id="actions">
                                <a class="btn waves-effect waves-light green btn-small" id="insert_user" name="insertUser">Valider
                                    <i class="material-icons right">send</i>
                                </a>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row center-align">
        <a class="btn-floating btn-large waves-effect waves-light green btn tooltipped" id="add_user" data-position="right" data-tooltip="Ajouter"><i class="material-icons" id="btnAdd">add</i></a>
    </div>
</div>
<?php
include 'footer.php';
?>