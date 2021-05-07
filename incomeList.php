<?php
include 'header.php';
?>
<div class="container">
    <h1 class="center-align">Liste des revenus</h1>
    <div class="row">
        <div class="col s12 center-align">
            <table id="incomeTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="incomeList">
                    <?php
                    foreach ($incomes as $income) {
                    ?>
                        <tr id="income_id_<?= $income->inc_id ?>">
                        <div class="row">
                            <td id="incomeName_id_<?= $income->inc_id ?>"><?= ucfirst($income->first_name) . ' ' . ucfirst($income->last_name) ?></td>
                            <td id="incomeAmount_id_<?= $income->inc_id ?>"><?= $income->inc_amount ?></td>
                            <td id="incomeDate_id_<?= $income->inc_id ?>"><?= $income->receipt_date ?></td>
                            <td id="incomeCat_id_<?= $income->inc_id ?>"><?= $income->inc_cat_name ?></td>
                            <td id="actionsInc_id_<?= $income->inc_id ?>">
                                <form enctype="multipart/form-data" method="POST">
                                    <a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier" name="updateIncome" id="updateIncome" type="submit"><i class="material-icons">edit</i></a>
                                    <a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer" name="deleteIncome" id="deleteIncome" type="submit"><i class="material-icons">delete</i></a>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <form method="POST" enctype="multipart/form-data" id="income_list">
                <div class="row">
                    
                    <div class="input-field col s12 m3 l3">
                        <select id="addIncomeUserList" name="userList">
                            <option value="0" disabled selected>Choisir l'utilisateur</option>
                            <?php
                            foreach ($users as $user) {
                            ?><option value="<?= $user->user_id ?>"><?= $user->first_name . ' ' . ucfirst($user->last_name) ?></option><?php
                                                                                                                                    }
                                                                                                                                        ?>
                        </select>
                    </div>
                    <div class="input-field col s12 m3 l3">
                        <input id="amount" name="amount" type="number" class="validate">
                        <label for="amount">Montant</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                        <input type="text" class="datepicker" name="receipt_date" id="receipt_date" value="<?= date('Y-m-d'); ?>">
                        <label for="receipt_date">Date de réception</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                        <select name="incomeSelect" id="incomeSelect">
                            <option value="0" disabled selected>Choisir le type de revenu</option>
                            <?php
                            foreach ($categories as $category) {
                            ?><option value="<?= $category->inc_cat_id ?>"><?= ucfirst($category->inc_cat_name) ?></option><?php
                                                                                                                        }
                                                                                                                            ?>
                        </select>

                    </div>
                    
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <a class="btn waves-effect waves-light green btn-small" id="insert_income" name="insertIncome">Valider
                            <i class="material-icons right">send</i>
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="row center-align">
        <a class="btn-floating btn-large waves-effect waves-light green btn tooltipped" id="add_income" data-position="right" data-tooltip="Ajouter"><i class="material-icons" id="btnAdd">add</i></a>
    </div>
</div>
<?php
include 'footer.php';
?>