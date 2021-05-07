<?php
include 'header.php';
?>
<div class="container">
    <h1 class="center-align">Ajouter une dépense</h1>
    <div class="row">
        <form class="col s12" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s6">
                    <input id="amount" name="amount" type="text" class="validate">
                    <label for="amount">Montant</label>
                </div>
                <div class="input-field col s6">
                    <input id="expLabel" type="text" name="expLabel" class="validate">
                    <label for="expLabel">Type de dépense</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s4">
                    <select id="userList" name="userList">
                        <option value="0" disabled selected>Choisir l'utilisateur</option>
                        <?php
                        foreach ($users as $user) {
                        ?><option value="<?= $user->user_id ?>"><?= $user->first_name . ' ' . ucfirst($user->last_name) ?></option><?php
                                                                                                                                }
                                                                                                                                    ?>
                    </select>
                    <label>Utilisateurs</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" class="datepicker" name="date">
                </div>
                <div class="input-field col s4">
                    <input type="text" class="timepicker" name="time">
                </div>

            </div>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn waves-effect waves-light red" name="cancel">Annuler
                        <i class="material-icons right">close</i>
                    </button>
                    <button class="btn waves-effect waves-light green" type="submit" name="addExpense">Valider
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include 'footer.php';
?>