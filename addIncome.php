<?php
include 'header.php';
?>
<div class="container">
    <h1 class="center-align">Revenus</h1>
    <a href="incomeList.php" class="waves-effect waves-light btn">Liste des revenus</a>
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s6 offset-s3">
                    <select id="addIncomeUserList" name="userList">
                        <option value="0" disabled selected>Choisir l'utilisateur</option>
                        <?php
                        foreach ($users as $user) {
                        ?><option value="<?= $user->user_id ?>"><?= $user->first_name . ' ' . ucfirst($user->last_name) ?></option><?php
                                                                                                                                }
                                                                                                                                    ?>
                    </select>
                    <label>Utilisateurs</label>
                </div>
                <div class="input-field col s6 offset-s3">
                    <label>Type de revenus</label>
                    <select name="incomeList" id="incomeList" class="browser-default">
                        <option value="0" disabled selected>Choisir le type de revenu</option>

                    </select>

                </div>

            </div>
        </form>
    </div>
</div>
<?php
include 'footer.php';
?>