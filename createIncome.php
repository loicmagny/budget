<?php
include 'header.php';
?>
<div class="container">
    <h1>Ajouter un revenu</h1>
    <div class="row">
        <form class="col s12" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Placeholder" id="amount" name="amount" type="text" class="validate">
                    <label for="amount">Montant</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s6">
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
                <div class="input-field col s6">
                    <select id="incomeCategories" name="categoryList">
                        <option value="0" disabled selected>Choisir la catégorie de revenus</option>
                        <?php
                        foreach ($categories as $category) {
                        ?><option value="<?= $category->inc_cat_id ?>"><?= $category->inc_cat_name ?></option><?php
                                                                                                            }
                                                                                                                ?>
                    </select>
                    <label>Catégories</label>
                </div>
            </div>
        <div class="row">
            <div class="col s12 center-align">
                <button class="btn waves-effect waves-light red" name="cancel">Annuler
                    <i class="material-icons right">close</i>
                </button>
                <button class="btn waves-effect waves-light green" type="submit" name="createIncome">Valider
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